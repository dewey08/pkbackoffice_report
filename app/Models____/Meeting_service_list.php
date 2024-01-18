<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Meeting_service_list extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'meeting_service_list';
    protected $primaryKey = 'meeting_service_list_id';
    protected $fillable = [
        'meeting_service_list_name', 
        'meeting_service_list_qty',
        'meeting_id'
    ];

  
}
