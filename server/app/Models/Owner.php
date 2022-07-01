<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'phone', 'email', 'password'];

    protected $hidden = [
        'password'
    ];
    /* Relationships */

    public function gyms(){
        return $this->hasMany(Gym::class);
    }
}
