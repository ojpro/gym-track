<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'username', 'email', 'password', 'gym_id'];

    protected $hidden = [
        'password'
    ];
    /* Relationships */

    public function gym(){
        return $this->belongsTo(Gym::class);
    }
}
