<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slogan', 'description', 'logo', 'owner_id'];

    /* Relationships */
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
