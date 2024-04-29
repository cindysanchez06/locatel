<?php

namespace App\Services\api\Account;

use App\Models\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ValidationsService
{
    protected mixed $credit;
    protected mixed $debit;

    public function __construct()
    {
        $this->credit = config('api.credit');
        $this->debit = config('api.debit');
    }

    /**
     * @param Account $account
     * @param $amount
     * @param $type
     * @return void
     * @throws ValidationException
     */
    public function validateType(Account $account, $amount, $type): void
    {
        if ($type != $this->credit) {
            $this->validateDebit($account, $amount);
        }
    }

    /**
     * @param Account $account
     * @param $amount
     * @return void
     * @throws ValidationException
     */
    private function validateDebit(Account $account, $amount): void
    {
        if ($account->amount < $amount) {
            $validator = Validator::make([], []);
            $validator->errors()->add('field', 'No tiene suficiente saldo');
            throw new ValidationException($validator);
        }
    }
}
