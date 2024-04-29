<?php

namespace App\Services\api\Transaction;

use App\Repository\API\TransactionRepository;

class CreateTransactionService
{
    /**
     * @var TransactionRepository
     */
    private TransactionRepository $transactionRepository;

    /**
     * @param TransactionRepository $transactionRepository
     */
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @param array $validatedData
     * @return mixed
     */
    public function create(array $validatedData)
    {
        return $this->transactionRepository->create($validatedData);
    }
}
