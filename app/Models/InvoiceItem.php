<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table      = 'invoice_items';
    public    $timestamps = true;
    protected $fillable   = ['invoice_id', 'name', 'quantity', 'price'];
}
