<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'Person';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'idAddress',
        'name',
        'lastName',
        'email',
        'password',
        'phone',
        'invite',
        'admin',
        'creationDate'
    ];

    public function address()
    {
        return $this->belongsTo('App\Models\Address', 'idAddress');
    }
}
