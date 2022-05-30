<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTitle extends Model
{
    use HasFactory;

    protected $table = 'examtitle';

    protected $fillable = [
        'titleName',
        'exThMks',
        'exPrMks',
        'exThPass',
        'exPrPass',
        'exDur',
        'userID'
    ];
}
