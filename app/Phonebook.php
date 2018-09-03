<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
    protected $table = 'phonebooks';
    protected $fillable = [
        'name', 'phone', 'email','age',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
