<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    public function usersAvatars(){
        return $this->hasMany(UsersAvatar::class);
    }
}
