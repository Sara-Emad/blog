<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:50|unique:categories,name,' . $this->category,
            'description' => 'nullable|max:255',
        ];
    }
   
    public function messages()
    {
        return [
            'name.required' => 'Category name is required',
            'name.min' => 'Category name must contain at least 3 characters',
            'name.max' => 'Category name must not exceed 50 characters',
            'name.unique' => 'Category name already exists',
            'description.max' => 'Description must not exceed 255 characters',
        ];
    }
}