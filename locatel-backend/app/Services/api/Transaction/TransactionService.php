<?php

namespace App\Services\api\Transaction;

use App\Repository\API\AccountRepository;
use App\Services\api\Account\UpdateAccountService;
use App\Services\api\Account\ValidationsService;
use Illuminate\Validation\ValidationException;

class TransactionService
{
    /**
     * @var AccountRepository
     */
    private AccountRepository $accountRepository;
    /**
     * @var ValidationsService
     */
    private ValidationsService $validationsService;
    /**
     * @var UpdateAccountService
     */
    private UpdateAccountService $updateAccountService;
    /**
     * @var CreateTransactionService
     */
    private CreateTransactionService $createTransactionService;

    /**
     * @param AccountRepository $accountRepository
     * @param ValidationsService $validationsService
     * @param UpdateAccountService $updateAccountService
     * @param CreateTransactionService $createTransactionService
     */
    public function __construct(AccountRepository $accountRepository, ValidationsService $validationsService, UpdateAccountService $updateAccountService, CreateTransactionService $createTransactionService)
    {
        $this->accountRepository = $accountRepository;
        $this->validationsService = $validationsService;
        $this->updateAccountService = $updateAccountService;
        $this->createTransactionService = $createTransactionService;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ValidationException
     */
    public function prepareDataForCreateTransaction(array $data): mixed
    {
        $account = $this->accountRepository->findByAccountNumber($data['account_number']);
        $this->validationsService->validateType($account, $data['amount'], $data['type']);
        $this->updateAccountService->updateBalance($account, $data['amount'], $data['type']);
        $data['account_id'] = $account->id;

        return $this->createTransactionService->create($data);
    }


}
