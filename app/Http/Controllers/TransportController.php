<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;	
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Truck;
use App\Models\Branch;
use App\Models\User;
use App\Models\Load;
use App\Models\Transport;
use App\Models\State;
use App\Models\District;
use Auth;


class TransportController extends Controller
{
    public function __construct()
    {
         
        // $this->checkAuth();
    }
    public function my_truck()
    {
        $trans_id=Auth::user()->user_id;
        $trucks = Truck::find($trans_id)->get();
    	return view('transport.view_truck',['id'=>$trans_id,'trucks'=>$trucks]);

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
    	return view('transport.dashboard',['trucks'=>$data]);
    
    } 

    public function add()
    {
    	return view('master_admin.add_transport',['states'=>State::all()]);
    }
       public function save(Request $request)
    {
    	$request->validate([
    		'name'=>	['required'],
    		'state'=>	['required'],
    		'district' => ['required'],
    		'phone'=>['required','min:10','max:10','unique:transports'],
    		'owner_phone'=>['required','min:10','max:10','unique:transports'],
		    'username' => ['required','unique:users'],
		    'password' => ['required','max:10','min:6'],
		    'address' =>['required']
		]);
    	$transport = new Transport();
    	$transport->name=$request->input('name');
    	$transport->phone=$request->input('phone');
    	$transport->phone=$request->input('owner_phone');
    	$transport->location=$request->input('address');
    	$transport->state=$request->input('state');
    	$transport->district=$request->input('district');
    	$transport->password=$request->input('password');
        $transport->owner_phone=$request->input('owner_phone');

		$transport->admin_id=Auth::user()->user_id;
    	
        $transport->save();
    
    	$trans_id=$transport->id;
    	$user = new User();
    	$user->name=$request->input('name');
    	$user->user_id=$trans_id;
    	$user->role='transport';
    	$user->username=$request->input('username');
    	$user->password=Hash::make($request->input('password'));
    	$user->save();

    	return redirect()->route('transport_view')->with('message', 'Transport Added Successfully');
    }
    public function show()
    {
    	$transports=Transport::all();
    	
    	return view('master_admin.view_transport',['transports'=>$transports]);
    }
    public function get($id)
    {
        $transport = Transport::find($id);
        $login = DB::table('users')->where('user_id','=',$id)->where('role','=','transport')->get();  
        
        
        return view('master_admin.update_transport',['states'=>State::all(),'districts'=>District::all(),'login'=>$login,'transport'=>$transport]);
        
    }
    public function update(Request $request,$id)
    {
        $validator = \Validator::make(request()->all(),[
            'name'=> ['required'],
            'state'=>   ['required'],
            'district' => ['required'],
            'phone'=>['required','min:10','max:10'],
            'owner_phone'=>['required','min:10','max:10'],
            'username' => ['required'],
            'address' =>['required']
        ]);
        $login = DB::table('users')->where('user_id','!=',$id)->where('username','=',$request->input())->count();  
        $transport = DB::table('transports')->where('id','!=',$id)->where('phone','=',$request->input('phone'))->count();  
        $transport_owner = DB::table('transports')->where('id','!=',$id)->where('owner_phone','=',$request->input('owner_phone'))->count();  
        if($login>0)
        {
            $validator->errors()->add('username', 'username name already exists');
        }
        if($transport>0)
        {
            $validator->errors()->add('phone', 'phone number aleady used');
        }     
        if($transport_owner>0)
        {
            $validator->errors()->add('owner_phone', 'phone number aleady used');
        }
        if ($transport>0 || $login>0) {
           return redirect()->route('transport_update',$id)
                        ->withErrors($validator)
                        ->withInput();
        }        
         else
         {
            $transport =Transport::find($id);
            $transport->name=$request->input('name');
            $transport->phone=$request->input('phone');
            $transport->location=$request->input('address');
            $transport->state=$request->input('state');
            $transport->district=$request->input('district');
            $transport->owner_phone=$request->input('owner_phone');
            $transport->save();
            User::where('user_id',$id)->where('role','transport')->update([
                'username'=>$request->input('username'),
                'name'=>$request->input('name')
            ]);
        return redirect()->route('transport_view')->with('message_update', 'Transport updated Successfully');

         }
    }
    public function delete($id)
    {
        $branch = Transport::find($id);
        $branch->delete();
        User::where('user_id',$id)->where('role','transport')->delete();
        return redirect()->route('transport_view')->with('message_delete', 'Transport Deleted Successfully');

    }
}
