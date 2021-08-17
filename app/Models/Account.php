<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected  $fillable = ['description','active','code'];
    use HasFactory;

    public function sub_accounts(){
        return $this->hasMany(SubAccount::class);
    }
}
