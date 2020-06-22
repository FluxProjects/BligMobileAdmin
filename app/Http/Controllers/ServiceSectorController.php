<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\ServiceSector;
use App\Role_has_permission;
use App\User_role;
use App\Permission;
class ServiceSectorController extends Controller
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
        if( !$this->has_permission(16) ){
            return redirect()->back();   
        }
    	return view('Service_Sector/create');
    }
    public function Insert(Request $request)
    {
        if( !$this->has_permission(16) ){
            return redirect()->back();   
        }
	    DB::beginTransaction();
		$user=ServiceSector::create([
			'ss_title' => $request->ss_image,
			'ss_image' => $request->file ,

		]);
	    DB::commit();
		
	    return redirect('service-sector/create')->with('success','ServiceSector created successfully');;
    }
    public function ViewAll(Request $request)
    {
        if( !$this->has_permission(17) ){
            return redirect()->back();   
        }
    	if( $request->ajax() ){
    	    $resp=[];
    	    $resp_temp=[];
    	    $ServiceSector=ServiceSector::all();
    	    foreach ($ServiceSector as $key => $ss) {

    	        $temp=[
    	            $key,
    	            $ss->ss_image,
    	            $ss->ss_title,
    	            '<div style="display:flex">
    	                <a href="'.url('service-sector/edit').'/'.$ss->id.'" style="font-size:12px!important;position:relative;left:5px" class="px-2 btn btn-dark"><i class="fas fa-pencil-alt"></i>
    	                </a>
    	                <a href="'.url('service-sector/del').'/'.$ss->id.'" style="font-size:12px!important;position:relative;right:5px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
    	                </a>
    	            </div>'
    	        ];
    	        array_push($resp_temp, $temp);
    	    }
    	    $resp['data']=$resp_temp;
    	    return $resp;
    	}
    	return view('Service_Sector/view_all');
    }
    public function Edit($id)
    {
        if( !$this->has_permission(20) ){
            return redirect()->back();   
        }
    	$ss=ServiceSector::where('id',$id)->first();
    	return view('Service_Sector/edit',compact('ss','id'));
    }
    public function Update(Request $request,$id)
    {
        if( !$this->has_permission(20) ){
            return redirect()->back();   
        }
	    DB::beginTransaction();
		$user=ServiceSector::where('id',$id)->update([
			'ss_title' => $request->ss_image,
			'ss_image' => $request->file ,

		]);
	    DB::commit();

	    return redirect('service-sector/create')->with('success','ServiceSector updated successfully');;
    }
    public function Delete($id)
    {
        if( !$this->has_permission(19) ){
            return redirect()->back();   
        }
        ServiceSector::where('id',$id)->delete();
        return redirect()->back()->with('danger','Deleted successfully');;
    }
}
