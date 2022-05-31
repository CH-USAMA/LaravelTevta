<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrengthSession extends Model
{
    use HasFactory;
    protected $table = 'sessionstrength';
    protected $fillable = [
        'session_name',
        'strength',
    ];
}
