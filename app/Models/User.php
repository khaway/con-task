<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Concerns\HasContacts;
use Illuminate\Notifications\Notifiable;
use App\Contracts\InteractsWithContacts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements InteractsWithContacts
{
    use HasApiTokens, HasFactory, Notifiable, HasContacts;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['email', 'password',];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime',];
}
