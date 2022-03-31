<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'date',
        'customer_nit',
        'seller_nit',
        'total_without_iva',
        'iva',
        'total_with_iva',
    ];

    //Relation with Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_nit', 'nit');
    }

    //Relation with the seller
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_nit', 'nit');
    }

    //Relation with Item
    public function items()
    {
        return $this->hasMany(Item::class, 'invoice_number', 'number');
    }
}
