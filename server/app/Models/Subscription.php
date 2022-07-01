<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'member_id', 'membership_id', 'number', 'started_at', 'expire_at'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function attendances(){
        return $this->member()->with(['attendances'=>function($query){
            $query->whereBetween('attendances.attend_at',[$this->started_at,$this->expire_at]);
        }]);
    }
}
