<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'year' => 'required|string',
            'poster' => 'mimes:jpg,bmp,png',
            'genre_id' => 'required|exists:genres,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'tidak boleh kosong',
            'title.max' => 'tidak boleh kosong',
            'summary.required' => 'tidak boleh kosong',
            'year.required' => 'tidak boleh kosong',
            'poster.mimes' => 'format poster hanya bisa jpg,bmp,png',
            'genre_id.required' => 'tidak boleh kosong',
            'genre_id.exists' => 'id genre tidak ditemukan di data genre',
        ];
    }               
}
