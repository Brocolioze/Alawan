<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Necklace extends Model
{
    protected $table = 'Necklace';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'idCollier',
        'position'
    ];
}
