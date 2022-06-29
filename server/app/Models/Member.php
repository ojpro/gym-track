<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'code', 'card_id', 'first_name', 'last_name',
        'birthday', 'gender', 'weight', 'height', 'address',
        'photo', 'phone', 'username', 'email', 'password'];

    /* Relationships */
    //TODO: gym, current membership

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function latestSubscription()
    {
        return $this->hasOne(Subscription::class)->latestOfMany();
    }

    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class)->where(['status' => 'current']);
    }

    public function currentMembership()
    {
        return $this->belongsToMany(Membership::class, 'subscriptions')
            ->where(['status' => 'current']);
    }
}
