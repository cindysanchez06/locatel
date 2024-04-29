<?php

namespace App\Services\api\Account;

use App\Models\Account;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

class UpdateAccountService
{
    /**
     * @var mixed|Repository|Application|\Illuminate\Foundation\Application
     */
    protected mixed $credit;
    /**
     * @var mixed|Repository|Application|\Illuminate\Foundation\Application
     */
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
     */
    public function updateBalance(Account $account, $amount, $type): void
    {
        if ($type == $this->credit) {
            $account->amount += $amount;
        }
        if ($type == $this->debit) {
            $account->amount -= $amount;
        }
        $account->save();
    }
}
