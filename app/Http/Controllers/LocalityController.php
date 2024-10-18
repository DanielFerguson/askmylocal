<?php

namespace App\Http\Controllers;

use App\Models\Locality;

class LocalityController extends Controller
{
    public function show($state, $locality)
    {
        $locality = Locality::findByStateAndName($state, $locality);

        if (! $locality) {
            abort(404);
        }

        return $locality;

        // return view('locality.show', compact('locality'));
    }
}
