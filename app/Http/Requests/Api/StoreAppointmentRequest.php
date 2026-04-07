<?php

namespace App\Http\Requests\Api;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAppointmentRequest extends FormRequest
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
            'service_id' => ['required', 'exists:services,id'],
            'date_time' => [
                'required',
                'date_format:Y-m-d H:i:s',
                'after:now',
                Rule::unique('appointments', 'date_time'),
                function ($attribute, $value, $fail) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $value);
                    if ($date->hour < 8 || ($date->hour >= 18 && ($date->minute > 0 || $date->second > 0))) {
                        $fail('The appointment must be between 08:00 and 18:00.');
                    }
                },
            ],
        ];
    }
}
