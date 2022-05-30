<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualCodes extends Model
{
    use HasFactory;
    protected $table = 'qual';
    protected $fillable = [
        'qualCode',
        'qualName',
        'qualStatus',
        'userID',
    ];

}
