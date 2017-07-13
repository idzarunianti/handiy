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

    public function store(Request $request, $username){
        $this->validate($request,[
            'photo.*'=>'required|url',
            'username'=>'required',
            'tutorial_id'=>'required'
        ]);
        $creations = [
            'username'=>$request->get('username'),
            'tutorial_id'=>$request->get('tutorial_id'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];

        $creation_id = \DB::table('creations')->insertGetId($creations);
        $creations['creation_id'] = $creation_id;

        $photo = $request->get('photo');
        if(count($photo)>0){
          foreach ($photo as $item) {
              $dataPhoto = [
                  'creation_id' => $creation_id,
                  'photo' => $item,
                  'created_at' => Carbon::now(),
                  'updated_at'=>Carbon::now(),
              ];
              $photoId =\DB::table('photo_creations')->insertGetId($dataPhoto);
              $dataPhoto['id']=$photoId;

              $creations['photo'][] = $dataPhoto;
          }
      }

        return response()->json($creations);
    }

    public function index($username)
   {
        $creations = \DB::table('creations')->paginate(10);

        return response()->json($creations);
   }

   public function update(Request $request, $username, $creation_id)
   {
        $this->validate($request,[
            'username'=>'required',
            'tutorial_id'=>'required'
        ]);
        $creations = $request->all();
        $creations['updated_at'] = Carbon::now();
        
        \DB::table('creations')->where('creation_id',$creation_id)->update($creations);

        return response()->json($creations);  
   }

   public function destroy($username, $creation_id)
   {
        \DB::table('creations')->where('creation_id',$creation_id)->delete();

        return response()->json(['success']);
   }
}
