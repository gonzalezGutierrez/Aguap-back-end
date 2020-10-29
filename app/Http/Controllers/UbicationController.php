<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Ubication;
use App\User;
class UbicationController extends Controller{
    
    public function index(){
        $ubication =Ubication::all();
        return response()->json($ubication);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->all();
        $ubication=new Ubication;
        $ubication->latitude=$request->latitude;
        $ubication->longitude=$request->longitude;
        $ubication->address=$request->address;
        $ubication->IS_GPS=$request->IS_GPS;
        $ubication->user_id=$request->user_id;
        $ubication->save();
        return response()->json($ubication,202);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $ubications=User::find($id)->ubications;
        if($ubications){
            
            return response()->json($ubications,202);
        }
        else{
            $message=[
                'message'=>'not found',
            ];
            
            return response()->json($message,404);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $ubication=Ubication::find($id);
        if($ubication){
            $ubication->delete();
            return response()->json($ubication);
        }
        else{
            $response=[
                'message'=>"not found ubication",
            ];
            return response()->json($response,404);
        }
          
    }
}
