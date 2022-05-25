<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
class DistrictController extends Controller
{
    public function get(Request $req)
    {
    	$output='<option>Select District</option>';
    	$districts=District::where('state_id',$req->input('state'))->get();
    	foreach ($districts as $district) {
    		$output.='<option value="'.$district->id.'">'.$district->district.'</option>';
    	}
    	echo $output;
    }
}
