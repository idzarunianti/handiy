<?php

namespace App\Http\Controllers;

use App\PhotoTutorial;
use App\Tutorial;
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'tutorial.*' => 'required|max:1000',
            'photo.*' => 'url',
            'category_id' => 'required',
        ]);

        $tutorial = Tutorial::create([
            'title' => $request->get('title'),
            'category_id' => $request->get('category_id'),
        ]);


        foreach ($request->get('tutorial') as $key => $step) {
            $data = [
                'tutorial' => $step,
            ];
            if (isset($request->get('photo')[$key])) {
                $data['photo'] = $request->get('photo')[$key];
            } else {
                $data['photo'] = null;
            }
            $tutorial->steps()->create($data);
        }

        $tutorial = $tutorial->fresh('steps');

        return response()->json($tutorial);
    }

    public function index(Request $request)
    {
        $tutorials = Tutorial::with('steps');

        if ($request->has('category_id')) {
            $tutorials = $tutorials->where('category_id', $request->get('category_id'));
        }

        $tutorials = $tutorials->paginate(10);

        return response()->json($tutorials);
    }

    public function show(Request $request, $id){
        
        $tutorial = Tutorial::find($id);
        $tutorial->load('steps');

        return response()->json($tutorial);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'max:255',
            'category_id' => 'required|exists:categories,category_id',
        ]);
        $tutorial = Tutorial::find($id);
        $tutorial->update($request->only(['title', 'category_id']));
        $tutorial = $tutorial->fresh();

        return response()->json($tutorial);
    }

    public function destroy($id)
    {
        Tutorial::find($id)->delete();

        return response()->json(['success']);
    }
}
