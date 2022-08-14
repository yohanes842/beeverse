<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAvatar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function avatar(){
        return $this->belongsTo(Avatar::class);
    }
    public function from(){
        return $this->belongsTo(User::class, 'from_id', 'id');
    }
}
