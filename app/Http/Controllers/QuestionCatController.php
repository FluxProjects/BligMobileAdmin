<?php

namespace App\Http\Controllers;
use App\E_q_categorie;
use App\I_q_categorie;
use App\Role_has_permission;
use App\User_role;
use App\Permission;
use DB;
use Auth;
use Illuminate\Http\Request;

class QuestionCatController extends Controller
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
        if( !$this->has_permission(11) ){
            return redirect()->back();   
        }
    	return view('question_cat/create');
    }
    public function Insert(Request $request)
    {
        if( !$this->has_permission(11) ){
            return redirect()->back();   
        }
    	// dd($request->all());
    	try {
    		DB::beginTransaction();
    			if( intval($request->type) == 0 ){
    				$e_cat=E_q_categorie::create([
    					'category' => $request->cat_name,
    					'sequence' => $request->sequence
    				]);
    			}else{
    				$e_cat=I_q_categorie::create([
    					'category' => $request->cat_name,
    					'sequence' => $request->sequence
    				]);
    			}
    		DB::commit();

    		return redirect()->back()->with('success','Question category created successfully');;
    	} catch (Exception $e) {
    		dd($e);
    	}
    }
    public function ViewAll(Request $request,$type)
    {
        if( !$this->has_permission(12) ){
            return redirect()->back();   
        }
    	if( $request->ajax() ){
    		$resp=[];
    		$resp_temp=[];
    		if( intval($type)==0 ){
    			$cat=E_q_categorie::all();
    		}else{
    			$cat=I_q_categorie::all();
    		}
    		foreach ($cat as $key => $c) {
    			$temp=[
    				$key,
    				$c->category,
    				$c->sequence,
    				'<a href="'.url('question-category/view').'/'.$type.'/'.$c->id.'" style="font-size:12px!important;position:relative;left:5px" class="px-2 btn btn-dark"><i class="fa fa-eye"></i>
    				</a>
    				<a href="'.url('question-category/del').'/'.$type.'/'.$c->id.'"  style="font-size:12px!important;position:relative;right:5px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
    				</button>'
    			];
    			array_push($resp_temp, $temp);

    		}
    		$resp['data']=$resp_temp;

    		return $resp;
    	}
    	return view('question_cat/view_all',compact('type'));
    }
    public function Show($type,$cat_id)
    {
        if( !$this->has_permission(15) ){
            return redirect()->back();   
        }
    	if( intval($type)==0 ){
    		$cat=E_q_categorie::where('id',$cat_id)->first();
    	}else{
    		$cat=I_q_categorie::where('id',$cat_id)->first();
    	}
        // dd($cat);
        return view('question_cat.edit',compact('cat','type','cat_id'));
    }
    public function Edit(Request $request,$cat_id)
    {
        if( !$this->has_permission(15) ){
            return redirect()->back();   
        }
    	if( intval($request->type) == 0 ){
    		$e_cat=E_q_categorie::where('id',$cat_id)->update([
    			'category' => $request->cat_name,
    			'sequence' => $request->sequence
    		]);
    	}else{
    		$e_cat=I_q_categorie::where('id',$cat_id)->update([
    			'category' => $request->cat_name,
    			'sequence' => $request->sequence
    		]);
    	}
    	return redirect()->back()->with('success','Question category updated successfully');
    }
    public function Delete($type,$cat_id)
    {
        if( !$this->has_permission(14) ){
            return redirect()->back();   
        }
    	if( intval($type) == 0 ){
    		$e_cat=E_q_categorie::where('id',$cat_id)->delete();
    	}else{
    		$e_cat=I_q_categorie::where('id',$cat_id)->delete();
    	}
    	return redirect()->back()->with('success','User updated successfully');
    }
}
