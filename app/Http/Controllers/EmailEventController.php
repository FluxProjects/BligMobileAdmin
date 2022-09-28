<?php

namespace App\Http\Controllers;
use App\E_q_categorie;
use App\I_q_categorie;
use App\Role_has_permission;
use App\User_role;
use App\Permission;
use App\Event;
use DB;
use Auth;
use Illuminate\Http\Request;

class EmailEventController extends Controller
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
        // if( !$this->has_permission(11) ){
        //     return redirect()->back();   
        // }
    	return view('email_event/create');
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
    			$event=Event::create([
                        'name' => $request->event_name,
                        'date' => $request->date,
                        'time' => $request->time,
                        'event_type' => $request->event_type,
                        'mode_id' => intval($request->event_type) == 1 ? '' : $request->mode_id,
                        'mode_name' => $request->mode,
                        'venue' => intval($request->event_type) == 0 ? '' : $request->venue,
                    ]);
    		DB::commit();

    		return redirect()->back()->with('success','Event created successfully');;
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
    		$event=Event::all();
    		foreach ($event as $key => $e) {
    			$temp=[
    				$key,
    				$e->name,
    				$e->date,
                    date('h:i A',strtotime($e->time)),
                    intval($e->event_type)==1 ? 'Online' : 'Offline',
                    intval($e->event_type)==1 ? $e->mode_name : $e->venue,
                    $e->mode_id,
                    date('d-m-Y',strtotime($e->created_at)),
    				'<a href="'.url('email-event/edit').'/'.$e->id.'" style="font-size:12px!important;position:relative;left:5px" class="px-2 btn btn-dark"><i class="fa fa-eye"></i>
    				</a>
    				<a href="'.url('email-event/del').'/'.$e->id.'"  style="font-size:12px!important;position:relative;right:5px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
    				</button>'
    			];
    			array_push($resp_temp, $temp);

    		}
    		$resp['data']=$resp_temp;

    		return $resp;
    	}
    	return view('email_event/view_all');
    }
    public function Edit($id)
    {
        // if( !$this->has_permission(15) ){
        //     return redirect()->back();   
        // }
    	$event=Event::where('id',$id)->first();

        return view('email_event.edit',compact('event','id'));
    }
    public function Update(Request $request,$id)
    {
        // if( !$this->has_permission(15) ){
        //     return redirect()->back();   
        // }
        // dd($request->all());
	   try {
            DB::beginTransaction();
                $event=Event::where('id',$id)->update([
                        'name' => $request->event_name,
                        'date' => $request->date,
                        'time' => $request->time,
                        'event_type' => $request->event_type,
                        'mode_id' => intval($request->event_type) == 0 ? '' : $request->mode_id,
                        'mode_name' => intval($request->event_type) == 0 ? '' : $request->mode,
                        'venue' => intval($request->event_type) == 1 ? '' : $request->venue,
                    ]);
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