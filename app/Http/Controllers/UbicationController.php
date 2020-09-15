<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Ubication;

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
        $ubication->idUser=$request->idUser;
        $ubication->latitude=$request->latitude;
        $ubication->longitude=$request->longitude;
        $ubication->address=$request->address;
        $ubication->IS_GPS=$request->IS_GPS;
        $ubication->save();

        return response()->json($ubication);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
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
