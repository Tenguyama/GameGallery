<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required|string|min:1',
            'developer' => 'required|string|min:1',
            'genre' => 'required|string|min:1',
            'release_date' => 'required|date',
            'platform' => 'required|string|min:1',
            'price' => 'required|numeric|min:0',
            'img_url' => 'sometimes|nullable|url',
            'image' => 'sometimes|nullable|image|max:2048', // 2MB max size
        ];
    }
}
