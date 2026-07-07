<?php

namespace App\Domain\Accounts\Contracts;

use App\Domain\Accounts\Models\Account;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface AccountRepositoryInterface
{

    public function create(array $data): Account;
    public function update(Account  $account, array $data): bool;
    public function delete(Account $account): bool;


    public function allAccounts(): Collection;
    public function filterAccounts(Request $request): Collection;

}
