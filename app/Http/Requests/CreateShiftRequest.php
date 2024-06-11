<?php

namespace App\Http\Requests;

use App\Rules\TodayorAfter;
use Illuminate\Foundation\Http\FormRequest;

class CreateShiftRequest extends FormRequest
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
            'date' => ['required','date', new TodayorAfter],
            'emails' => 'required|array',
            'emails.*' => [
                'required', 
                'string', 
                'email'
            ],
            'shift_id' => 'required|string'
        ];
    }
}
