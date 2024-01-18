<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Plan_vision extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'plan_vision';
    protected $primaryKey = 'plan_vision_id';
    protected $fillable = [
        'plan_vision_name'
      
    ];

  
}
