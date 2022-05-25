<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\District;
use App\Models\Load;
use Auth;
class LoadController extends Controller
{
	 
    public function add()
    {
    	return view('master_admin.add_load',['states'=>State::all()]);
    }
	public function cancel(Request $request)
	{
		// dd($request->all());

		$id=$request->input('load_id');
		$load =Load::find($id);
		$load->remark=$request->input('remark');
		$load->status="cancel";
		$load->cancel_by=Auth::user()->user_id;
		$load->save();
		
    	return redirect()->route('load-view')->with('message', 'Load Cancelled Successfully');
	}
    public function distance($from,$to)
    {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".urlencode($from)."&destinations=".urlencode($to)."&language=en&key=".env('MAP_API');

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
		   "Accept: application/json",
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		//for debug only!
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$resp = curl_exec($curl);
		curl_close($curl);
		return ($resp);

    }
    public function curl($address)
    {
    	$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=".env('MAP_API');

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
		   "Accept: application/json",
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		//for debug only!
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$resp = curl_exec($curl);
		curl_close($curl);
		return $resp;

    }
    public function save(Request $request)
    {
    	$request->validate([
    		'name'=>	['required'],
    		'from_address'=>	['required'],
    		'to_address' => ['required'],
		    'date' =>['required']
		]);
    	// dd($request->all());
    	$from_address=$request->input('from_address');
    	$to_address=$request->input('to_address');
    	$from =json_decode($this->curl(urlencode($from_address)));
    	$from_lat=($from->results[0]->geometry->location->lat);
    	$from_lng=($from->results[0]->geometry->location->lng);
    	$from_place_id=($from->results[0]->place_id);
    	$from_district=isset($from->results[0]->address_components[1]->long_name) ? $from->results[0]->address_components[1]->long_name : '-1';
    	$from_state=isset($from->results[0]->address_components[2]->long_name) ? $from->results[0]->address_components[2]->long_name : '-1';
    	$to =json_decode($this->curl(urlencode($to_address)));
    	$to_lat=($to->results[0]->geometry->location->lat);
    	$to_lng=($to->results[0]->geometry->location->lng);
    	$to_district=isset($to->results[0]->address_components[1]->long_name) ? $to->results[0]->address_components[1]->long_name : '-1';
    	$to_state=isset($to->results[0]->address_components[2]->long_name) ? $to->results[0]->address_components[2]->long_name : '-1';
    	$to_place_id=($from->results[0]->place_id);
    	// print_r($to_place_id);
    	// save
    	$distance =json_decode($this->distance($from_address,$to_address));
		$distance_km =($distance->rows[0]->elements[0]->distance->text);
		$time = ($distance->rows[0]->elements[0]->duration->text);
    	$load = new Load();
    	$load->name=$request->input('name');
    	$load->from_address=$from_address;
    	$load->to_address=$to_address;
    	$load->date=$request->input('date');
    	$load->from_state =$from_state;
    	$load->from_district = $from_district;
    	$load->from_lng = $from_lng;
    	$load->from_lat = $from_lat;
    	$load->from_place_id = $from_place_id;
    	$load->to_state =$to_state;
    	$load->to_district = $to_district;
    	$load->to_lng = $to_lng;
    	$load->to_lat = $to_lat;
    	$load->to_place_id = $to_place_id;
    	$load->time=$time;
    	$load->distance=$distance_km;
		$load->admin_id=Auth::user()->user_id;
    	$load->save();
    	return redirect()->route('load-view')->with('message', 'Load Added Successfully');

    }
    public function view()
    {
    	$load=Load::where('status','view')->get();
    	return view('master_admin.view_load',['loads'=>$load]);
    }

	public function view_cancel()
    {
    	$load=Load::where('status','cancel')->get();
    	return view('master_admin.view_cancel_load',['loads'=>$load]);
    }
	public function get($id)
    {
        $load = Load::find($id);
        return view('master_admin.update_load',['load'=>$load]);
        
    }
    public function update(Request $request,$id)
    {
		$request->validate([
    		'name'=>	['required'],
    		'from_address'=>	['required'],
    		'to_address' => ['required'],
		    'date' =>['required']
		]);
    	// dd($request->all());
    	$from_address=$request->input('from_address');
    	$to_address=$request->input('to_address');
    	$from =json_decode($this->curl(urlencode($from_address)));
    	$from_lat=($from->results[0]->geometry->location->lat);
    	$from_lng=($from->results[0]->geometry->location->lng);
    	$from_place_id=($from->results[0]->place_id);
    	$from_district=isset($from->results[0]->address_components[1]->long_name) ? $from->results[0]->address_components[1]->long_name : '-1';
    	$from_state=isset($from->results[0]->address_components[2]->long_name) ? $from->results[0]->address_components[2]->long_name : '-1';
    	$to =json_decode($this->curl(urlencode($to_address)));
    	$to_lat=($to->results[0]->geometry->location->lat);
    	$to_lng=($to->results[0]->geometry->location->lng);
    	$to_district=isset($to->results[0]->address_components[1]->long_name) ? $to->results[0]->address_components[1]->long_name : '-1';
    	$to_state=isset($to->results[0]->address_components[2]->long_name) ? $to->results[0]->address_components[2]->long_name : '-1';
    	$to_place_id=($from->results[0]->place_id);
    	// print_r($to_place_id);
    	// save
    	$distance =json_decode($this->distance($from_address,$to_address));
		$distance_km =($distance->rows[0]->elements[0]->distance->text);
		$time = ($distance->rows[0]->elements[0]->duration->text); 
		$load =Load::find($id);
    	$load->name=$request->input('name');
    	$load->from_address=$from_address;
    	$load->to_address=$to_address;
    	$load->date=$request->input('date');
    	$load->from_state =$from_state;
    	$load->from_district = $from_district;
    	$load->from_lng = $from_lng;
    	$load->from_lat = $from_lat;
    	$load->from_place_id = $from_place_id;
    	$load->to_state =$to_state;
    	$load->to_district = $to_district;
    	$load->to_lng = $to_lng;
    	$load->to_lat = $to_lat;
    	$load->to_place_id = $to_place_id;
    	$load->time=$time;
    	$load->distance=$distance_km;
    	$load->save();
    	return redirect()->route('load-view')->with('message', 'Load Updated Successfully');

	}
    public function delete($id)
    {
        $branch = Load::find($id);
        $branch->delete();
        return redirect()->route('load-view')->with('message_delete', 'Load Deleted Successfully');

    }
}
