<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;	
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Rule;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\District;
use App\Models\User;
use App\Models\Transport;
use App\Models\Truck;
use App\Models\Load;
use Illuminate\Support\Facades\Auth;
class TruckController extends Controller
{
	public function index($id)
	{
	    	$trucks = DB::table('transports')
            ->where('id', $id)->get();
            
    	return view('master_admin.add_truck',['transport_id'=>$id,'name'=>$trucks[0]->name]);

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
	public function save($id,Request $request)
	{
		$request->validate([
    		'truck_number'=>	['required','unique:trucks'],
    		'model'=>	['required'],
    		'name' =>['required'],
    		'd_name' =>['required'],
		    'username' => ['required','unique:users'],
		    'password' => ['required','max:10','min:6'],
		    'address' =>['required'],
    		'phone'=>['required','min:10','max:10','unique:trucks'],
			
		]);

		$truck = new Truck();

		$truck->transport_id=$id;
		$truck->truck_number=$request->input('truck_number');
		$truck->model=$request->input('model');
		$truck->current_location=$request->input('address');
		$truck->admin_id=Auth::user()->user_id;
		$truck->phone=$request->input('phone');
		$truck->d_name=$request->input('d_name');
		$truck->password=($request->input('password'));
		$truck->save();
    	$truck_id=$truck->id;
		$user = new User();
    	$user->name=$request->input('name');
    	$user->user_id=$truck_id;
    	$user->role='truck';
    	$user->username=$request->input('username');
    	$user->password=Hash::make($request->input('password'));
    	$user->save();
    	return redirect()->route('view-truck',['id'=>$id])->with('message', 'Transport Added Successfully');

	}
	public function reset_password($id)
	{
		$user_data =DB::table('users')
		->where('user_id', $id)
		->where('role', 'truck')->get();
		$user_id = $user_data[0]->id;
		$otp = rand(10000,99999);
		DB::table('users')
		->where('id', $user_id)
		->update([
				'password' => Hash::make($otp),
				
		]);
		DB::table('trucks')->where('id',$id)->update([
			'password'=>$otp
		]);
		$trucks = DB::table('trucks')->where('id',$id)->get();
		$id = $trucks[0]->transport_id;
		return redirect()->route('view-truck',[$id])->with('message_update', 'Truck password updated Successfully');

	}
	public function get_address($lat,$long)
    {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&key=".env('MAP_API');
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
	public function show($id)
	{
		$trucks = DB::table('trucks')
            ->where('transport_id', $id)->get();
    	return view('master_admin.view_truck',['id'=>$id,'trucks'=>$trucks,'states'=>State::all()]);

	}

	public function dashboard()
	{
        $truck=Truck::find(Auth::user()->user_id);
        $my_location=[$truck->latitude,$truck->longitude,$truck->current_location];

        // $my_location=[$truck->latitude,$truck->longitude];
        $loads=DB::table('loads')->where('status','view')->simplePaginate(5);
		$loads_arr=[];
		foreach ($loads as $user)
		{
		  //  echo $truck->current_location;
			$distance =json_decode($this->distance($truck->current_location,$user->from_address));
// 			dd($distance);
			$distance_km =round(($distance->rows[0]->elements[0]->distance->value)/1000);
		
			// $distance_km =($distance->rows[0]->elements[0]->distance->text);
			$temp=[];
			$temp['id']=$user->id;
			$temp['name']=$user->name;
			$temp['from_address']=$user->from_address;
			$temp['to_address']=$user->to_address;
			$temp['distance']=$user->distance;
			$temp['distance_1']=$distance_km;
			if($user->admin_id==-1)
			{
				$temp['post_by']='Admin';
				$temp['call']=env('APP_NUMBER');
			}
			else
			{
				$temp['post_by']=$user->post_by->name;
				$temp['call']=$user->post_by->mobile;
			}
			$loads_arr[]=($temp);
			 
		} 
		for($i=0;$i<count($loads_arr);$i++)
		{
			for($j=$i;$j<count($loads_arr);$j++)
			{
				if($loads_arr[$i]['distance_1']>$loads_arr[$j]['distance_1'])
				{
					$temp=$loads_arr[$i];
					$loads_arr[$i]=$loads_arr[$j];
					$loads_arr[$j]=$temp;
				}
			}
		}
    	return view('truck.dashboard',['my_location'=>$my_location,'loads'=>$loads,'data'=>$loads_arr]);

	}
	public function update_truck_location(Request $request)
	{
        $lat=$request->input('lat');
        $long=$request->input('long');
		$data=json_decode($this->get_address($lat,$long));
		$address=($data->results[0]->formatted_address);
        $truck=Truck::find(Auth::user()->user_id);
        $truck->current_location=$address;
        $truck->latitude=$lat;
        $truck->longitude=$long;
        $truck->save();
        
        $truck=Truck::find(Auth::user()->user_id);
        $my_location=[$truck->latitude,$truck->longitude,$truck->current_location];

        // $my_location=[$truck->current_location,$truck->latitude,$truck->longitude];
        // return view('truck.dashboard',['my_location'=>$my_location]);
        $loads=DB::table('loads')->where('status','view')->simplePaginate(5);
		$loads_arr=[];
		foreach ($loads as $user)
		{
			$distance =json_decode($this->distance($truck->current_location,$user->from_address));
			$distance_km =round(($distance->rows[0]->elements[0]->distance->value)/1000);
			
			//$distance_km =($distance->rows[0]->elements[0]->distance->text);
			$temp=[];
			$temp['id']=$user->id;

			$temp['name']=$user->name;
			$temp['from_address']=$user->from_address;
			$temp['to_address']=$user->to_address;
			$temp['distance']=$user->distance;
			$temp['distance_1']=$distance_km;
			// $temp['contact']
			if($user->admin_id==-1)
			{
				$temp['post_by']='Admin';
				$temp['call']=env('APP_NUMBER');
			}
			else
			{
				$temp['post_by']=$user->post_by->name;
				$temp['call']=$user->post_by->mobile;
			}
			$loads_arr[]=($temp);
			 
		} 
	 
 
			for($i=0;$i<count($loads_arr);$i++)
			{
				for($j=$i;$j<count($loads_arr);$j++)
				{
					if($loads_arr[$i]['distance_1']>$loads_arr[$j]['distance_1'])
					{
						$temp=$loads_arr[$i];
						$loads_arr[$i]=$loads_arr[$j];
						$loads_arr[$j]=$temp;
					}
				}
			}
		return redirect()->route('truck-dashboard')
        ->with('my_location',$my_location)
        ->with('loads',$loads);

	}
	public function get($id)
	{
		$truck = Truck::find($id);
        // $loads=
        $login = DB::table('users')->where('user_id','=',$id)->where('role','=','truck')->get();  

		if(Auth::user()->role=='transport')
        {
        return view('transport.update_truck',['states'=>State::all(),'districts'=>District::all(),'login'=>$login,'trucks'=>$truck]);
		}
        return view('master_admin.update_truck',['states'=>State::all(),'districts'=>District::all(),'login'=>$login,'trucks'=>$truck]);

	}
	 public function update(Request $request,$id)
    {
        $validator = \Validator::make(request()->all(),[
          	'number'=>	['required'],
    		'model'=>	['required'],
		    'username' => ['required'],
		    'address' =>['required'],
		    'name' =>['required'],
		    'd_name' =>['required'],
    		'phone'=>['required','min:10','max:10','unique:trucks'],

        ]);
        $login = DB::table('users')->where('user_id','!=',$id)->where('username','=',$request->input())->count();  
        $transport = DB::table('trucks')->where('id','!=',$id)->where('truck_number','=',$request->input('number'))->count();  
        if($login>0)
        {
            $validator->errors()->add('username', 'username name already exists');
        }
        if($transport>0)
        {
            $validator->errors()->add('number', 'Truck number  aleady used');
        }
        if ($transport>0 || $login>0) {
           return redirect()->route('truck_update',$id)
                        ->withErrors($validator)
                        ->withInput();
        }        
         else
         {
 			$truck = Truck::find($id);
 			$truck->truck_number=$request->input('number');
 			$truck->model=$request->input('model');
 			$truck->phone=$request->input('phone');
 			$truck->d_name=$request->input('d_name');
 			$truck->current_location=$request->input('address');
 			$truck->save();
            User::where('user_id',$id)->where('role','truck')->update([
                'username'=>$request->input('username')  , 
                  'name'=>$request->input('name')

                           ]);
		if(Auth::user()->role!='transport')
		{
			return redirect()->route('view-truck',[$truck->transport_id])->with('message_update', 'Transport updated Successfully');

		}
        return redirect()->route('my_trucks')->with('message_update', 'Transport updated Successfully');

         }
    }
    public function delete($id)
    {
        $branch = Truck::find($id);
        $branch->delete();
        User::where('user_id',$id)->where('role','transport')->delete();
        return redirect()->route('view-truck',[$branch->transport_id])->with('message_delete', 'Transport Deleted Successfully');

    }
	public function search()
	{
		$trucks =Truck::all();
		return view('master_admin.search_result',['trucks'=>$trucks]);

	}
	public function search_truck(Request $request)
	{
		$request->validate([
    		 'truck_number'=>	['required'],
    		 
		]);

		$trucks =Truck::all();
		$truck_number = $request->input('truck_number');
		$i=0;
		$max_distance=$request->input('transport');
		$results=[];
		foreach($trucks as $truck)
		{
			$distance =json_decode($this->distance($truck->truck_number,$truck_number));
			$distance_km =round(($distance->rows[0]->elements[0]->distance->value)/1000);
			if($distance_km>$max_distance)
			{
				continue;
			}
			$temp=[];
			$temp['transport_name']=$truck->MyTransport->name;
			$temp['transport_mobile']=$truck->MyTransport->phone;
			$temp['truck_number']=$truck->truck_number;
			$temp['truck_mobile']=$truck->phone;
			$temp['truck_model']=$truck->model;
			$temp['truck_location']=$truck->current_location;
			$temp['distance']=$distance_km;
			$results[]=$temp;
		}
		for($i=0;$i<count($results);$i++)
		{
			for($j=$i;$j<count($results);$j++)
			{
				if($results[$i]['distance']>$results[$j]['distance'])
				{
					$temp=$results[$i];
					$results[$i]=$results[$j];
					$results[$j]=$temp;
				}
			}

		}
		$arr=[
			$location,$max_distance
		];
		return view('master_admin.search_result',['results'=>$results,'info'=>$arr]);
        // return redirect()->route('search_truck',[$results])->with('Search', 'Search Result');

	}
}
