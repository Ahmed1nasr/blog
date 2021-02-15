<?php

namespace App\Http\Requests\Api\V1\Wink\User;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod("POST")) {
            return [
                'title' => ['required', 'string', 'min:3', 'max:500'],
                'excerpt' => ['nullable', 'max:1000'],
                'slug' => ['nullable', 'max:400', 'unique:wink_posts,slug'],
                'body' => ['nullable', 'max:999999'],
                'featured_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
                'featured_image_caption' => ['nullable', 'max:100'],
                'meta' => ['nullable', 'array'],
                'published' => ['nullable', 'boolean'],
                'publish_date' => ['nullable' , 'date'],
                'tags' => ['nullable', 'array', 'max:10'],
                'tags.*' => ['exists:wink_tags,id']
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'title' => ['sometimes', 'string', 'min:3', 'max:500'],
                'excerpt' => ['sometimes ', 'nullable', 'max:1000'],
                'slug' => ['sometimes ', 'nullable', 'max:400', 'unique:wink_posts,slug'],
                'body' => ['sometimes ', 'nullable', 'max:999999'],
                'featured_image' => ['sometimes ', 'nullable', 'image', 'mimes:png,jpg,jpeg'],
                'featured_image_caption' => ['sometimes ', 'nullable', 'max:100'],
                'meta' => ['sometimes ', 'nullable', 'array'],
                'published' => ['sometimes ', 'nullable', 'boolean'],
                'publish_date' => ['sometimes ', 'nullable' , 'date'],
                'tags' => ['sometimes ', 'nullable', 'array', 'max:10'],
                'tags.*' => ['exists:wink_tags,id']
            ];
        } else {
            return [];
        }
    }
}
