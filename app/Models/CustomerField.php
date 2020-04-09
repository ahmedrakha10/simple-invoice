<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class CustomerField extends Model
{
    protected $table      = 'customer_fields';
    public    $timestamps = true;
    protected $fillable   = ['customer_id', 'field_key', 'field_value'];
}
