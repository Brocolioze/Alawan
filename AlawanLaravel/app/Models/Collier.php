<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collier extends Model
{
    protected $table = 'Collier';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'idCollier',
        'position'
    ];
}
