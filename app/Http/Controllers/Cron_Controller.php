<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pusher;
use App\Models\Load;
use App\Models\Truck;
use App\Helper\Helper;

class Cron_Controller extends Controller
{
    public function pusher($data)
	{
		$end_point = 'https://api.webpushr.com/v1/notification/send/sid';
		$http_header = array( 
			"Content-Type: Application/Json", 
			"webpushrKey: ".env('PUSHER_API'), 
			"webpushrAuthToken:".env('PUSHER_TOKEN')
		);
		$req_data = array(
			'title' 			=> $data['title'], //required
			'message' 		=> $data['message'], //required
			'target_url'	=> $data['url'], //required
			'sid'		=> $data['id'] //required
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
		curl_setopt($ch, CURLOPT_URL, $end_point );
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req_data) );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		return $response;
	
	}

	public function send()
	{
		$loads=Load::where('status','view')->where('notification','no')->get();
		// dd($loads);
		foreach($loads as $load)
		{
			$pusher=Pusher::where('role','!=','admin')->where('role','!=','master_admin')->get();
			foreach($pusher as $push)
			{
				$this->pusher([
					'title'=>'Ideal Roadways',
					'message'=>"New Load from ".$load->from_address.' to '.$load->to_address,
					'url'=>asset(''),
					'id'=>$push->pusher_id
				]);

			}
			$L=Load::find($load->id);
			$L->notification='yes';
			$L->save();

			$trucks = Truck::where('status','view')->get();
			foreach($trucks as $truck)
			{
				echo Helper::SendSMS([
					'phone'=> $truck->phone,
					'text' => "New Load from ".$load->from_address.' to '.$load->to_address.'  visit:   '.asset('')
				]);
			}
			
		}
	}
}
