<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SocialSettingRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'url' => 'required',
            'icon' => 'required',
            'status' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'title' => 'required',
                'url' => 'required',
                'icon' => 'required',
                'status' => 'required',
            ];
        }
        return $rules;
    }

    public function messages(){
        return [
            'title.required' => 'This Social Setting is already Exists',
            'url.required' => 'This Url is required',
            'icon.required' => 'This Icon is Required',
            'status.required' => 'This Status is Required',
        ];
    }
}
