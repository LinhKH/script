<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogCategoryRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'title' => 'required|unique:b_categories,title',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'title' => 'required',Rule::unique('b_categories','title')->ignore($this->id),
                'slug'=>'required',
                'status'=>'required',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'This name is already Exists',
            'title_slug.required' => 'Category Slug Name is required',
            'status.required' => 'Category Staus is required',
        ];
    }
}
