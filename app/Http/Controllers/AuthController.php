<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login() {
        return view('administracion.auth.login');
    }

    public function regis() {
        return view('administracion.auth.register');
    }

    public function registro_administrativo(Request $request){
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
        return redirect('/administracion/pedidos');
    }

    public function auth(Request $request) {

        $credencials = $request->only(['email','password']);
        $isAdmin = False;
        if (Auth::attempt($credencials)) {
            $user=$request->user(); 
            $token=$this->token($user);
            $client=$this->client($user,$token);
            $idRol=$user->idRol;
                /*echo '<script>';
                echo 'console.log('. json_encode( $idRol ) .')';
                echo '</script>';*/
            if($idRol == 1){
                $isAdmin = True;
                return redirect('/administracion/pedidos');
            }else{
                return back();
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

    public function getRepartidores(){
        $repartidores  = User::getUsuariosByRol(2)->get();
        /* '<script>';
                echo 'console.log('. json_encode( $repartidores ) .')';
                echo '</script>';*/
        return view('administracion.repartidores.repartidor', compact(
            'repartidores',
        ));
    }
}
