<?php

namespace App\Http\Controllers;
//namespace App\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use  App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\UserRequest;
use App\Mail\sendMail;
use Mail;


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
        /*validar telefonos que ya existen.
        validar correos que ya existen.*/       
        $request->all();
        $user=new User;
        $user->name=$request->name;
        $user->lastName=$request->lastName;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->idRol=$request->idRol;
        $user->password=Crypt::encryptString($request->password);
        $user->confirmation_password=Crypt::encryptString($request->confirmation_password);
        /*$user->password=hash::make($request->password);
        $user->confirmation_password=hash::make($request->confirmation_password);*/
        $user->status=$request->status;
        $user->save();
        $response=[
            'message'=>'confirme su cuenta se le a enviado un email a su correo electronico',
        ];
        $this->sendConfirmationEmail($user->email);
        return response()->json($response,200);

    }
    public function updateUser(Request $request,$id){
        $user=User::find($id);
        if($user){
            $user->name=$request->name;
            $user->lastName=$request->lastName;
            $user->email=$request->email;
            $user->phone=$request->phone;

            $response=[
                'name'=>$user->name,
                'lastName'=>$user->lastName,
                'email'=>$user->email,
                'phone'=>$user->phone,
                'idRol'=>$user->idRol,
            ];
            $user->save();
            return response()->json($response,200);
        }
        else{
            $response=['message'=>"user not found"];
            return response()->json($response,404);
        }
        
    }
    public function updatePassword(Request $request,$id){
        $user=User::find($id);
        if($user){
            $user->password=Crypt::encryptString($request->password);
            $user->confirmation_password=Crypt::encryptString($request->password);
            $message=[
                'mesage'=>'ok'
            ];
            return response()->json($message,200);
        }
        else{
            $response=['message'=>"not found"];
            return response()->json($response,404);   
        }
    }
    public function checkMyCurrentpassword(Request $request ,$id){
        $user=User::find($id);
        if($user){
            //if (Hash::check($request->password, $user->password)) { 
                $decrypted = Crypt::decryptString($user->password);
                $response=[
                    'password'=>$decrypted
                ];
                return response()->json($response,202);
            //}
            /*else{
                return response()->json('false',202);
            } */ 
        }
        else{
            return response()->json("error",404);
        }
     
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
    }

    public function sendConfirmationEmail($email){
        $user=User::where('email',$email)->first();
        if($user){
            $token=$user->createToken('Token')->accessToken;
            $data=[
                'name'=>$user->name,
                'lastName'=>$user->lastName,
                'id'=>$user->id,
                'token'=>$token, 
            ];
            Mail::to($email)->send(new sendMail($data));
            return response()->json($data,200);
        }
        else{
            $response=['message'=>"error not found"];
            return response()->json($response,404);
        }
       
    }

   
    public function userAccountActivation($id){
        $user=User::find($id);
        if($user){
            $status=1;
            $user->status=$status;
            $user->save();
            $response=[
                'name'=>$user->name,
                'lastName'=>$user->lastName,
                'id'=>$user->id,
                'idRol'=>$user->idRol,
                'status'=>$user->status,
            ];
            return response()->json($response,200);
        }
        else{
            $response="not found";
            return response()->json($response,404); 
        }
       
    
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
//163223