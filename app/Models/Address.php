<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "phone",
        "state",
        "city",
        "pincode",
        "address",
        "address_type",
    ];
}
