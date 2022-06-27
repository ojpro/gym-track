<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid','code', 'card_id', 'first_name', 'last_name',
        'birthday', 'gender', 'weight', 'height', 'address',
        'photo', 'phone', 'username', 'email', 'password'];

    /* Relationships */
    //TODO: gym, current membership
}