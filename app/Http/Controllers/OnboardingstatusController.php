<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Onboarding_statuses;

class OnboardingstatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Create()
    {
    	return view('Onboarding_status/create');
    }
    public function Insert(Request $request)
    {
        // dd($request->all());
	    DB::beginTransaction();
		$user=Onboarding_statuses::create([
			'status' => $request->onboarding_status,
		]);
	    DB::commit();
		
	    return redirect('onboarding-status/create')->with('success','Status created successfully');
    }
    public function ViewAll(Request $request)
    {
    	if( $request->ajax() ){
    	    $resp=[];
    	    $resp_temp=[];
    	    $status=Onboarding_statuses::all();
    	    foreach ($status as $key => $ss) {

    	        $temp=[
    	            $key,
    	            $ss->status,
    	            $ss->created_at,
    	            '<div style="display:flex">
    	                <a href="'.url('onboarding-status/edit').'/'.$ss->id.'" style="font-size:12px!important;position:relative;left:5px" class="px-2 btn btn-dark"><i class="fas fa-pencil-alt"></i>
    	                </a>
    	                <a href="'.url('onboarding-status/del').'/'.$ss->id.'" style="font-size:12px!important;position:relative;right:5px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
    	                </a>
    	            </div>'
    	        ];
    	        array_push($resp_temp, $temp);
    	    }
    	    $resp['data']=$resp_temp;
    	    return $resp;
    	}
    	return view('Onboarding_status/view_all');
    }
    public function Edit($id)
    {
    	$ss=Onboarding_statuses::where('id',$id)->first();
    	return view('Onboarding_status/edit',compact('ss','id'));
    }
    public function Update(Request $request,$id)
    {
	    DB::beginTransaction();
		$user=Onboarding_statuses::where('id',$id)->update([
			'status' => $request->onboarding_status,

		]);
	    DB::commit();

	    return redirect('onboarding-status/create')->with('success','Status updated successfully');;
    }
    public function Delete($id)
    {
        Onboarding_statuses::where('id',$id)->delete();
        return redirect()->back()->with('danger','Status deleted successfully');
    }
}
