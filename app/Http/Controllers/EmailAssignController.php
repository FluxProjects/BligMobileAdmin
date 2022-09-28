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
use App\AssignModel;
use DB;
use Auth;
use Illuminate\Http\Request;

class EmailAssignController extends Controller
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

        $event_temp=EmailTemp::all();
        $group=EmailUserGroup::all();
    	return view('email_assign/create',compact('event_temp','group'));
    }
    public function Insert(Request $request)
    {
        // if( !$this->has_permission(11) ){
        //     return redirect()->back();   
        // }
        // dd($request->trigger);
    	try {
    		DB::beginTransaction();
    		
    			$email_temp=AssignModel::create([
                        'temp_id' => $request->templete,
                        'user_group_id' => $request->user_group,
                        'trigger_id' => $request->trigger,
                    ]);
                // dd($email_temp);

    		DB::commit();

    		return redirect()->back()->with('success','Assigned successfully');;
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
    		$assign=AssignModel::all();
    		foreach ($assign as $key => $a) {
    			$temp=[
    				$key,
    				EmailTemp::where('id',$a->temp_id)->first()->name,
    				EmailUserGroup::where('id',$a->user_group_id)->first()->group_name,
    				$a->trigger_id,
                    date('d-m-Y',strtotime($a->created_at)),
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
    	return view('email_assign/view_all');
    }
    public function Edit($id)
    {
        // if( !$this->has_permission(15) ){
        //     return redirect()->back();   
        // }
    	// $data=EmailUserGroup::where('id',$id)->first();
    	$event=Event::all();

        return view('email_temp.edit',compact('event'));
    }
    public function Update(Request $request,$id)
    {
        // if( !$this->has_permission(15) ){
        //     return redirect()->back();   
        // }
        // dd($request->all());
	   try {
            DB::beginTransaction();
                $email_group=EmailUserGroup::where('id',$id)->update([
                        'group_name' => $request->group_name,
                    ]);

                EmailUser::where('email_user_group_id',$id)->delete();
                foreach ($request->users as $key => $u) {

                    $email_user=EmailUser::create([
                            'email_user_group_id' => $id,
                            'user_id' => $u,
                            'role_id' => !empty($request->_role[$key]) ? $request->_role[$key] : ''
                        ]);

                }
            DB::commit();

            return redirect()->back()->with('success','Event created successfully');;
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
