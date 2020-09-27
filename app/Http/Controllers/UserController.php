<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use  App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){  
        // falta validar que las contraseña sean correctas.
        //validar telefonos que ya existen.
        //validar correos que ya existen.       
        //validar datos vacios 
        $request->all();
        $user=new User;
        $user->name=$request->name;
        $user->lastName=$request->lastName;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->idRol=$request->idRol;
        $user->password=hash::make($request->password);
        $user->confirmation_password=hash::make($request->confirmation_password);
        $user->status=$request->status;
        $user->save();
        $token= $user->createToken('Token')->accessToken;

        $response=[
            'token'=>$token,
            'id'=>$user->id,
            'name'=>$user->name,
            'lastNmae'=>$user->lastName,
            'email'=>$user->email,
            'phone'=>$user->phone,
            'idRol'=>$user->idRol,
            'status'=>$user->status,
        ];
        
        return response()->json($response,200);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $user=User::find($id);
        if($user){
            $response=[
                'name'=>$user->name,
                'lastName'=>$user->lastName,
                'email'=>$user->email,
                'phone'=>$user->phone,
                'idRol'=>$user->idRol,
            ];
            return response()->json($response);
        }
        else{
            $response=['message'=>"error not found"];
            return response()->json($response,404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //falta comparar la contraseñas que sean igual
        $request->all();
        $user=User::find($id);
        if($user){
            if($request->password==''&& $request->confirmation_password==''){
                $user->name=$request->name;
                $user->lastName=$request->lastName;
                $user->email=$request->email;
                $user->phone=$request->phone;
                $user->save();
                $response=[
                    'name'=>$user->name,
                    'lastName'=>$user->lastName,
                    'email'=>$user->email,
                    'phone'=>$user->phone,
                    'idRol'=>$user->idRol,
                ];
                return response()->json($response);
            }
            else{
                $user->name=$request->name;
                $user->lastName=$request->lastName;
                $user->email=$request->email;
                $user->phone=$request->phone;
                $user->password=hash::make($request->password);
                $user->confirmation_password=hash::make($request->confirmation_password);
                $user->save();
                $response=[
                    'name'=>$user->name,
                    'lastName'=>$user->lastName,
                    'email'=>$user->email,
                    'phone'=>$user->phone,
                    'idRol'=>$user->idRol,
                ];
                return response()->json($response);
            }     
        }
        else{
            $response=['message'=>"user not found",];
            return response()->json($response,404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function findEmail(Request $request){
        $request->all();
        $user = User::where('email', $request['email'])->first();
        if($user){
            $response=[
                'email'=>$user->email,
            ];
            return response()->json($response);
        }
        else{
            $response=['message'=>"error not found"];
            return response()->json($response,404);
        }
    }
}
