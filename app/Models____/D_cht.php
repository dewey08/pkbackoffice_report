<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class D_cht extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $connection = 'mysql7';
    protected $table = 'd_cht';
    protected $primaryKey = 'd_cht_id';
    protected $fillable = [ 
        'HN', 
        'AN',  
        'DATE',  
        'TOTAL',
        'PAID',
        'PTTYPE', 
        'PERSON_ID',
        'SEQ' 
    ];

  
}
