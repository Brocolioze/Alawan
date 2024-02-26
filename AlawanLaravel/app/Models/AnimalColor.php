<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalColor extends Model
{
    protected $table = 'AnimalColor';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'idAnimal',
        'idColor'
    ];

    public function animal()
    {
        return $this->belongsTo('App\Models\Animal', 'idAnimal');
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Color', 'idColor');
    }
}
