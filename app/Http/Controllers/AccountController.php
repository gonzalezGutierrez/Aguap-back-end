<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function store(Request $request){
        $user = Auth::user();
        $account=new Account();
        $account->email=$request->email;
        $user->accounts()->save($account);
        return response()->json($account,200);
    }

    public function index(Request $request){
        $user = Auth::user();
        $account=$user->accounts;
        return response()->json($account,200);
    }

    public function destroy($id){
        $account=Account::find($id);
        if($account){
            $account->delete();
            return response($account,200);
        }
        else{
            $message=[
                "message"=>'not found'
            ];
            return response()->json($message,404);
        }
    }
}
