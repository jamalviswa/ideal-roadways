<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;	
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\State;
use App\Models\District;
use App\Models\User;
use App\Models\Branch;
class BranchController extends Controller
{
    public function index()
    {
    	return view('master_admin.add_branch',['states'=>State::all()]);
    }

    public function save(Request $request)
    {
    	$request->validate([
    		'branch_name'=>	['required'],
    		'state'=>	['required'],
    		'district' => ['required'],
    		'phone'=>['required','min:10','max:10','unique:branches'],
		    'username' => ['required','unique:users'],
		    'password' => ['required','max:10','min:6'],
		    'address' =>['required']
		]);
    	$branch = new Branch();
    	$branch->name=$request->input('branch_name');
    	$branch->phone=$request->input('phone');
    	$branch->location=$request->input('address');
    	$branch->state=$request->input('state');
    	$branch->district=$request->input('district');
        $branch->password =$request->input('password');
    	$branch->save();
    
    	$branch_id=$branch->id;
    	$user = new User();
    	$user->name=$request->input('branch_name');
    	$user->user_id=$branch_id;
    	$user->role='admin';
    	$user->username=$request->input('username');
    	$user->password=Hash::make($request->input('password'));
    	$user->save();

    	return redirect()->route('branch_view')->with('message', 'Branch Added Successfully');
    }
    public function show()
    {
    	// $branches=Branch::all();
        $branches = DB::table('users')
            ->join('branches', 'users.user_id', '=', 'branches.id')
            ->join('state_tables', 'branches.state', '=', 'state_tables.id')
            ->join('district_tables', 'branches.district', '=', 'district_tables.id')
            ->select('users.username', 'branches.*','state_tables.state','district_tables.district')
            ->where('users.role', '=', 'admin')
            ->get();
    	return view('master_admin.view_branch',['branches'=>$branches]);
    }

    public function get($id)
    {
        $branch = Branch::find($id);
        $login = DB::table('users')->where('user_id','=',$id)->where('role','=','admin')->get();  
        return view('master_admin.update_branch',['states'=>State::all(),'districts'=>District::all(),'login'=>$login,'branch'=>$branch]);
        
    }
    public function update(Request $request,$id)
    {
        $validator = \Validator::make(request()->all(),[
            'branch_name'=> ['required'],
            'state'=>   ['required'],
            'district' => ['required'],
            'phone'=>['required','min:10','max:10'],
            'username' => ['required'],
            'address' =>['required']
        ]);
        $login = DB::table('users')->where('user_id','!=',$id)->where('username','=',$request->input())->count();  
        $branch = DB::table('branches')->where('id','!=',$id)->where('phone','=',$request->input('phone'))->count();  
        if($login>0)
        {
            $validator->errors()->add('username', 'username name already exists');
        }
        if($branch>0)
        {
            $validator->errors()->add('phone', 'phone number aleady used');
        }
        if ($branch>0 || $login>0) {
           return redirect()->route('branch_update',$id)
                        ->withErrors($validator)
                        ->withInput();
        }        
         else
         {
            $branch =Branch::find($id);
            $branch->name=$request->input('branch_name');
            $branch->phone=$request->input('phone');
            $branch->location=$request->input('address');
            $branch->state=$request->input('state');
            $branch->district=$request->input('district');
            $branch->save();
            User::where('user_id',$id)->where('role','admin')->update([
                'username'=>$request->input('username'),
                'name'=>$request->input('branch_name')
            ]);
        return redirect()->route('branch_view')->with('message_update', 'Branch updated Successfully');

         }
    }
    public function delete($id)
    {
        $branch = Branch::find($id);
        $branch->delete();
        User::where('user_id',$id)->where('role','admin')->delete();
        return redirect()->route('branch_view')->with('message_delete', 'Branch Deleted Successfully');

    }
}
