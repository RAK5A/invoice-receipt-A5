<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'custom_email',
        'invoice_date',
        'invoice_due_date',
        'subtotal',
        'discount',
        'vat',
        'total',
        'notes',
        'invoice_type',
        'status',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'vat' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Relationships
    public function customer()
    {
        return $this->hasOne(Customer::class, 'invoice', 'invoice');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice', 'invoice');
    }
}
