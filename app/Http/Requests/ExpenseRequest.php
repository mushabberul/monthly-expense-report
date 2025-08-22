<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'category_id' => 'bail|required|exists:categories,id',
            'title' => 'bail|required|string|max:255',
            'amount' => 'bail|required|numeric|gt:1',
            'date' => 'bail|required|date|before_or_equal:today'
        ];
    }
}
