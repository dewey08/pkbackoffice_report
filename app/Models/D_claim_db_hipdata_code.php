<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class D_claim_db_hipdata_code extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // protected $connection = 'mysql7';
    protected $table = 'd_claim_db_hipdata_code';
    protected $primaryKey = 'd_claim_db_hipdata_code_id';
    protected $fillable = [ 
        'mo', 
        'ye',  
        'vn',   
    ];
    public $timestamps = false; 
  
}
