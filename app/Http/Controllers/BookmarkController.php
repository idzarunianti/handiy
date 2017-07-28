<?php

namespace App\Http\Controllers;

use App\Bookmark;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function store(Request $request, $username)
    {
        $this->validate($request, [
            'tutorials_id' => 'required',
        ]);
        $bookmarks = [
            'tutorials_id' => $request->get('tutorials_id'),
            'username' => $username,
        ];

        $bookmarks = Bookmark::create($bookmarks);

        return response()->json($bookmarks);
    }

    public function index($username)
    {
        $bookmarks = Bookmark::where('username', $username)->with('tutorial')->paginate(10);

        return response()->json($bookmarks);
    }

    public function destroy($username, $bookmarks_id)
    {
        Bookmark::find($bookmarks_id)->delete();

        return response()->json(['success']);
    }
}
