<?php

namespace App\Services\api\Account;

use App\Models\Account;
use App\Repository\API\AccountRepository;
use App\Services\api\Transaction\CreateTransactionService;
use App\Services\api\Transaction\TransactionService;
use App\Services\api\Transaction\ValidationsService;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateAccountService
{
    /**
     * @var TransactionService
     */
    private TransactionService $transactionService;
    /**
     * @var mixed|Repository|Application|\Illuminate\Foundation\Application
     */
    private mixed $credit;
    /**
     * @var AccountRepository
     */
    private AccountRepository $accountRepository;
    private ValidationsService $validationsService;
    private CreateTransactionService $createTransactionService;

    /**
     * @param TransactionService $transactionService
     * @param AccountRepository $accountRepository
     * @param ValidationsService $validationsService
     * @param CreateTransactionService $createTransactionService
     */
    public function __construct(TransactionService $transactionService, AccountRepository $accountRepository, ValidationsService $validationsService, CreateTransactionService $createTransactionService)
    {
        $this->transactionService = $transactionService;
        $this->accountRepository = $accountRepository;
        $this->validationsService = $validationsService;
        $this->credit = config('api.credit');
        $this->createTransactionService = $createTransactionService;
    }

    /**
     * @param array $validatedData
     * @return mixed
     */
    public function create(array $validatedData): mixed
    {
        return DB::transaction(function () use ($validatedData) {
            $account = $this->accountRepository->create($validatedData);
            $transactionData = $this->firstTransactionData($account, $validatedData);
            try {
                $this->firstTransaction($transactionData);
            } catch (\Exception $e) {
                $account->delete();
                throw $e;
            } catch (ValidationException $e) {
                $account->delete();
                throw $e;
            }
            return $account;
        });
    }

    /**
     * @param Account $account
     * @param array $validatedData
     * @return array
     */
    private function firstTransactionData(Account $account, array $validatedData): array
    {
        return [
            'type' => $this->credit,
            'amount' => $validatedData['amount'],
            'account_id' => $account->id
        ];
    }

    /**
     * @param array $transactionData
     * @return void
     */
    private function firstTransaction(array $transactionData): void
    {
        $validateData = $this->validationsService->validateData($transactionData);
        $this->createTransactionService->create($validateData);
    }
}
