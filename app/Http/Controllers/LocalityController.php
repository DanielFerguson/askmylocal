<?php

namespace App\Http\Controllers;

use App\Models\Locality;
use Illuminate\Http\Request;

class LocalityController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $localities = Locality::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('state', 'like', '%'.$search.'%');
        })
            ->limit(5)
            ->get();

        return response()->json($localities);
    }

    public function show($state, $locality)
    {
        $locality = Locality::findByStateAndName($state, $locality);

        if (! $locality) {
            abort(404);
        }

        $questions = $locality
            ->questions()
            ->get();

        $councillors = $locality
            ->councillors()
            ->get();

        return view('council', compact('locality', 'questions', 'councillors'));
    }
}
