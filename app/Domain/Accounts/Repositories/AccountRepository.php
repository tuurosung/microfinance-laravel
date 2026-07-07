<?php

namespace App\Domain\Accounts\Repositories;

use App\Domain\Accounts\Contracts\AccountRepositoryInterface;
use App\Domain\Accounts\Models\Account;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AccountRepository implements AccountRepositoryInterface
{

    public function __construct(
        protected Account $model
    ){}


    public function create(array $data): Account
    {
        return $this->model->create($data);
    }


    public function update(Account $depositAccount, array $data): bool
    {
        return $depositAccount->update($data);
    }
    

    public function delete(Account $depositAccount): bool
    {
        return $depositAccount->delete();
    }


    public function filterAccounts(Request $request): Collection
    {
        return $this->model->get();
    }


    public function allAccounts(): Collection
    {
        return $this->model->get();
    }
}
