<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['attend_at', 'member_id'];

    /* Relationships */
    public function member(){
        return $this->belongsTo(Member::class);
    }
}
