<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Person extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function address()
    {
        return $this->belongsTo('App\Models\Address', 'idAddress');
    }
}
