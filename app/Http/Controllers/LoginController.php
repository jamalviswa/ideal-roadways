<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;	
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Helper\Helper;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    public function View_Login()
    {
    // 	$user = new User;

	   // $user->name = 'Ideal Roadways';
	   // $user->username = 'Ideal';
	   // $user->role = 'master_admin';
	   // $user->password = Hash::make('Ideal12#');
	   // $user->user_id='-1';
	   // $user->save();
    	return view('login');

    }
    public function forgot()
    {
        return view('forgot');

    }
    public function get_password(Request $request)
    {
        // dd($request->all());
        $request->validate([
		    'type' => ['required'],
		    'phone' => ['required'],
		]);

        if($request->input('type')=="truck")
        {
            $otp = rand(10000,99999);
            $truck = DB::table('trucks')->where('phone',$request->input('phone'))->get();
            $user_id = ($truck[0]->id);
            DB::table('users')
              ->where('user_id', $user_id)
              ->where('role', 'truck')
              ->update(['remember_token' => $otp]);
            $sms = Helper::SendSMS([
                'phone'=> $request->input('phone'),
                'text' => "Customer Your OTP ".strval($otp)
            ]);
            $user_data =DB::table('users')
              ->where('user_id', $user_id)
              ->where('role', 'truck')->get();
            
              return redirect()->route('reset-password-view',$user_data[0]->id);
        }
        elseif($request->input('type')=="transport")
        {
            $otp = rand(10000,99999);
            $truck = DB::table('transports')->where('phone',$request->input('phone'))->get();
            $user_id = ($truck[0]->id);
            DB::table('users')
              ->where('user_id', $user_id)
              ->where('role', 'transport')
              ->update(['remember_token' => $otp]);
             Helper::SendSMS([
                'phone'=> $request->input('phone'),
                'text' => "Customer Your OTP ".strval($otp)
            ]);
            $user_data =DB::table('users')
            ->where('user_id', $user_id)
            ->where('role', 'transport')->get();
            return redirect()->route('reset-password-view',$user_data[0]->id);

        }
        else
        {
            $otp = rand(10000,99999);
            $truck = DB::table('branches')->where('phone',$request->input('phone'))->get();
            $user_id = ($truck[0]->id);
            DB::table('users')
              ->where('user_id', $user_id)
              ->where('role', 'admin')
              ->update(['remember_token' => $otp]);

              Helper::SendSMS([
                'phone'=> $request->input('phone'),
                'text' => "Customer Your OTP ".strval($otp)
            ]);
            $user_data =DB::table('users')
            ->where('user_id', $user_id)
            ->where('role', 'admin')->get();
            return redirect()->route('reset-password-view',$user_data[0]->id);

        }

    }

    public function reset_view($id)
    {
        return view('reset_password',['id'=>$id]);

    }
    public function updatePassword($user_data,$password){
        $type =($user_data[0]->role);
        $id = $user_data[0]->user_id;
        if($type=="truck"){
         DB::table('trucks')
            ->where('id', $id)
            ->update([
                    'password' => $password
                ]);
        }elseif($type=="transport"){
            DB::table('transports')
            ->where('id', $id)
            ->update([
                    'password' => $password
                ]);
        }else{
            DB::table('branches')
            ->where('id', $id)
            ->update([
                    'password' => $password
                ]); 
        }
    }
    public function update_password(Request $request)
    {
        $user_data= DB::table('users')
              ->where('id', $request->input('id'))->get();
        $db_otp = $user_data[0]->remember_token;
        $this->validate($request, [
            'otp'=>'required|min:5',
            'password' => 'required|min:6',
            'confirm_password' => 'required|required_with:password|same:password|min:6'
        ]);
        if($db_otp==$request->input('otp'))
        {
            DB::table('users')
            ->where('id', $request->input('id'))
            ->update([
                    'password' => Hash::make($request->input('password')),
                    'remember_token' => NULL
                ]);
            $this->updatePassword($user_data,$request->input('password'));
            return redirect('login')->with("reset_success", "Congratulations! 

            Your password has been changed successfully.");

        }
        else
        {
            return back()->with("otp", "OTP invalid.");
        }
      
    }
    public function login(Request $request)
    {
    	 $request->validate([
		    'username' => ['required'],
		    'password' => ['required'],
		]);
    	 $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // print_r(Auth::user());
            if (Auth::user()->role == 'master_admin') {
                return redirect()->route('master_admin_dashboard');
            }
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin-dashboard');
            }
            if (Auth::user()->role == 'driver') {
                return redirect()->route('driver-dashboard');
            }
            if (Auth::user()->role == 'transport') {
                return redirect()->route('transport-dashboard');
            }
            if (Auth::user()->role == 'truck') {
                return redirect()->route('truck-dashboard');
            }
        }
        else
        {
            return redirect()->back()->withInput($request->only('username', 'password'))->withErrors([
                'login_error' => 'Username and password mismatched !',
            ]);
            // return back()->withErrors(['login_error', 'username and password mismatched!']);
        }
    	// dd($request->all());
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');

    }
    public function home()
    {
            if (!Auth::check()) {
                return redirect()->route('login');
            }
            if (Auth::user()->role == 'master_admin') {
                return redirect()->route('master_admin_dashboard');
            }
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin-dashboard');
            }
            if (Auth::user()->role == 'driver') {
                return redirect()->route('driver-dashboard');
            }
            if (Auth::user()->role == 'transport') {
                return redirect()->route('transport-dashboard');
            }
    }
}
