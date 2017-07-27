<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PhotoTutorialsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request, $id){
        $detail_tutorials=\DB::table('photo_tutorials')->where('tutorial_id',$id)->get();

        return response()->json($detail_tutorials);

    }


   public function update(Request $request, $id)
   {
        $this->validate($request,[
            'tutorial'=>'max:1000',
            'photo'=>'url',
        ]);
        $tutorial = [
            'tutorial'=>$request->get('tutorial'),
            'photo'=>$request->get('photo'),
            'updated_at'=>Carbon::now(),
        ];

        \DB::table('photo_tutorials')->where('id', $id)->update($tutorial);

        $tutorial = \DB::table('photo_tutorials')->where('id', $id)->first();

        return response()->json($tutorial);
   }

}
