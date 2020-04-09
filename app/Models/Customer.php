<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    public $timestamps = true;
    protected $fillable = ['name','address','postcode','city','state','country','phone','email'];
}
