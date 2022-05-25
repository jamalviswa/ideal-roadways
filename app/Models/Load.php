<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
     use HasFactory;
    protected $table = 'loads';
    protected $fillable = [
    						'name',
    						'from_address',
    						'to_address',
    						'date',
    						'from_state',
    						'from_district',
    						'from_lng',
    						'from_lat',
    						'from_place_id',
    						'to_state',
    						'to_district',
    						'to_lng',
    						'to_lat',
    						'to_place_id',
    						'distance',
    						'time'
    					];
	public function post_by()
	{
		return $this->belongsTo('App\Models\Branch','admin_id','id');

	}

	public function cancel_name()
	{
		return $this->belongsTo('App\Models\Branch','cancel_by','id');

	}
}
