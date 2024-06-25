<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMovieRequest;

class MovieController extends Controller
{
    public function store(StoreMovieRequest $request){
        return response()->json([
            "message" => "Success"
        ], 200);
    }
}
