<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected  $fillable = ['address_id','address_model','description','country_id','state_id','city_id'];

    public function addressable(){
        return $this->morhTo();
    }
}
