<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','identification_type_id','identification','credit_limit','partner_id'];


    public function address(){
        return $this->morphOne(Address::class,'addressable');
    }
    public function contact(){
        return $this->morphOne(Contact::class,'contactable');
    }
}
