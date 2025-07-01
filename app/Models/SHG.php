<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SHG extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'date_of_formation',
    ];
}
