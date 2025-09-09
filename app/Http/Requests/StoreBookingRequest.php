<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'room_id' => ['required','integer','exists:rooms,id'],
            'check_in' => ['required','date','after_or_equal:today'],
            'check_out' => ['required','date','after:check_in'],
            'guests' => ['required','integer','min:1'],
            // Contact details (from PDF “Contact Information” step)
            'full_name' => ['required','string','max:120'],
            'email' => ['required','email'],
            'phone' => ['nullable','string','max:30'],
        ];
    }
}
