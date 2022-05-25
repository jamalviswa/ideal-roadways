<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Load;
use App\Models\Truck;
use App\Models\Booking;
use Auth;
class BookingController extends Controller
{
    public function add()
    {
        $trucks=Truck::all();
        $loads=Load::where("status",'view')->get();
    	return view('master_admin.add_booking',['loads'=>$loads,'trucks'=>$trucks]);
    }

    public function cancel(Request $request)
    {
        
		$id=$request->input('load_id');
		$load =Booking::find($id);
		$load->remark=$request->input('remark');
		$load->status="cancel";
		$load->cancel_by=Auth::user()->user_id;
		$load->save();
        return redirect()->route('view-booking')->with('message_update', 'Load Booked Successfully');
		
    }
    
    public function save(Request $request)
    {
        
        $request->validate([
    		'truck'=>	['required'],
    		'load'=>	['required'],
		]);
        
        $book= new Booking();
        $book->user_id=Auth::user()->user_id;
        $book->truck_id=$request->input('truck');
        $book->load_id=$request->input('load');
        $book->save();
        $load=Load::find($request->input('load'));
        $load->status='booked';
        $load->save();
        return redirect()->route('view-booking')->with('message_update', 'Load Booked Successfully');

    }
    public function show()
    {
    	$load=Booking::where('status','view')->get();

        return view('master_admin.view_booking',['bookings'=>$load]);
       
    }

    public function show_cancel()
    {
    	$load=Booking::where('status','cancel')->get();

        return view('master_admin.view_cancel_booking',['bookings'=>$load]);
       
    }
}
