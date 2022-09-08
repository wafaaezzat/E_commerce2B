<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize() // نفس الكلام اني لازم اكون مسجل دخول عشان اقدر اكسس ع كل الميثود دي
    {
        return true;
    }

    public function onCreate()
    {
        return [
            'category_id'     => 'required',
            'name'            => 'required',
            'desc'            => 'required',
            'price'           => 'required',
            'quantity'        => 'required',
//            'images'           => 'required  | mimes:jpeg,png,jpg',
        ];
    }

    public function onUpdate()
    {
        return [
            'category_id'     => 'required',
            'name'            => 'required',
            'desc'            => 'required',
            'price'           => 'required',
            'quantity'        => 'required',
//            'images'           => 'required | image | mimes:jpeg,png,jpg',
        ];
    }
    public function rules()
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    public function messages()
    {
        return [
            'category_id.required'    => 'category_id of category is required',
            'name.required'           => 'name of product is required',
            'desc.required'           => 'description  of product is required',
            'price.required'          => 'original_price of product is required',
            'quantity.required'          => 'quantity of product is required',
//            'images.required'             => 'image of product is required',
//            'images.mimes'                => 'image of product must be jpeg,png,jpg',
        ];
    }
}
