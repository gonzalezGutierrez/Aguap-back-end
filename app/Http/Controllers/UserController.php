<?php

namespace App\Http\Controllers;
//namespace App\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use  App\User;
use App\Account;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\UserRequest;
use App\Mail\sendMail;
use Mail;

class UserController extends Controller{
    public function index(){     
    }
    public function store(Request $request){  
        $request->all();
        $user=new User;
        $user->name=$request->name;
        $user->lastName=$request->lastName;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->role_id=$request->role_id;
        $user->password=Crypt::encryptString($request->password);
        $user->confirmation_password=Crypt::encryptString($request->confirmation_password);
        /*$user->password=hash::make($request->password);
        $user->confirmation_password=hash::make($request->confirmation_password);*/
        $user->status=$request->status;
        $response=[
            'message'=>'confirme su cuenta se le a enviado un email a su correo electronico',
        ];
        //return response()->json($response,200);
        $user->save();
        $this->sendConfirmationEmail($user->email);
        return response()->json($response,201);

    }
    public function updateUser(Request $request,$id){
        $user=User::find($id);
        if($user){
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
                'role_id'=>$user->role_id,
            ];
           
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
            $user->update([
                'password' => $user->password=Crypt::encryptString($request->newPassword),
                'confirmation_password'=>$user->confirmation_password=Crypt::encryptString($request->newPassword),
            ]);
            //$user->password=Crypt::encryptString($request->newPassword);
            //$user->confirmation_password=Crypt::encryptString($request->newPassword);
            $message=[
                'mesage'=>'ok',
            ];
            $user->save();
            return response()->json($message,200);
        }
        else{
            $response=['message'=>"not found"];
            return response()->json($response,404);   
        }
    }
    
    public function checkMyCurrentpassword($id){
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
            return response()->json("not found",404);
        }
    }

    public function show($id){
        $user=User::find($id);
        if($user){
            $response=[
                'name'=>$user->name,
                'lastName'=>$user->lastName,
                'email'=>$user->email,
                'phone'=>$user->phone,
                'role_id'=>$user->role_id,
            ];
            return response()->json($response,200);
        }
        else{
            $response=['message'=>"error not found"];
            return response()->json($response,404);
        }

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
            $status='active';
            $user->status=$status;
            $user->save();
            $response=[
                'name'=>$user->name,
                'lastName'=>$user->lastName,
                'id'=>$user->id,
                'role_id'=>$user->role_id,
                'status'=>$user->status,
            ];
            return response()->json($response,200);
        }
        else{
            $response="not found";
            return response()->json($response,404); 
        }
       
    }

    public function AccountRecoveryEmail(Request $request){
        $email=$request->email;
        $user =User::where('email',$email)->first();
        if($user){
            $token=$user->createToken('Token')->accessToken;
            $name=$user->name." ".$user->lastName;
            $data=[
                'name'=>$name,
                'token'=>$token,
                'id'=>$user->id, 
            ];
            Mail::to($email)->send(new sendMail($data));
            return response()->json($data,200);
        }
        else{
            $account=Account::where('email',$email)->first();
            if($account){
                $user=User::find($account->user_id);
                $token=$user->createToken('Token')->accessToken;
                $name=$user->name." ".$user->lastName;
                $data=[
                    'name'=>$name,
                    'token'=>$token,
                    'id'=>$account->user_id,
                ];
                Mail::to($email)->send(new sendMail($data));
                return response()->json($data,200);
            }
            else{
                $message=[
                    'message'=>'not found',
                ];
                return response()->json($message,404);
            }
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
