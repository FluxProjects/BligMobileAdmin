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
use DB;
use Auth;
use Illuminate\Http\Request;

class EmailUserGroupController extends Controller
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

        if( $request->ajax() ){
            $resp=[];
            $resp_temp=[];
            if (!is_null($request->email_user_group_id)) {
                
                $data=EmailUserGroup::where('id',$request->email_user_group_id)->first();
                $e_users=EmailUser::where('email_user_group_id',$data->id)->get();
                // return $e_users[0]->user_id;
            }
            
            $user=Users2::with('_role')->get();
            $filepath='http://localhost/blig_web/storage/app/public/user_profile_images';
            foreach ($user as $key => $u) {
                if( $u->id!=32 ){
                    $file_name= $u->profile_pic ;
                    $temp=[
                        !empty($e_users[$key]->user_id) == $u->id ?
                        '<input checked value="'.$u->id.'" name="users[]" type="checkbox" class="form-control" style="height:18px">'
                        :
                        '<input value="'.$u->id.'" name="users[]" type="checkbox" class="form-control" style="height:18px">',

                        !is_null($u->_role) ? Role::where('id',$u->_role->role_id)->first()->name : '',
                        $u->first_name.' '.$u->last_name,
                        $u->email,
                        $u->contact_no,
                    ];
                    array_push($resp_temp, $temp);
                }
            }
            $resp['data']=$resp_temp;
            return $resp;
        }
        $role=Role::all();
        $user=User::all();
    	return view('email-group-user/create',compact('role','user'));
    }
    public function Insert(Request $request)
    {
        // if( !$this->has_permission(11) ){
        //     return redirect()->back();   
        // }
    	// dd($request->all());
        // dd( intval($request->event_type) );
    	try {
    		DB::beginTransaction();
    		
    			$email_group=EmailUserGroup::create([
                        'group_name' => $request->group_name,
                    ]);

    			foreach ($request->users as $key => $u) {

					$email_user=EmailUser::create([
		                    'email_user_group_id' => $email_group->id,
		                    'user_id' => $u,
                            'role_id' => !empty($request->role[$key]) ? $request->role[$key] : ''
		                ]);

    			}
    		DB::commit();

    		return redirect()->back()->with('success','User Group created successfully');;
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
    		$event=EmailUserGroup::all();
    		foreach ($event as $key => $e) {
    			$no_of_users=EmailUser::where('email_user_group_id',$e->id)->count();
                $no_of_role=EmailUser::where('email_user_group_id',$e->id)->count();
    			$temp=[
    				$key,
    				$e->group_name,
    				'<span class="badge badge-dark">'.$no_of_role.'</span>',
    				'<span class="badge badge-dark">'.$no_of_users.'</span>',
                    date('d-m-Y',strtotime($e->created_at)),
    				'<a href="'.url('email-user-group/edit').'/'.$e->id.'" style="font-size:12px!important;position:relative;left:5px" class="px-2 btn btn-dark"><i class="fa fa-eye"></i>
    				</a>
    				<a href="'.url('email-user-group/del').'/'.$e->id.'"  style="font-size:12px!important;position:relative;right:5px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
    				</button>'
    			];
    			array_push($resp_temp, $temp);

    		}
    		$resp['data']=$resp_temp;

    		return $resp;
    	}
    	return view('email-group-user/view_all');
    }
    public function Edit($id)
    {
        // if( !$this->has_permission(15) ){
        //     return redirect()->back();   
        // }
    	$data=EmailUserGroup::where('id',$id)->first();
    	$e_users=EmailUser::where('email_user_group_id',$data->id)->get();
    	// dd( $e_users);
    	$role=Role::all();
    	$user=User::all();

        return view('email-group-user.edit',compact('data','id','role','user','e_users'));
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

            return redirect()->back()->with('success','User Group updated successfully');;
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