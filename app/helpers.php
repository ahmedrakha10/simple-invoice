<?php

/**
 * Created by PhpStorm.
 * User: bg
 * Date: 3/28/2020
 * Time: 1:29 AM
 */
Class Helper
{

    static function generateInvoiceNumber()
    {
        $invoiceNumber =  date('Y').'-' .rand('0000', '9999');

        $record = \App\Models\Invoice::where('invoice_number', $invoiceNumber)->first();

        if ($record) {
            self::generateInvoiceNumber();
        } else {
            return $invoiceNumber;
        }
    }

}
