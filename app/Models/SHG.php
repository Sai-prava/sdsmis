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
        'district_id',
        'block_id', 
        'gram_panchyat_id',
        'village_id',
    ];

    // Optional: Relationship
    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
