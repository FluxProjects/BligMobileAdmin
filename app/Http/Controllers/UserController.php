<?php

namespace App\Http\Controllers;
use App\Role;
use App\Users2;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use Config;
use App\Role_has_permission;
use App\User_role;
use App\Web_countrie;
use App\Web_state;
use App\Web_citie;
use App\Membership_plane;
use App\AssignMembership;
class UserController extends Controller
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
        if( !$this->has_permission(2) ){
            return redirect()->back();   
        }
        $country= Web_countrie::with('_state')->get();
        $role=Role::all();
        return view('users/create',compact('role','country'));
    }
    public function Insert(Request $request)
    {
        if( !$this->has_permission(2) ){
            return redirect()->back();   
        }
        // dd($request->all());

        $filename = "";
        if($request->hasFile('file'))
        {
            $filename = $request->file->getClientOriginalName();
            $request->file->storeAs('public/user_profile_images',$filename);
        }
        DB::beginTransaction();
    	$user=Users2::create([
    		'first_name' => $request->f_name,
    		'last_name' => $request->l_name ,
    		'email' => $request->email ,
            'contact_no' => $request->phone ,
            'address1' => $request->address ,
            'country_id' => $request->country ,
            'state_id' => $request->state ,
            'city_id' => $request->city ,
            'latitude' => $request->lat ,
            'longitude' => $request->long ,
            'profile_pic' => $filename,
            'password' => Hash::make($request->password),

    	]);

        $user_role=User_role::create([
            'user_id' => $user->id,
            'role_id' => intval($request->role) ,
            'created_by' => auth::user()->id ,
            'updated_by' => auth::user()->id ,
        ]);

        DB::commit();
    	
        $role=Role::all();
        return redirect()->back()->with('success','User created successfully');
    	
    }
    public function ViewAll(Request $request)
    {
        if( !$this->has_permission(2) ){
            return redirect()->back();   
        }
        if( $request->ajax() ){
            $resp=[];
            $resp_temp=[];
            $user=Users2::with('_role')->get();
            $filepath='http://localhost/blig_web/storage/app/public/user_profile_images';
            foreach ($user as $key => $u) {
                if( $u->id!=32 ){
                    $file_name= $u->profile_pic ;
                    $temp=[
                        $key,
                        '<img style="width:100%" src="http://localhost/blig_web/storage/app/public/user_profile_images/'.$file_name.'">',
                        !is_null($u->_role) ? Role::where('id',$u->_role->role_id)->first()->name : '',
                        $u->first_name.' '.$u->last_name,
                        $u->email,
                        $u->contact_no,
                        $u->address1,
                        $u->latitude,
                        $u->longitude,
                        '<div style="display:flex">
                            <a onclick="get_user_details('.$u->id.')" data-toggle="modal" data-target="#_user_model" style="font-size:12px!important;position:relative;left:10px" class="px-2 btn btn-dark"><i class="fas fa-eye text-white"></i>
                            </a>
                            <a href="'.url('user/edit').'/'.$u->id.'" style="font-size:12px!important;position:relative;left:3px" class="px-2 btn btn-dark"><i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="'.url('user/del').'/'.$u->id.'" style="font-size:12px!important;position:relative;right:1px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
                            </a>
                        </div>'
                    ];
                    array_push($resp_temp, $temp);
                }
            }
            $resp['data']=$resp_temp;
            return $resp;
        }

        return view('users/view_all');
    }
    public function Edit($user_id)
    {
        if( !$this->has_permission(4) ){
            return redirect()->back();   
        }
        $user=Users2::with('_role','_country','_city','_state')->where('id',$user_id)->first();
        $role=Role::all();
        $country= Web_countrie::with('_state')->get();
        $state= Web_state::all();
        $city= Web_citie::all();
        return view('users.edit',compact('role','user','user_id','country','city','state'));
    }
    public function Update(Request $request)
    {
        if( !$this->has_permission(4) ){
            return redirect()->back();   
        }
            $filename = "";
            if($request->hasFile('file'))
            {
                $filename = $request->file->getClientOriginalName();
                $request->file->storeAs('public/user_profile_images',$filename);
            }
            DB::beginTransaction();
            $user=Users2::where('id',$request->user_id)->update([
                'first_name' => $request->f_name,
                'last_name' => $request->l_name ,
                'email' => $request->email ,
                'contact_no' => $request->phone ,
                'address1' => $request->address ,
                'country_id' => $request->country ,
                'state_id' => $request->state ,
                'city_id' => $request->city ,
                'latitude' => $request->lat ,
                'longitude' => $request->long ,
                'profile_pic' => $filename,
                'password' => Hash::make($request->password),

            ]);

            DB::commit();
            return redirect('user/all')->with('success','User updated successfully');
    }
    public function Delete($id)
    {
        if( !$this->has_permission(5) ){
            return redirect()->back();   
        }
        Users2::where('id',$id)->delete();
        return redirect()->back()->with('danger','User deleted successfully');
    }
    public function GetState($id)
    {
        $state= Web_state::where('country_id',$id)->get();
        return $state;
    }
    public function GetCity($id)
    {
        $city= Web_citie::where('state_id',$id)->get();
        return $city;
    }
    public function GetUser($id)
    {
        $user=Users2::with('_role','_country','_city','_state')->where('id',$id)->first();
        $roll_id=$user->_role->role_id;
        $membership_plane=Membership_plane::where('role_group_id',$roll_id)->get();
        $assign_membership=AssignMembership::with('_membership')->where('user_id',$id)->first();
        // dd($assign_membership);
        return [
                'user' => $user, 
                'membership_plane' => $membership_plane, 
                'assign_membership' => $assign_membership
            ];
    }
}
