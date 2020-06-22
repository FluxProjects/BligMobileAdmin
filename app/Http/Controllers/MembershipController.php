<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Membership_plane;
use App\Role_has_permission;
use App\User_role;
use App\Role;
use App\Permission;
use App\AssignMembership;

use Illuminate\Http\Request;

class MembershipController extends Controller
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
    public function Create()
    {
        if( !$this->has_permission(44) ){
            return redirect()->back();   
        }
        $group=Role::where('is_group',false)->get();
    	return view('membership/create',compact('group'));
    }
    public function ViewAll(Request $request)
    {   
        if( !$this->has_permission(45) ){
            return redirect()->back();   
        }
        if( $request->ajax() ){
            $resp=[];
            $resp_temp=[];
            $membership=Membership_plane::all();
            foreach ($membership as $key => $m) {
                $temp=[
                    $key,
                    $m->type==0 ? 'Founder' : 'Invertro',
                    !is_null(Role::where('id',$m->role_group_id)->first()) ? Role::where('id',$m->role_group_id)->first()->name : '',
                    $m->membership_name,
                    $m->membership_cost.' GBP',
                    $m->membership_duration,
                    $m->membership_description,
                    '<div style="white-space: nowrap!important;">
                        <a href="'.url('membership-plane/edit').'/'.$m->id.'" style="font-size:12px!important;position:relative;left:5px" class="px-2 btn btn-dark"><i class="fa fa-edit"></i>
                        </a>
                        <a href="'.url('membership-plane/del').'/'.$m->id.'" style="font-size:12px!important;position:relative;right:5px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
                        </a>
                    </div>'
                ];
                array_push($resp_temp, $temp);
            }
            $resp['data']=$resp_temp;
            return $resp;
        }
    	return view('membership/view_all');
    }
    public function Insert(Request $request)
    {
        if( !$this->has_permission(44) ){
            return redirect()->back();   
        }
        try {
            DB::beginTransaction();
                
                Membership_plane::create([
                    'type' => intval($request->type),
                    'membership_name' => $request->membership_name,
                    'membership_duration' => $request->membership_duration,
                    'membership_cost' => $request->membership_cost,
                    'role_group_id' => intval($request->role),
                    'membership_description' => $request->description,
                ]);

            DB::commit();

            return redirect()->back()->with('success','Membership created successfully');
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function Getuser($type)
    {
    	if( intval($type)==0 ){
    		$user=Entreprenuer::all();
    	}else{
    		$user=Invertor::all();
    	}
    	return $user;
    }
    public function Edit($id)
    {
        if( !$this->has_permission(46) ){
            return redirect()->back();   
        }
        $data=Membership_plane::where('id',$id)->first();
        $group=Role::where('is_group',true)->get();

        // dd($data);
        return view('membership/edit',compact('data','id','group'));
    }

    public function Update(Request $request,$id)
    {
        if( !$this->has_permission(46) ){
            return redirect()->back();   
        }
        Membership_plane::where('id',$id)->update([
            'type' => intval($request->type),
            'membership_name' => $request->membership_name,
            'membership_duration' => $request->membership_duration,
            'membership_cost' => $request->membership_cost,
            'role_group_id' => intval($request->role),
            'membership_description' => $request->description,
        ]);
        return redirect()->back()->with('success','membership updated successfully');
    }
    public function Delete($id)
    {
        if( !$this->has_permission(47) ){
            return redirect()->back();   
        }
        Membership_plane::where('id',$id)->delete();
        return redirect()->back()->with('danger','Membership deleted successfully');
    }
    public function Assign(Request $request)
    {

        try {
           $isExist =AssignMembership::where('user_id',$request->user_id)
                                       ->count();
            if ( $isExist <= 0 ) {
                
                AssignMembership::create([
                    'membership_id' => $request->membership_id,
                    'user_id' => $request->user_id,
                    'created_by' => auth::user()->id,
                    'updated_by' => auth::user()->id,
                ]);
            }else{
                AssignMembership::where('user_id',$request->user_id)
                                ->update([
                                    'membership_id' => $request->membership_id,
                                    'updated_by' => auth::user()->id,
                                ]);
            }
            return 200;
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function Get($user_id)
    {
       $data =AssignMembership::with('_membership')->where('user_id',$user_id)
                                   ->first();
        return $data;
    }
}
