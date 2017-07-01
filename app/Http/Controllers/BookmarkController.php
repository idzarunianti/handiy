<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class BookmarkController extends Controller
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
            'tutorials_id'=>'required',
            'username'=>'required',
        ]);
        $bookmarks = [
            'tutorials_id'=>$request->get('tutorials_id'),
            'username'=>$request->get('username'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];

        $bookmarks_id = \DB::table('bookmarks')->insertGetId($bookmarks);
        $bookmarks['bookmarks_id'] = $bookmarks_id;

        return response()->json($bookmarks);
    }

    public function index()
   {
        $bookmarks = \DB::table('bookmarks')->paginate(10);

        return response()->json($bookmarks);
   }

   public function update(Request $request, $bookmarks_id)
   {
        $this->validate($request,[
            'tutorials_id'=>'required',
            'username'=>'required',
        ]);
        $bookmarks = $request->all();
        $bookmarks['updated_at'] = Carbon::now();
        
        \DB::table('bookmarks')->where('bookmarks_id',$bookmarks_id)->update($bookmarks);

        return response()->json($bookmarks);  
   }

   public function destroy($bookmarks_id)
   {
        \DB::table('bookmarks')->where('bookmarks_id',$bookmarks_id)->delete();

        return response()->json(['success']);
   }
}
