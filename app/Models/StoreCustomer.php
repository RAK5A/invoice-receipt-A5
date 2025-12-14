<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address_1',
        'address_2',
        'town',
        'county',
        'postcode',
        'phone',
        'name_ship',
        'address_1_ship',
        'address_2_ship',
        'town_ship',
        'county_ship',
        'postcode_ship',
    ];
}
