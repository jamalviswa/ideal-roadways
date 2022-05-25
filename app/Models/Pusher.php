<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pusher extends Model
{
    use HasFactory;
    protected $fillable = ['pusher_id','user_id','role'];

}
