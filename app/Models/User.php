<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }

    public function user(){
        return $this->hasMany(Chat::class);
    }

    public function visibleStatus(){
        return $this->belongsTo(VisibleStatus::class, 'id', 'visible_status_id');
    }

    public function paymentStatus(){
        return $this->belongsTo(PaymentStatus::class, 'id', 'payment_status_id');
    }

    public function usersAvatars(){
        return $this->hasMany(UsersAvatar::class);
    }

    public function countFriends(){
        return $this->wishlists()->where('isFriend', true)->count();
    }

    public function countCollections(){
        return $this->usersAvatars()->count();
    }
}
