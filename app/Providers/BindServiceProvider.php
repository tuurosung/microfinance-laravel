<?php

namespace App\Providers;

use App\Domain\Accounts\Contracts\AccountRepositoryInterface;
use App\Domain\Accounts\Repositories\AccountRepository;
use App\Domain\CIFs\Contracts\CifRepositoryInterface;
use App\Domain\CIFs\Repositories\CifRepository;
use App\Domain\KYC\Contracts\KycAmlRepositoryInterface;
use App\Domain\KYC\Contracts\KycGhanaCardRepositoryInterface;
use App\Domain\KYC\Contracts\KycRepositoryInterface;
use App\Domain\KYC\Repositories\KycAmlRepository;
use App\Domain\KYC\Repositories\KycGhanaCardRepository;
use App\Domain\KYC\Repositories\KycRepository;
use App\Domain\Transactions\Contracts\DepositServiceInterface;
use App\Domain\Transactions\Contracts\GatewayInterface;
use App\Domain\Transactions\Contracts\GatewayManagerInterface;
use App\Domain\Transactions\Contracts\LedgerInterface;
use App\Domain\Transactions\Contracts\WithdrawalServiceInterface;
use App\Domain\Transactions\Services\DepositService;
use App\Domain\Transactions\Services\GatewayManager;
use App\Domain\Transactions\Services\LedgerService;
use App\Domain\Transactions\Services\WithdrawalService;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            CifRepositoryInterface::class,
            CifRepository::class
        );

        $this->app->bind(
            KycRepositoryInterface::class,
            KycRepository::class
        );

        $this->app->bind(
            KycGhanaCardRepositoryInterface::class,
            KycGhanaCardRepository::class
        );

        $this->app->bind(
            KycAmlRepositoryInterface::class,
            KycAmlRepository::class
        );

        $this->app->bind(
            AccountRepositoryInterface::class,
            AccountRepository::class
        );


        // Transaction related
        $this->app->bind(
            DepositServiceInterface::class,
            DepositService::class
        );

        $this->app->bind(
            WithdrawalServiceInterface::class,
            WithdrawalService::class
        );

        $this->app->bind(
            LedgerInterface::class,
            LedgerService::class
        );

        $this->app->bind(
            GatewayManagerInterface::class,
            GatewayManager::class
        );

    }
}
