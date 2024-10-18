<?php

namespace App\Http\Controllers;

use App\Models\Locality;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = $request->input('query');

        $localities = Locality::where('name', 'like', "%{$query}%")->get();

        return response()->json($localities);
    }
}
