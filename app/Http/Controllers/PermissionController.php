<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
       $permissions = Permission::orderBy('created_at','DESC')->paginate(10);
        
       $data['permissions']=$permissions;
       return view('permissions.index',$data);

    }
    public function create(){
        return view('permissions.create');

    }
    public function store(Request $request){
      $validator =  Validator::make($request->all(),[
            'name'=>'required|unique:permissions|min:3',
        ]);
        if($validator->passes()){
            Permission::create([
                'name'=>$request->name,
            ]);
            return redirect()->route('permissions.index')->with('success','permission added successfully');
           
        }else{
        return redirect()->route('permissions.create')->withInput()->withErrors($validator);

        }

    }
    public function edit($permissionId){
       $permission = Permission::findOrFail($permissionId);
       $data['permission'] =$permission;
       return view('permissions.edit',$data);
        

    }
    public function update(Request $request,$id){
        $permission = Permission::findOrFail($id);
         $validator =  Validator::make($request->all(),[
            'name'=>'required|unique:permissions,name,'.$id.',id'
        ]);
        if($validator->passes()){
            $permission->name=$request->name;
            $permission->save();
            return redirect()->route('permissions.index')->with('success','permission Updated successfully');
           
        }else{
        return redirect()->route('permission.edit',$id)->withInput()->withErrors($validator);

        }

    }
    public function destroy(Request $request){

        $permission = Permission::find($request->id);
        if( $permission == null){
                        session()->flash('error','Permission Not Found');

            return response()->json([
                'status'=>false,
            ]);

        }
        $permission->delete();
        session()->flash('success','Permission Deleted Successfully');
        return response()->json([
                'status'=>true,
            ]);
    }
}
