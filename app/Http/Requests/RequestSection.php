<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSection extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'section_name' => 'required|unique:sections|max:255',
            'descripation' => 'required'];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'section_name' => $this->section_name,
            'descripation' => $this->descripation,
            'created_by' => (auth()->user()->name)
        ];
    }
}
