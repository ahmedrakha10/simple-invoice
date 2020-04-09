<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table      = 'invoices';
    public    $timestamps = true;
    protected $fillable   = ['customer_id', 'invoice_number', 'invoice_date', 'tax_percent'];
    //protected $appends    = ['total_amount'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getTotalAmountAttribute()
    {
        $total = 0;
        foreach ($this->invoiceItems as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total;
    }
}
