<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';


    protected $fillable = [
        'type',
        'amount',
        'account_id',
    ];

    public static array $rules = [
        'type' => 'required|in:credit,debit',
        'amount' => 'required|numeric|min:0',
    ];
}
