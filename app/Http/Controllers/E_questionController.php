<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\E_question;
use App\I_question;
use App\E_q_categorie;
use App\I_q_categorie;
use App\User_role;
use App\ServiceSector;
use App\Entreprenuer_q_input;
use App\Investor_q_input;

class E_questionController extends Controller
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
        if( !$this->has_permission(48) ){
            return redirect()->back();   
        }
        $service_sector=ServiceSector::all();
    	return view('Question/create',compact('service_sector'));
    }
    public function Insert(Request $request)
    {
        // dd( $request->has('multi_input') );
        if( !$this->has_permission(48) ){
            return redirect()->back();   
        }
        // dd($request->all());
        DB::beginTransaction();
            if ( $request->type==0 ) {
                
                $user=E_question::create([
                    'question_description' => $request->question_desc,
                    'type' => $request->q_type,
                    'cat_id' => $request->_category,
                    'category' => E_q_categorie::where('id',$request->_category)->first()->category,
                    'multiple_inputs' => $request->multi_input== 'on' ? true : false,
                    'service_sector_id' => $request->ss
                ]);
                // dd($user);
                if ($request->has('multi_input')) {
                    foreach ($request->question_opt as $key => $options) {
                          // dd($options);  
                        $opt=Entreprenuer_q_input::create([
                            'f_key' => $user->id,
                            'label' => $options,
                            'values' => $options
                        ]);
                    }
                }
            }else{

                $user=I_question::create([
                    'question_description' => $request->question_desc,
                    'type' => $request->q_type,
                    'cat_id' => $request->_category,
                    'category' => I_q_categorie::where('id',$request->_category)->first()->category,
                    'multiple_inputs' => $request->multi_input== 'on' ? true : false,
                    'service_sector_id' => $request->ss
                ]);

                if ($request->has('multi_input')) {
                    foreach ($request->question_opt as $key => $options) {
                          // dd($options);  
                        $opt=Investor_q_input::create([
                            'f_key' => $user->id,
                            'label' => $options,
                            'values' => $options
                        ]);
                    }
                }
            }

            
    	    
    		
	    DB::commit();
		
	    return redirect('Question/create')->with('success','Category created successfully');
    }
    public function ViewAll(Request $request,$type)
    {
        if( !$this->has_permission(49) ){
            return redirect()->back();   
        }
    	if( $request->ajax() ){
    	    $resp=[];
    	    $resp_temp=[];
            if ( $type==0 ) {
                $status=E_question::all();
            }else{
                $status=I_question::all();

            }
    	    
    	    foreach ($status as $key => $ss) {

    	        $temp=[
    	            $key,
    	            $ss->question_description,
    	            $ss->type,
                    $ss->category,
                    $ss->multiple_inputs,
    	            '<div style="display:flex">
    	                <a href="'.url('Question/edit').'/'.$ss->id.'/'.$type.'" style="font-size:12px!important;position:relative;left:5px" class="px-2 btn btn-dark"><i class="fas fa-pencil-alt"></i>
    	                </a>
    	                <a href="'.url('Question/del').'/'.$ss->id.'/'.$type.'" style="font-size:12px!important;position:relative;right:5px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
    	                </a>
    	            </div>'
    	        ];
    	        array_push($resp_temp, $temp);
    	    }
    	    $resp['data']=$resp_temp;
    	    return $resp;
    	}
    	return view('Question/view_all',compact('type'));
    }
    public function Edit($id,$type)
    {

        if( !$this->has_permission(50) ){
            return redirect()->back();   
        }
        $service_sector=ServiceSector::all();
        if ( $type==0 ) {
            $data=E_question::with('_multi_opt','_serviceSector')->where('id',$id)->first();
            $cat=E_q_categorie::all();
        }else{
            $data=I_question::with('_multi_opt','_serviceSector')->where('id',$id)->first();
            $cat=I_q_categorie::all();
            // dd($data);
        }
        // dd($data);
        $multiOpt=$data->_multi_opt;
    	return view('Question/edit',compact('data','type','id','cat','service_sector','multiOpt'));
    }
    public function Update(Request $request,$id)
    {
        if( !$this->has_permission(50) ){
            return redirect()->back();   
        }
        // dd( $request->all() );
        DB::beginTransaction();
            if ( $request->type==0 ) {
                
                $user=E_question::where('id',$id)->update([
                    'question_description' => $request->question_desc,
                    'type' => $request->q_type,
                    'cat_id' => $request->_category,
                    'category' => E_q_categorie::where('id',$request->_category)->first()->category,
                    'multiple_inputs' => $request->multi_input== 'on' ? true : false,
                    'service_sector_id' => $request->ss
                ]);
                Entreprenuer_q_input::where('f_key',$id)->delete();
                if ($request->has('multi_input')) {
                    foreach ($request->question_opt as $key => $options) {
                          // dd($options);  
                        $opt=Entreprenuer_q_input::create([
                            'f_key' => $id,
                            'label' => $options,
                            'values' => $options
                        ]);
                    }
                }
            }else{

                $user=I_question::where('id',$id)->update([
                    'question_description' => $request->question_desc,
                    'type' => $request->q_type,
                    'cat_id' => $request->_category,
                    'category' => I_q_categorie::where('id',$request->_category)->first()->category,
                    'multiple_inputs' => $request->multi_input== 'on' ? true : false,
                    'service_sector_id' => $request->ss
                ]);

                if ($request->has('multi_input')) {
                    foreach ($request->question_opt as $key => $options) {
                          // dd($options);  
                        Investor_q_input::where('f_key',$id)->delete();
                        $opt=Investor_q_input::create([
                            'f_key' => $id,
                            'label' => $options,
                            'values' => $options
                        ]);
                    }
                }
            }
            
            
        DB::commit();

	    return redirect('Question/all/0')->with('success','Category updated successfully');;
    }
    public function Delete($id,$type)
    {
        if( !$this->has_permission(51) ){
            return redirect()->back();   
        }
        if ( $type==0 ) {
            E_question::where('id',$id)->delete();
            Entreprenuer_q_input::where('f_key',$id)->delete();
        }else{
            I_question::where('id',$id)->delete();
            Investor_q_input::where('f_key',$id)->delete();
        }
        
        return redirect()->back()->with('danger','Category deleted successfully');;
    }
    public function GetCat($id)
    {
        if ( intval($id)==0 ) {
            $cat=E_q_categorie::all();
        }else{
            $cat=I_q_categorie::all();
        }
        return $cat;
    }
    public function GetAppendedData($id,$type)
    {
        
        $service_sector=ServiceSector::all();
        if ( $type==0 ) {
            $_data=E_question::with('Entreprenuer_q_input')->where('id',$id)->first();
        }else{
            $_data=I_question::with('Entreprenuer_q_input')->where('id',$id)->first();
        }
        // dd($_data);
        return $_data;
    }
}
