<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'Color';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'color'
    ];
}
