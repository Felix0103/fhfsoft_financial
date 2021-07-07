<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    use HasFactory;
    protected $fillable = ['description'];

    public function loan_categories(){
        return $this->hasMany(LoanCategory::class);
    }
}
