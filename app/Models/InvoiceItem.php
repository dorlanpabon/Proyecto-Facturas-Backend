<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;


    protected $fillable = [
        'invoice_number',
        'description',
        'quantity',
        'item_id',
        'unit_price',
        'total',
    ];
}
