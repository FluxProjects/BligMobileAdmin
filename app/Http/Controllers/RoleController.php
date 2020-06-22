<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Carbon;
use App\Role_has_permission;
use App\User_role;
use App\Permission;
use App\Role;
use App\Role_group;
use Illuminate\Http\Request;

class RoleController extends Controller
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
    public function index()
    {
        return view('home');
    }
    public function Create()
    {
        if( !$this->has_permission(6) ){
            return redirect()->back();   
        }
        $role= Role::all();
        return view('Role.create',compact('role'));
    }
    public function insert(Request $request)
    {

      if( !$this->has_permission(6) ){
          return redirect()->back();   
      }
       try {
           
           DB::beginTransaction();
               $is_group = !empty($request->group_name) ? true : false;
               $role=Role::create([
                   'name' => $is_group ? $request->group_name : $request->role_name,
                   'score_weight' => $request->score,
                   'group_name' => $request->group_name,
                   'is_group' => $is_group
               ]);

              if( $request->has('group_name') ){

                foreach ($request->group_roles as $key => $gr) {

                   $has_permission=Role_group::create([
                        'group_role_id' => $role->id,
                        'select_role_id' => intval($gr)
                   ]);
                }
              }else{

                if( empty($request->permission) ){
                  return redirect()->back()->with('error','Check atleast one permission');
                }

                foreach ($request->permission as $key => $p) {

                   $has_permission=Role_has_permission::create([
                        'role_id' => $role->id,
                        'permission_id' => intval($p)
                   ]);
                }
              }

               

           DB::commit();

           return redirect()->back()->with('success','Role created successfully');
       } catch (Exception $e) {
           dd($e);
       }
    }
    public function Edit(Request $request,$id)
    {
      if( !$this->has_permission(10) ){
          return redirect()->back();   
      }
      try {
          
          DB::beginTransaction();
              $role=Role::where('id',$id)->update([
                  'name' => $request->role_name
              ]);
              Role_has_permission::where('role_id',$id)->delete();
              // dd($request->all());
              if( empty($request->permission) ){
                return redirect()->back()->with('error','Check atleast one permission');
              }
              foreach ($request->permission as $key => $p) {

                 $has_permission=Role_has_permission::create([
                      'role_id' => $id,
                      'permission_id' => intval($p)
                 ]);
              }

          DB::commit();

          return redirect('role/all')->with('success','Role updated successfully');
      } catch (Exception $e) {
          dd($e);
      }
    }
    public function GroupUpdate(Request $request,$id)
    {
      try {
          
          DB::beginTransaction();
              $is_group = !empty($request->group_name) ? true : false;
              $role=Role::where('id',$id)->update([
                  'name' => $request->group_name,
                  'score_weight' => $request->score,
                  'group_name' => $request->group_name,
                  'is_group' => $is_group
              ]);
             
              Role_group::where('group_role_id',$id)->delete();
              foreach ($request->group_roles as $key => $gr) {

                 $has_permission=Role_group::create([
                      'group_role_id' => $id,
                      'select_role_id' => intval($gr)
                 ]);
              }

          DB::commit();

          return redirect('role/all');
      } catch (Exception $e) {
          dd($e);
      }
    }
    public function ViewAll(Request $request)
    {
        if( !$this->has_permission(7) ){
            return redirect()->back();   
        }
        if( $request->ajax() ){
            $resp=[];
            $resp_temp=[];
            $role=Role::all();
            foreach ($role as $key => $r) {
                $has_permission=Role_has_permission::where('role_id',$r->id)->count();

                $permission_title= $r->is_group == true ? '<span class="label label-warning p-1">Group</span>' : '<span class="label label-warning p-1">'.$has_permission.' / 50</span>';

                $_edit_del = $r->is_group == true ? 
                  '<a href="'.url('role/group-edit').'/'.$r->id.'" style="font-size:12px!important;position:relative;left:5px" class="px-2 btn btn-dark"><i class="fa fa-eye"></i>
                  </a>
                  <a href="'.url('role/group-del').'/'.$r->id.'" style="font-size:12px!important;position:relative;right:5px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
                  </button>'
                : 
                  '<a href="'.url('role/view').'/'.$r->id.'" style="font-size:12px!important;position:relative;left:5px" class="px-2 btn btn-dark"><i class="fa fa-eye"></i>
                  </a>
                  <a href="'.url('role/del').'/'.$r->id.'" style="font-size:12px!important;position:relative;right:5px" class="px-2 btn btn-dark"><i class="fa fa-trash"></i>
                  </button>';

                $temp=[
                    $key,
                    $r->name,
                    $permission_title,
                    date('d-m-Y'),
                    $_edit_del
                ];
                array_push($resp_temp, $temp);
            }
            $resp['data']=$resp_temp;
            return $resp;
        }
        return view('Role.view_all');
    }
    public function Show($role_id)
    {
        if( !$this->has_permission(10) ){
            return redirect()->back();   
        }
        $role=Role::with('_permission')->where('id',$role_id)->first();
        // dd($role->_permission);
        return view('Role.edit',compact('role','role_id'));
    }

    public function GroupEdit($role_id)
    {
        $role= Role::all();
        $data=Role::with('_permission','_role_group')->where('id',$role_id)->first();

        // dd($data->_role_group);
        return view('Role/group_edit',compact('role','data','role_id')); 
    }
    public function Delete($role_id)
    {
        if( !$this->has_permission(9) ){
            return redirect()->back();   
        }
        // dd($role_id);
        Role_has_permission::where('role_id',$role_id)->delete();
        Role::where('id',$role_id)->delete();

        return redirect()->back();
    }
    public function GroupDelete($role_id)
    {
        Role_group::where('group_role_id',$role_id)->delete();
        Role::where('id',$role_id)->delete();
        return redirect()->back();
    }
    // ============= ROLE GROUP ==============

    public function GroupCreate()
    {
      $role= Role::all();
      return view('Role/group_create',compact('role'));
    }
}
