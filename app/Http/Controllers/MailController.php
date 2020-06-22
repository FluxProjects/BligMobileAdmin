<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\User_role;
use App\AssignModel;
use App\EmailTemp;
use App\Event;
use App\EmailUser;
use App\User;
class MailController extends Controller
{
	public function DSend($data)
	{
			$templete=EmailTemp::where('id',$data->temp_id)->first();
			$event_data=Event::where('id',$templete->event_id)->first();
			$users=EmailUser::where('email_user_group_id',$data->user_group_id)
							->where('user_id','!=',null)->get();
			$roles=EmailUser::where('email_user_group_id',$data->user_group_id)
							->where('role_id','!=',null)->get();
							
			foreach ($users as $key => $u) {
				$user=User::where('id',$u->user_id)->first();

				Mail::send(['html' => 'mail'],['temp_data' => $templete,'user' => $user,'event_data' => $event_data], function ($message) use($user,$templete) {
				    $message->from('aunrizvi16@gmail.com', 'BLIG');    
				    $message->to($user->email, 'BLIG');   
				    $message->subject($templete->subject);
				});
			}
			foreach ($roles as $key => $r) {
				$users=User_role::with('_user_name')->where('role_id',$r->role_id)->get();
				foreach ($users as $key1 => $u) {

					Mail::send(['html' => 'mail'],['temp_data' => $templete,'user' => $u->_user_name,'event_data' => $event_data], function ($message) use($u,$templete) {
					    $message->from('aunrizvi16@gmail.com', 'BLIG');    
					    $message->to($u->_user_name->email, 'BLIG');   
					    $message->subject($templete->subject);
					});
				}
			}
		    
	}
	public function Send($trigger_id)
	{
		$data=AssignModel::where('trigger_id',$trigger_id)->get();
		foreach ($data as $key => $d) {
			$this->DSend($d);
		}
	}
}
