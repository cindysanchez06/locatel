<?php

namespace App\Services\api\Account;


class AccountService
{
    /**
     * @param $length
     * @return string
     */
    function generateNumberAccount($length): string
    {
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= rand(0, 9);
        }

        return $result;
    }

}
