<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\Invertor;
use App\Entreprenuer;
use App\Investor_answer;
use App\Entreprenuer_answer;
use App\User;
use App\Ans_score;
use App\User_role;
use App\Role;
use App\Role_has_permission;
use App\ServiceSector;
use App\Onboarding_statuses;
use Illuminate\Http\Request;

class AnswerController extends Controller
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
    public function ViewAll(Request $request,$type)
    {

        if( $request->ajax() ){
            // dd($request->all());
            $resp=[];
            $resp_temp=[];
            if( intval($type)==0 ){
                if( !$this->has_permission(21) ){
                    return redirect()->back();   
                }

                 $ans=Entreprenuer_answer::with('_user');

                if(!is_null($request->user_id)){
                    $ans=$ans->where('user_id',$request->user_id);
                }
                
                if(!is_null($request->ss)){
                    
                    $ans=$ans->with(["_question" => function($q) use ($request){
                                $q->where('service_sector_id',$request->ss);
                        }]);
                }
                if(!is_null($request->email)){
                    $ans=$ans->with(["_user" => function($q) use ($request){
                                $q->where('email', 'like', '%'.$request->email.'%');
                        }]);
                }
                if(!is_null($request->mobile)){
                    $ans=$ans->with(["_user" => function($q) use ($request){
                                $q->where('contact_no', 'like', '%'.$request->mobile.'%');
                        }]);
                }
                
                

                $ans=$ans->get();
            }else{
                if( !$this->has_permission(48) ){
                    return redirect()->back();   
                }

                 $ans=Investor_answer::with('_user');

                if(!is_null($request->user_id)){
                    $ans=$ans->where('user_id',$request->user_id);
                }

                if(!is_null($request->ss)){
                    $ans=$ans->with(["_question" => function($q) use ($request){
                                $q->where('service_sector_id',$request->ss);
                        }]);
                }
                if(!is_null($request->email)){
                    $ans=$ans->with(["_user" => function($q) use ($request){
                                $q->where('email', 'like', '%'.$request->email.'%');
                        }]);
                }
                if(!is_null($request->mobile)){
                    $ans=$ans->with(["_user" => function($q) use ($request){
                                $q->where('contact_no', 'like', '%'.$request->mobile.'%');
                        }]);
                }

                $ans=$ans->get();
            }
            // dd($ans);

            foreach ($ans as $key => $a) {
                if ($ans[$key]->_question && $ans[$key]->_user) {
                    
                    $user=User::where('id',$a->id)->first();
                    $data=Ans_score::where('created_by',Auth::user()->id)
                                        ->where('question_id', $a->question_id)
                                        ->where('user_id', $a->user_id)->first();

                    $temp=[
                        $key,
                        $a->_user->first_name=='' || $a->_user->first_name==null || $a->_user->last_name=='' || $a->_user->last_name==null  ? $a->_user->name : $a->_user->first_name." ".$a->_user->last_name,
                        $a->_user->email,
                        $a->_user->contact_no,
                        $a->question,
                        $a->answer,
                        '<input type="text"  value="'.( !empty($data) ? $data->score : '' ).'" onchange="submit_score(this,'.$a->id.','.$a->question_id.','.$key.')" class="form-control score'.$key.'" name="score" placeholder="Score"><br><input onchange="submit_disc(this,'.$a->user_id.','.$a->question_id.','.$key.')" type="text" value="'.( !empty($data) ? $data->disc : '' ).'" class="form-control disc'.$key.'" name="disc" placeholder="Disc.">',
                        // '<a  href="'.url('role/del').'/'.$a->user_id.'" class="btn btn-dark">Save</a>'
                    ];
                    array_push($resp_temp, $temp);
                }
            }
            $resp['data']=$resp_temp;
            return $resp;
        }
        
        if( intval($type)==0 ){
            $user=Entreprenuer::with('user_name')->get();
        }else{
            $user=Invertor::with('user_name')->get();
        }
        $ss=ServiceSector::all();
        $status=Onboarding_statuses::all();
        // dd($user);
        return view('answer/create',compact('type','user','status','ss'));
    }
    public function Insert(Request $request)
    {
        $status='';
        try {
            DB::beginTransaction();
                $is_exist=Ans_score::where('created_by',Auth::user()->id)
                                    ->where('question_id', $request->question_id)
                                    ->where('user_id', $request->user_id)->count();
                $data=Ans_score::where('created_by',Auth::user()->id)
                                    ->where('question_id', $request->question_id)
                                    ->where('user_id', $request->user_id)->first();
                if( $is_exist <= 0 ){
                    Ans_score::create([
                         'user_id' => $request->user_id,
                         'question_id' => $request->question_id,
                         'score' => $request->data,
                         'disc' => $request->disc,
                         'created_by' => Auth::user()->id
                    ]);

                    $status='create';
                }else{
                    $score= empty($request->data) ? $data->score : $request->data;
                    $disc= empty($request->disc) ? $data->disc : $request->disc;

                    Ans_score::where('created_by',Auth::user()->id)
                            ->where('question_id', $request->question_id)
                            ->where('user_id', $request->user_id)
                            ->update([
                                 'score' => $score,
                                 'disc' => $disc,
                            ]);
                    $status='update';
                }

            DB::commit();

            return $status;
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function Show(Request $request,$type)
    {
        if( $request->ajax() ){
            $resp=[];
            $resp_temp=[];
            if( intval($type)==0 ){
                $ans=Entreprenuer_answer::where('user_id',$request->user_id)->get();
            }else{
                $ans=Investor_answer::where('user_id',$request->user_id)->get();
            }

            foreach ($ans as $key => $a) {

                $user=User::where('id',$a->id)->first();
                $datas=Ans_score::with('user_has_role')
                                ->where('question_id', $a->question_id)
                                ->where('user_id', $a->user_id)->get();

                $sum_score=0;
                 
                foreach ($datas as $key_0 => $data) {
                     $score_weight=$data->user_has_role;

                    if (count($score_weight) > 0) {
                         
                         $one_user_score=[];
                         foreach ($score_weight as $key => $sw) {
                            
                             $temp_score=Role::where('id',$sw->role_id)
                                            ->pluck('score_weight')->max();
                             array_push($one_user_score, $temp_score);
                         }

                         
                         if( count($one_user_score) > 0 ){
                            $w_score=max($one_user_score);
                         }else{
                            $w_score=$one_user_score[0];
                         }
                         $f_score=$data->score*$w_score/100;
                         $sum_score+=$f_score;

                    }else{
                        // dd($data);
                    }

                    
                }
               
                $temp=[
                    $key,
                    $a->first_name=='' || $a->first_name==nul || $a->last_name=='' || $a->last_name==nul  ? $a->name : $a->first_name." ".$a->last_name,
                    $a->question,
                    $a->answer,
                    $sum_score/count($datas)
                ];
                array_push($resp_temp, $temp);
            }
            $resp['data']=$resp_temp;
            return $resp;
        }
        if( intval($type)==0 ){
            $user=Entreprenuer::with('user_name')->get();
        }else{
            $user=Invertor::with('user_name')->get();
        }
        return view('answer/view_all',compact('type','user'));
    }
}
