<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'Address';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'city',
        'street',
        'doorNumber',
        'postalCode'
    ];
}
