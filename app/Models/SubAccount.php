<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAccount extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'account_id', 'active'];
    public function account(){
        return $this->belongsTo(Account::class);
    }
}
