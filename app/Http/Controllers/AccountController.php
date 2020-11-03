<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id){
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $account=new Account();
        $account->email=$request->email;
        $account->user_id=$request->user_id;
        $account->save();
        return response()->json($account,202);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $accounts=User::find($id)->accounts;
        if($accounts){
            return response()->json($accounts,202);
        }
        else{
            $message=[
                'message'=>'vacio'
            ];
            return response()->json($message,202);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $account=Account::find($id);
        if($account){
            $account->delete();
            return response($account,202);
        }
        else{
            $message=[
                "message"=>'not found'
            ];
            return response()->json($message,404);
        }
    }
}
