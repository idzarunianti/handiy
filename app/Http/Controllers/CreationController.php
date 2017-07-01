<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CreationController extends Controller
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

    public function store(Request $request){
        $this->validate($request,[
            'photo_url'=>'required',
            'username'=>'required',
            'tutorial_id'=>'required'
        ]);
        $creations = [
            'photo_url'=>$request->get('photo_url'),
            'username'=>$request->get('username'),
            'tutorial_id'=>$request->get('tutorial_id'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];

        $creation_id = \DB::table('creations')->insertGetId($creations);
        $creations['creation_id'] = $creation_id;

        return response()->json($creations);
    }

    public function index()
   {
        $creations = \DB::table('creations')->paginate(10);

        return response()->json($creations);
   }

   public function update(Request $request, $creation_id)
   {
        $this->validate($request,[
            'photo_url'=>'required',
            'username'=>'required',
            'tutorial_id'=>'required'
        ]);
        $creations = $request->all();
        $creations['updated_at'] = Carbon::now();
        
        \DB::table('creations')->where('creation_id',$creation_id)->update($creations);

        return response()->json($creations);  
   }

   public function destroy($creation_id)
   {
        \DB::table('creations')->where('creation_id',$creation_id)->delete();

        return response()->json(['success']);
   }
}
