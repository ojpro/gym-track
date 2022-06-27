<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'member_id', 'membership_id', 'number', 'started_at', 'expire_at'];

    public function member(){
        return $this->belongsTo(Member::class);
    }
    //TODO: membership
}
