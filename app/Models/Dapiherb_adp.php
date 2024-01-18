<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Dapiherb_adp extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'dapiherb_adp';
    protected $primaryKey = 'dapiherb_adp_id';
    protected $fillable = [
        'blobName',
        'blobType',
        'blob'         
    ];

  
}
