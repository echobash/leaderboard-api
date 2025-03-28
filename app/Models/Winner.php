<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;


class Winner extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'points', 'declared_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
