<?php

namespace App\Repository\API;

use App\Models\Transaction;

class TransactionRepository
{
    /**
     * @param array $validatedData
     * @return mixed
     */
    public function create(array $validatedData)
    {
        return Transaction::create($validatedData);
    }
}
