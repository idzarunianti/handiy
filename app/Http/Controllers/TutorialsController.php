<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TutorialsController extends Controller
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

   public function store(Request $request)
   {
        $this->validate($request,[
            'title'=>'required|max:255',
            'tutorial'=>'required|max:1000 ',
            'photo.*'=>'url',
            'category_id'=>'required',
        ]);
        $tutorial = [
            'title'=>$request->get('title'),
            'tutorial'=>$request->get('tutorial'),
            'category_id'=>$request->get('category_id'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
        $id = \DB::table('tutorials')->insertGetId($tutorial);
        $tutorial['id'] = $id;

        $photo = $request->get('photo');
        if(count($photo)>0){
          foreach ($photo as $item) {
              $dataPhoto = [
                  'tutorial_id' => $id,
                  'photo' => $item,
                  'created_at' => Carbon::now(),
                  'updated_at'=>Carbon::now(),
              ];
              $photoId =\DB::table('photo_tutorials')->insertGetId($dataPhoto);
              $dataPhoto['id']=$photoId;

              $tutorial['photo'][] = $dataPhoto;
          }
      }

        return response()->json($tutorial);
   }

   public function index(Request $request)
   {
        $tutorial = \DB::table('tutorials');

        if ($request->has('category_id')) {
          $tutorial = $tutorial->where('category_id', $request->get('category_id'));
        }

        $tutorial = $tutorial->paginate(10);

        return response()->json($tutorial);
   }

   public function update(Request $request, $id)
   {
        $this->validate($request,[
            'title'=>'max:255',
            'tutorial'=>'max:1000 ',
            'category_id'=>'required',
        ]);
        $tutorial = $request->all();
        $tutorial['updated_at'] = Carbon::now();
        
        \DB::table('tutorials')->where('id',$id)->update($tutorial);

        return response()->json($tutorial);  
   }

   public function destroy($id)
   {
        \DB::table('tutorials')->where('id',$id)->delete();

        return response()->json(['success']);
   }
}
