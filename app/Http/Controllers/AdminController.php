<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Middleware\Admin;
use App\Models\Truck;
use App\Models\Transport;
use App\Models\Load;
use App\Models\Branch;
use App\Models\State;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(admin::class);
    }
   	public function index()
    {
        if(Auth::user()->role=='admin')
        {
            $trucks=Truck::all();
            $data=array();
            foreach($trucks as $truck)
            {
                $temp=[];
                $temp['lat']=$truck->latitude;
                $temp['lng']=$truck->longitude;
                $temp['number']=$truck->truck_number;
                $data[]=$temp;
            }
            $record=array();
            $record['truck']=Truck::all()->count();
            $record['branch']=Branch::all()->count();
            $record['load']=Load::where('status','view')->get()->count();
            $record['transport']=Transport::all()->count();
            
            // die();
            // $data=json_encode($data);
            return view('master_admin.dashboard',['record'=>$record,'trucks'=>$data,'states'=>State::all()]);
    	    // return view('master_admin.dashboard');
        }

        abort(404);
    }
}
