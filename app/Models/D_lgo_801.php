<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class D_lgo_801 extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; 
    protected $table = 'd_lgo_801';
    protected $primaryKey = 'd_lgo_801_id';
    protected $fillable = [ 
        'vn', 
        'an',  
        'hn',   
    ];
    public $timestamps = false; 
  
}
