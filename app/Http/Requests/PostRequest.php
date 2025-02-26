<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|min:5',
            'description' => 'required|min:5|max:255',
            'category_id' => 'required|exists:categories,id',
        ];
    
        // When creating a new post, or when uploading a new image
        if ($this->isMethod('POST') || $this->hasFile('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }
    
        return $rules;
    }
    
    public function messages()
    {
        return [
            'title.required' => 'Post title is required',
            'title.min' => 'Title must contain at least 5 characters',
            'description.required' => 'Post description is required',
            'description.min' => 'Description must contain at least 5 characters',
            'description.max' => 'Description must not exceed 255 characters',
            'image.required' => 'Post image is required',
            'image.image' => 'The uploaded file must be an image',
            'image.mimes' => 'The image must be of type: jpeg, png, jpg, gif',
            'image.max' => 'Image size must not exceed 2MB',
            'category_id.required' => 'You must select a category for the post',
            'category_id.exists' => 'The selected category does not exist',
        ];
    }
}