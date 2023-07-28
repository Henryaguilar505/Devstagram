<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'follower_id'
    ];

    public function followers()
   {
    return $this->hasMany(Follower::class, 'user_id');
   }

}
