<?php

namespace App\Http\Controllers;
use App\E_q_categorie;
use App\I_q_categorie;
use App\Role_has_permission;
use App\User_role;
use App\Role;
use App\Permission;
use App\Event;
use App\User;
use App\Users2;
use App\EmailUser;
use App\EmailUserGroup;
use App\EmailTemp;
use DB;
use Auth;
use Illuminate\Http\Request;

class EventTempController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function has_permission($permission_id)
    {
        $user_role=User_role::where('user_id',Auth::user()->id)->get();
        $is_allow=false;
        foreach ($user_role as $key => $ur) {
            
            $user_role=Role_has_permission::where('role_id',$ur->role_id)
            ->where('permission_id',$permission_id)
            ->count();
            if( $user_role > 0 ){
                $is_allow=true;
            }
        }
        if( auth::user()->id==32 ){
            $is_allow=true;
        }
        return $is_allow;
    }
    public function Create(Request $request)
    {
        // if( !$this->has_permission(11) ){
        //     return redirect()->back();   
        // }

        $event=Event::all();
    	return view('email_temp/create',compact('event'));
    }
    public function Insert(Request $request)
    {
        // if( !$this->has_permission(11) ){
        //     return redirect()->back();   
        // }
    	try {
    		DB::beginTransaction();
    		
    			$email_temp=EmailTemp::create([
                        'name' => $request->temp_name,
                        'subject' => $request->subject,
                        'event_id' => $request->_event,
                        'desc' => json_encode($request->_temp),
                    ]);

    		DB::commit();

    		return redirect()->back()->with('success','Templete created successfully');;
    	} catch (Exception $e) {
    		dd($e);
    	}
    }
    public function ViewAll(Request $request)
    {
        // if( !$this->has_permission(12) ){
        //     return redirect()->back();   
        // }

    	if( $request->ajax() ){
    		$resp=[];
    		$resp_temp=[];
    		$event=EmailTemp::all();
    		foreach ($event as $key => $e) {
    			$temp=[
    				$key,
    				$e->name,
    				$e->subject,
    				$e->event_id,
                    date('d-m-Y',strtotime($e->created_at)),
    				'<a href="" style="font-size:12px!important;position:relative;left:5px" class="px-2 btn btn-dark"><i class="fa fa-eye"></i>
    				</a>
    				<a href=""  style="font-size:12px!important;position:relative;right:5px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
    				</button>'
    			];
    			array_push($resp_temp, $temp);

    		}
    		$resp['data']=$resp_temp;

    		return $resp;
    	}
    	return view('email_temp/view_all');
    }
    public function Edit($id)
    {
        // if( !$this->has_permission(15) ){
        //     return redirect()->back();   
        // }
    	// $data=EmailUserGroup::where('id',$id)->first();
    	$event=Event::all();
        $data=EmailTemp::where('id',$id)->first();
        // dd($data);
        return view('email_temp.edit',compact('event','data','id'));
    }
    public function Update(Request $request,$id)
    {
        // if( !$this->has_permission(15) ){
        //     return redirect()->back();   
        // }
	   try {
            DB::beginTransaction();
            
                $email_temp=EmailTemp::where('id',$id)->update([
                        'name' => $request->temp_name,
                        'subject' => $request->subject,
                        'event_id' => $request->_event,
                        'desc' => json_encode($request->_temp),
                    ]);

            DB::commit();

            return redirect()->back()->with('success','Templete updated successfully');;
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function Delete($id)
    {
     //    if( !$this->has_permission(14) ){
     //        return redirect()->back();   
     //    }
    	// if( intval($type) == 0 ){
    	// 	$e_cat=E_q_categorie::where('id',$cat_id)->delete();
    	// }else{
    	// 	$e_cat=I_q_categorie::where('id',$cat_id)->delete();
    	// }
    	return redirect()->back()->with('error','Event Deleted successfully');
    }
}