<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
          'title' => 'required|unique:blogs,title',
          'category' => 'required',
          'des' => 'required',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'title' => 'required',Rule::unique('blogs','title')->ignore($this->id),
                'slug'=>'required',
                'category' => 'required',
                'des' => 'required',
                'status'=>'required',
            ];
        }
        return $rules;
    }

    public function messages()
    {
      return [
        'title.required' => 'This name is already Exists',
        'slug.required' => 'Blog Slug Name is required',
        'category.required' => 'Blog Category Name is required',
        'des.required' => 'Blog Description is required',
        'status.required' => 'Blog Staus is required',
      ];
    }
}
