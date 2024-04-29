<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'account';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_name',
        'amount',
        'account_number',
    ];

    /**
     * @var array|string[]
     */
    public static array $rules = [
        'user_name' => 'required|min:5|unique:account,user_name|regex:/^[\pL\s\-0-9]+$/u',
        'amount' => 'required|numeric|min:0|max:5000000',
        'account_number' => 'required|min:10|unique:account,account_number|regex:/^[0-9]+$/',
    ];
}
