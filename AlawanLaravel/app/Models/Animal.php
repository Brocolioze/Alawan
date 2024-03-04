<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table = 'Animal';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'idPerson',
        'idRace',
        'idCollier',
        'name',
        'picture',
        'birth',
        'research'
    ];

    public function person()
    {
        return $this->belongsTo('App\Models\Person', 'idPerson');
    }

    public function race()
    {
        return $this->belongsTo('App\Models\Race', 'idRace');
    }

    public function collier()
    {
        return $this->belongsTo('App\Models\Collier', 'idCollier');
    }
}
