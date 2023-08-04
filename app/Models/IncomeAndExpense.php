<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeAndExpense extends Model
{
    use HasFactory;
    public function sector()
    {
        return $this->belongsTo(Sector::class,'sector_id');
    }
    public function accountChart()
    {
        return $this->belongsTo(AccountChart::class,'account_chart_id');
    }
}

