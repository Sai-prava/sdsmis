<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PgMonthlyProgressReport extends Model
{
    use HasFactory;

    protected $table = 'pg_monthly_progress_reports'; 

    protected $fillable = [
        'user_id',
        'pg_id',
        'month',
        'year',
        'meeting_held',
        'member_presence_percent',
        'input_sale_amount',
        'output_sale_amount',
        'total_sales',
        'loan_taken',
        'loan_returned',
        'interest_paid'
    ];

    public function pg()
    {
        return $this->belongsTo(PG::class, 'pg_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
