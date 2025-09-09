<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRoomsRequest extends FormRequest
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
            'check_in' => ['required','date','after_or_equal:today'],
            'check_out' => ['required','date','after:check_in'],
            'guests' => ['required','integer','min:1'],
            'page' => ['sometimes','integer','min:1'],
        ];
    }
}
