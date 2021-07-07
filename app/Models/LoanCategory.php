<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCategory extends Model
{
    use HasFactory;
    protected $fillable = ['description','loan_type_id','duration', 'billing_cycle_id', 'period_rate' , 'active'];

    public function loan_type(){
        return $this->belongsTo(LoanType::class);
    }
}
