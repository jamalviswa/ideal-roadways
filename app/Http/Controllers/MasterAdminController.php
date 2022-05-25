<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\MasterAdmin;
use Illuminate\Support\Facades\Auth;
use App\Models\Truck;
use App\Models\Transport;
use App\Models\Load;
use App\Models\Branch;
use App\Models\State;

class MasterAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(masterAdmin::class);
    }
    public function index()
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
    }
}
