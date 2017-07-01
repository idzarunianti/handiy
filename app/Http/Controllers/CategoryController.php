<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryController extends Controller
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
            'namaKategori'=>'required|max:255',
        ]);
        $categories = [
            'namaKategori'=>$request->get('namaKategori'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];

        $category_id = \DB::table('categories')->insertGetId($categories);
        $categories['category_id'] = $category_id;

        return response()->json($categories);
    }

    public function index()
   {
        $categories = \DB::table('categories')->paginate(10);

        return response()->json($categories);
   }

   public function update(Request $request, $category_id)
   {
        $this->validate($request,[
            'namaKategori'=>'max:255',
        ]);
        $categories = $request->all();
        $categories['updated_at'] = Carbon::now();
        
        \DB::table('categories')->where('category_id',$category_id)->update($categories);

        return response()->json($categories);  
   }

   public function destroy($category_id)
   {
        \DB::table('categories')->where('category_id',$category_id)->delete();

        return response()->json(['success']);
   }
}
