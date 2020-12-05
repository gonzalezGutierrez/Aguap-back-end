<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
class RolController extends Controller{
    
    public function index(){
      
    }

    public function store(Request $request){
        $rol=new Role();
        if($request){
            $rol->name=$request->name;
            $rol->save();
            return response()->json($rol,200);
        }
        else{
            $message=[
                'message'=>"null field",
            ];
            return response()->json($message,400);
        }
        
    }
    public function show($id){
        $role=Role::find($id);
        if($role){
            $roles=Role::find($id)->users;
            return response()->json($roles,200);
        }
        else{
            $message=[
                'message'=>'not found',
            ];
            return response()->json($message,404);
        } 
    }

    public function update(Request $request, $id){

    }
    public function destroy($id){

    }
}
