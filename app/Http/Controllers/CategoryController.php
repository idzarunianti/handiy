<?php

namespace App\Http\Controllers;

use App\Category;
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
        $categories = Category::create([
            'namaKategori'=>$request->get('namaKategori'),
        ]);

        return response()->json($categories);
    }

    public function index()
   {
        $categories = Category::paginate(10);

        return response()->json($categories);
   }

   public function update(Request $request, $category_id)
   {
        $this->validate($request,[
            'namaKategori'=>'max:255',
        ]);
        $categories = Category::find($category_id);
        $categories->update($request->only('namaKategori'));
        $categories = $categories->fresh();

        return response()->json($categories);  
   }

   public function destroy($category_id)
   {
        Category::find($category_id)->delete();

        return response()->json(['success']);
   }
}
