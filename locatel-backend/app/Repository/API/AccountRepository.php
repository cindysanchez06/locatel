<?php

namespace App\Repository\API;

use App\Models\Account;

class AccountRepository
{
    /**
     * @param array $validatedData
     * @return mixed
     */
    public function create(array $validatedData)
    {
        return Account::create($validatedData);
    }

    /**
     * @param string $accountNumber
     * @return mixed
     */
    public function findByAccountNumber(string $accountNumber)
    {
        return Account::where('account_number', $accountNumber)->first();
    }
}
