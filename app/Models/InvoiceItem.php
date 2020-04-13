<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table      = 'invoice_items';
    public    $timestamps = true;
    protected $fillable   = ['invoice_id', 'product_id', 'quantity', 'price'];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
