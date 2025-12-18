<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'name',
        'email',
        'phone',
        'address',
    ];

    // Relationships
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice', 'invoice');
    }
}
