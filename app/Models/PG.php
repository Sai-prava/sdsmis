<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PG extends Model
{
    use HasFactory;
    protected $fillable = [
        'district_id',
        'block_id',
        'gram_panchyat_id',
        'village_id',
        'csp_name',
        'name',
        'date_of_formation',
        'bank_account',
        'branch',
        'code', // IFSC code
    ];
}
