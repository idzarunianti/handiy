<?php

namespace App\Http\Controllers;

use App\Creation;
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

    public function store(Request $request, $username)
    {
        $this->validate($request, [
            'photo' => 'required|url',
            'kreasi' => 'required',
            'tutorial_id' => 'required'
        ]);
        $data = [
            'kreasi' => $request->get('kreasi'),
            'username' => $username,
            'photo' => $request->get('photo'),
            'tutorial_id' => $request->get('tutorial_id')
        ];

        $creations = Creation::create($data);
        return response()->json($creations);
    }

    public function index($username)
    {
        $creations = Creation::with('tutorial.steps')->where('username',$username)->paginate(10);

        return response()->json($creations);
    }

    public function update(Request $request, $username, $creation_id)
    {
        $this->validate($request, [
            'kreasi' => 'required',
            'photo' => 'required|url'
        ]);

        $creations = Creation::find($creation_id);
        $creations->update($request->only('kreasi','photo'));
        $creations = $creations->fresh();

        return response()->json($creations);
    }

    public function destroy($username, $creation_id)
    {
        Creation::find($creation_id)->delete();

        return response()->json(['success']);
    }
}
