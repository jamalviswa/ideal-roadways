<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    protected $table = 'trucks';
    protected $fillable = [
    						'transport_id',
    						'truck_number',
    						'model',
    						'current_location',
    						'longitude',
    						'latitude',
							'phone'
    					];
	public function MyTransport()
	{
		return $this->belongsTo('App\Models\Transport','transport_id','id');
	}
}
