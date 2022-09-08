<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use function request;

class CategoryRequest extends FormRequest
{

    public function authorize() // نفس الكلام اني لازم اكون مسجل دخول عشان اقدر اكسس ع كل الميثود دي
    {
        return true;
    }

    public function onCreate()
    {
                return [
                'name'      => 'required|string',
                'desc'      => 'required',
                'image'     => 'required | image | mimes:jpeg,png,jpg',
            ];
    }

    public function onUpdate()
    {
        return [
            'name'      => 'required|string',
            'desc'      => 'required',
            'image'     => 'required | image | mimes:jpeg,png,jpg',
        ];
    }
    public function rules()
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    public function messages()
    {
        return [
            'name.required'     => 'name En of category is required',
            'desc.required'     => 'description Ar of category is required',
            'image.required'    => 'image of category is required',
            'image.mimes'       => 'image of category must be jpeg,png,jpg',
        ];
    }
}
