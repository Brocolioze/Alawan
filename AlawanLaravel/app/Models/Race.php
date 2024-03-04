<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'Race';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'race'
    ];
}
