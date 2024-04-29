<?php

namespace App\Services\api\Transaction;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ValidationsService
{
    /**
     * @param array $data
     * @return array
     */
    public function validateData(array $data): array
    {
        $request = new Request($data);
        $rules = Transaction::$rules;
        $rules['account_id'] = 'required|exists:account,id';
        return $request->validate($rules);
    }
}
