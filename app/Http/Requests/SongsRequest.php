<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|string|max:255',
           'image'=>'required|file',
           'audio'=>'required|file',
           'artist_id'=>'required|integer',
        ];
    }
}
