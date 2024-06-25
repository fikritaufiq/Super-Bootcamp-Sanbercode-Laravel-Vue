<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'summary' => 'required',
            'year' => 'required|date',
            'poster' => 'nullable|mimes:jpg,bmp,png',
            'genre_id' => 'required|exists:genres,id',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'title.max' => 'Title cannot be longer than 255 characters.',
            'summary.required' => 'Summary is required.',
            'year.required' => 'Year is required.',
            'poster.mimes' => 'Poster must be an image (jpg, bmp, png).',
            'genre_id.required' => 'Genre is required.',
        ];
    }
}
