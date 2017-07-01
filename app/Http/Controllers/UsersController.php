<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class UsersController extends Controller
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
            'username'=>'required|max:25',
            'password'=>'required|max:255',
            'name'=>'required|max:100'
        ]);
        $users = [
            'username'=>$request->get('username'),
            'password'=>$request->get('password'),
            'name'=>$request->get('name'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];

        \DB::table('users')->insert($users);

        return response()->json($users);
    }

    public function index()
   {
        $users = \DB::table('users')->paginate(10);

        return response()->json($users);
   }

   public function update(Request $request, $username)
   {
        $this->validate($request,[
            'password'=>'max:255',
            'name'=>'max:100',
        ]);
        $users = $request->all();
        $users['updated_at'] = Carbon::now();
        
        \DB::table('users')->where('username',$username)->update($users);

        return response()->json($users);  
   }

   public function destroy($username)
   {
        \DB::table('users')->where('username',$username)->delete();

        return response()->json(['success']);
   }

}
