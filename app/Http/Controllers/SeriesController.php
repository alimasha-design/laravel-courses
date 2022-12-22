<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index($slug){
        $series = Series::where('slug', $slug)->with('courses')->first();


   //     return response()->json($series);

        if (empty($series)){
            return abort(404);
        }



        return view('series.single', [
            'series' => $series
        ]);

    }

}
