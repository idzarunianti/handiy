<?php

namespace App\Http\Controllers;

use App\User;
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:25',
            'email' => 'required|max:255',
            'name' => 'required|max:100'
        ]);

        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        if ($user == null) {
            $users = [
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'name' => $request->get('name'),
            ];
            $user = User::create($users);
        }

        return response()->json($user);
    }

    public function index()
    {
        $users = User::paginate(10);

        return response()->json($users);
    }

    public function update(Request $request, $username)
    {
        $this->validate($request, [
            'name' => 'max:100',
        ]);

        User::find($username)->update($request->only('name'));

        $user = User::find($username);

        return response()->json($user);
    }

    public function destroy($username)
    {
        User::find($username)->delete();

        return response()->json(['success']);
    }

}
