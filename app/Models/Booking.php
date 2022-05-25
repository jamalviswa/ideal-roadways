<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'load_id',
        'truck_id',
    ];

    public function My_load()
    {
    	return $this->belongsTo('App\Models\Load','load_id','id');
    }

    public function My_Truck()
    {
    	return $this->belongsTo('App\Models\Truck','truck_id','id');
    }
    public function post_by()
    {
    	return $this->belongsTo('App\Models\Branch','user_id','id');

    }

    public function cancel_name()
	{
		return $this->belongsTo('App\Models\Branch','cancel_by','id');

	}
}
