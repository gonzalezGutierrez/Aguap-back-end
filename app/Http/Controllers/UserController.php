<?php

namespace App\Http\Controllers;
//namespace App\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use  App\User;
use App\Account;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\UserRequest;
use App\Mail\confirmarCuenta;
use App\Mail\CambiarContrasenia;
use Mail;
use Carbon\Carbon;

class UserController extends Controller{


    public function login(Request $request){

        //login por telefono Movil si el usuario esta activo 
        if( is_numeric($request->get('email')) ){
            $user=User::where('phone',$request['email'])->first();
            if (strcmp($user->status,"inactive")==0) { 
                return response()->json([
                    'status' => 'inactive',
                ],401);
            }
            else{
                $phone=$request->get('email');
                if(Hash::check($request->password,$user->password)&&(strcmp($user->phone,$phone)==0)){
                    $token=$this->token($user);
                    $client=$this->client($user,$token);
                    return response()->json($client,200);
                }
                else{
                    return response()->json([
                        'status' => 'Unauthorized'
                    ],401);
                }
            }
        }

        //login por email si el usuario esta activo
        else{
            $credentials = request(['email', 'password']);
            if(!Auth::attempt($credentials)){
                return response()->json([
                    'status' => 'Unauthorized'
                ],401);
            }
            else{
                $user=$request->user(); 
                $status=$user->status;
                if (strcmp($status,"inactive")==0) { 
                    return response()->json([
                        'status' => 'inactive',
                    ],401);
                }
                else{
                    $token=$this->token($user);
                    $client=$this->client($user,$token);
                    return response()->json($client,200);
                } 
            }
        }
    }

    public function token($user){
        $tokenResult=$user->createToken('token');
        $token=$tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $token=[
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ];
        return $token;
    }
    public function client($user,$token){
        $client=[
            'id'=>$user->idUsuario,
            'name'=>$user->name,
            'lastName'=>$user->lastName,
            'idRol'=>$user->idRol,
            'token'=>$token['token'],
        ];
        return $client;
    }
   
    public function store(Request $request){  
        $request->all();
        $user=new User;
        $user->name=$request->name;
        $user->lastName=$request->lastName;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->idRol=$request->idRol;
        $user->password=Hash::make($request->password);
        $user->save();
        $token=$user->createToken('token')->accessToken;
        return response()->json($token,200);
    }

    public function sendConfirmationEmail(Request $request){
        $user=User::where('email',$request['email'])->first();
        if($user){
            $token=$this->token($user);
            $client=$this->client($user,$token);
            $email=$request['email'];
            Mail::to($email)->send(new confirmarCuenta($client));
            return response()->json($client,200);
        }
        else{
            $response=['message'=>"error not found"];
            return response()->json($response,404);
        }
    }

    public function userAccountActivation(Request $request){
        $user=Auth::user();
        if($user){
            $status='active';
            $user->status=$status;
            $user->save();
            $token=$this->token($user);
            $client=$this->client($user,$token);
            return response()->json($client,200);
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
            $token=$this->token($user);
            $client=$this->client($user,$token);
            Mail::to($email)->send(new cambiarContrasenia($client));
            return response()->json($client,200);
        }
        else{
            $account=Account::where('email',$email)->first();
            if($account){
                $user=User::find($account->idUsuario);
                $token=$this->token($user);
                $client=$this->client($user,$token);
                Mail::to($email)->send(new cambiarContrasenia($client));
                return response()->json($client,200);
            }
            else{
                $message=[
                    'message'=>'not found',
                ];
                return response()->json($message,404);
            }
        }
    }

    public function show(Request $request){
        $user=Auth::user();
        $response=[
            'name'=>$user->name,
            'lastName'=>$user->lastName,
            'email'=>$user->email,
            'phone'=>$user->phone,
        ];
        return response()->json($response,200);
    }

    public function checkMyCurrentpassword(Request $request){
        $user=Auth::user();
        if (Hash::check($request->password,$user->password)) { 
            return response()->json('true',202);
        }
        else{
            return response()->json('false',202);
        }  
    }

    public function updateUser(Request $request){
        $user=Auth::user();
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
        ];
        return response()->json($response,200);
    }

    public function updatePassword(Request $request){
        $user=Auth::user();
        $user->update([
            'password' =>$user->password=Hash::make($request->password),
        ]);
        $message=[
            'mesage'=>'ok',
        ];
        $user->save();
        return response()->json($message,200);  
    }

    public function deleteUser(Request $request){
        $user=Auth::user();
        $user->delete();
        $message=[
            'message'=>'ok',
        ];
        return response()->json($message,200);
    }

    public function findEmail(Request $request){
        $request->all();
        $user = User::where('email', $request['email'])->first();
        if($user){
            $token=$this->token($user);
            $client=$this->client($user,$token);
            return response()->json($client,200);
        }
        else{
            $account=Account::where('email',$request['email'])->first();
            if($account){
                $user=User::find($account->idUsuario);
                $token=$this->token($user);
                $client=$this->client($user,$token);
                return response()->json($client,200);
            }
            else{
                $response=['message'=>"error not found"];
                return response()->json($response,404);
            }
            
        }
    }
    
}
