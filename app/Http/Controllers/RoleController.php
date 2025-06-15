<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
         $roles = Role::orderBy('created_at','DESC')->paginate(10);
        
       $data['roles']=$roles;

       return view( 'roles.index',$data);

    }
    public function create(){
       $permissions = Permission::orderBy('created_at','DESC')->get();
        $data['permissions'] =$permissions;
        return view('roles.create',$data);

    }
    public function store(Request $request){
       // dd($request->permission);
      $validator =  Validator::make($request->all(),[
            'name'=>'required|unique:roles|min:3',
        ]);
        if($validator->passes()){
           
           $role = Role::create([
                'name'=>$request->name,
            ]);
            if(!empty($request->permission)){
                foreach($request->permission as $name){
                $role->givePermissionTo($name);

            }

            }
            
            
            return redirect()->route('roles.index')->with('success','role added successfully');
           
        }else{
        return redirect()->route('roles.create')->withInput()->withErrors($validator);

        }

    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }
}
