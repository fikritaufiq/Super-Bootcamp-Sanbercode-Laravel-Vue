<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CastMovieRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'cast_id' => 'required|exists:casts,id',
            'movie_id' => 'required|exists:movies,id',
        ];
    }
}
