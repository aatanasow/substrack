<?php

namespace App\Http\Requests;

use App\SubscriptionStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date' => ['required', 'date'],
            'price' => ['required', 'decimal:0,2'],
            'currency' => ['required'],
            'status' => ['required', Rule::enum(SubscriptionStatus::class)],
            'frequency' => ['required', 'string'],
            'notify' => ['nullable', 'integer'],
            'image_path' => ['nullable', 'image', 'max:5012'],
            'link' => ['nullable', 'url', 'max:255'],
        ];
    }
}
