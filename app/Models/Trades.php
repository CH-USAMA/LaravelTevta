<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trades extends Model
{
    use HasFactory;
    protected $table = 'trades';
    protected $fillable = [
        'tradeCode',
        'tradeName',
        'tradeThMks',
        'tradePrMks',
        'tradeThPass',
        'tradePrPass',
        'tradeDur',
        'userID',
    ];
}
