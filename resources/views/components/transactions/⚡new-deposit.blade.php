<?php

use App\Domain\Accounts\Models\Account;
use App\Enums\Transactions\TransactionChannelEnum;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Account $account;

    #[Computed]
    public function idempotencyKey()
    {
        return Str::uuid();
    }


    #[Computed]
    public function channel()
    {
        return TransactionChannelEnum::Counter;
    }
};
?>

<div>
    <x-modals.modal modalId="new-deposit-modal">

        <form method="POST" action="{{ route('transactionsdeposit', $account) }}">

            <x-modals.modal-header modalId="new-deposit-modal" modalTitle="New Deposit" />

            <div class="p-6">

                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" class="form-control" name="idempotency_key" id="idempotency_key" value="{{ $this->idempotencyKey }}" />
                    </div>
                </div>


                <div class="row mb-8!">
                    <div class="col-md-6">
                        <label for="" class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" required />
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Channel</label>
                        <select class="form-control" name="channel" id="channel">
                            <option value="{{ $this->channel->value }}">{{ $this->channel->label() }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Value Date</label>
                        <input type="date" class="form-control" name="value_date" id="value_date" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="form-label">Narration</label>
                        <textarea class="form-control resize-none" name="narration" id="narration"></textarea>
                    </div>
                </div>


            </div>

            <x-modals.modal-footer modalId="new-deposit-modal" btnLabel="Record Deposit" />

        </form>
    </x-modals.modal>
</div>
