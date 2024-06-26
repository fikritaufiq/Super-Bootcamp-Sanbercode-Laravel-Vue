<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\http\Requests\MovieRequest;

class MovieController extends Controller
{
    public function store(MovieRequest $request){
        return response()->json([
            "message" => "Success"
        ], 200);
    }
}
