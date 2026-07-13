<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Contracts\WithdrawalServiceContract;
use App\DataTransferObjects\WithdrawalData;
use App\Domain\Accounts\Models\Account;
use App\Domain\Transactions\Contracts\LedgerInterface;
use App\Domain\Transactions\Contracts\WithdrawalServiceInterface;
use App\Enums\TransactionChannelEnum;
use App\Enums\Transactions\WithdrawalRequestStatusEnum;
use App\Models\User;
use Database\Seeders\ChartOfAccountsSeeder;
use Database\Seeders\SystemAccountsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    private User $teller;
    private User $supervisor;
    private Account $customerAccount;

    protected function setUp(): void
    {
        parent::setUp();

        $this->teller     = User::factory()->create();
        $this->supervisor = User::factory()->create();

        $this->seed(ChartOfAccountsSeeder::class);
        $this->seed(SystemAccountsSeeder::class);

        // Approved-KYC CIF with an active savings account holding GHS 100.00
        $this->customerAccount = Account::factory()
            ->savings()
            ->forApprovedCif()
            ->create(['minimum_balance_pesewas' => 0]);

        $this->fundTill(100_000_000);           // GHS 1,000,000 in the till
        $this->fundCustomer(10_000);            // GHS 100.00 customer balance

        config(['banking.withdrawal_approval_threshold_pesewas' => 5_000]); // GHS 50
    }

    public function test_sub_threshold_counter_withdrawal_posts_immediately(): void
    {
        $request = $this->withdraw(4_999);

        $this->assertSame(WithdrawalRequestStatusEnum::Posted, $request->status);
        $this->assertNotNull($request->ledger_reference);
        $this->assertNull($request->lien_id);

        $this->assertSame(
            10_000 - 4_999,
            app(LedgerInterface::class)->balances($this->customerAccount)->availableBalancePesewas,
        );
    }

    public function test_threshold_withdrawal_is_held_pending_approval(): void
    {
        $request = $this->withdraw(5_000);

        $this->assertSame(WithdrawalRequestStatusEnum::PendingApproval, $request->status);
        $this->assertNotNull($request->lien_id);

        // The lien reduces available balance while ledger balance is unchanged.
        $balances = app(LedgerInterface::class)->balances($this->customerAccount);
        $this->assertSame(10_000, $balances->ledgerBalancePesewas);
        $this->assertSame(5_000, $balances->availableBalancePesewas);
    }

    public function test_held_funds_cannot_be_drained_through_a_second_withdrawal(): void
    {
        $this->withdraw(5_000);

        $this->expectException(\DomainException::class);
        $this->withdraw(6_000, idempotencyKey: 'second-attempt');
    }

    public function test_maker_cannot_approve_own_withdrawal(): void
    {
        $request = $this->withdraw(5_000);

        $this->expectException(\DomainException::class);
        app(WithdrawalServiceInterface::class)->approve($request, $this->teller->id);
    }

    public function test_checker_approval_releases_hold_and_posts(): void
    {
        $request = $this->withdraw(5_000);

        $decided = app(WithdrawalServiceInterface::class)->approve($request, $this->supervisor->id);

        $this->assertSame(WithdrawalRequestStatusEnum::Posted, $decided->status);
        $this->assertSame('released', $decided->lien->status);

        $balances = app(LedgerInterface::class)->balances($this->customerAccount);
        $this->assertSame(5_000, $balances->ledgerBalancePesewas);
        $this->assertSame(5_000, $balances->availableBalancePesewas);
    }

    public function test_rejection_releases_hold_without_posting(): void
    {
        $request = $this->withdraw(5_000);

        $decided = app(WithdrawalServiceInterface::class)
            ->reject($request, $this->supervisor->id, 'Signature mismatch');

        $this->assertSame(WithdrawalRequestStatusEnum::Rejected, $decided->status);
        $this->assertSame(
            10_000,
            app(LedgerInterface::class)->balances($this->customerAccount)->availableBalancePesewas,
        );
    }

    public function test_withdrawal_request_is_idempotent(): void
    {
        $first  = $this->withdraw(5_000, idempotencyKey: 'same-key');
        $second = $this->withdraw(5_000, idempotencyKey: 'same-key');

        $this->assertTrue($first->is($second));
    }

    // ── helpers ──────────────────────────────────────────────────────────

    private function withdraw(int $amountPesewas, string $idempotencyKey = 'test-key'): \App\Models\WithdrawalRequest
    {
        return app(WithdrawalServiceContract::class)->request(
            $this->customerAccount,
            new WithdrawalData(
                amountPesewas: $amountPesewas,
                idempotencyKey: $idempotencyKey,
                actorId: $this->teller->id,
                channel: TransactionChannelEnum::Counter,
            ),
        );
    }

    private function fundTill(int $amountPesewas): void
    {
        // In production the till is funded by a vault-to-till transfer;
        // for tests, seed a raw balancing entry or use a dedicated factory.
        // Implementation depends on your TransactionFactory.
        \App\Models\Transaction::factory()->tillFunding($amountPesewas)->create();
    }

    private function fundCustomer(int $amountPesewas): void
    {
        \App\Models\Transaction::factory()
            ->depositInto($this->customerAccount, $amountPesewas)
            ->create();
    }
}
