<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PublishPostRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can_publish;
    }

    public function rules()
    {
        return [
            'title' => 'required|unique:posts|max:100',
            'content' => 'required|min:50',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Нужно указать заголовок!',
            'title.unique' => 'Такой заголовок уже есть.',
            'content.min' => 'Слишком короткий текст (минимум :min символов).',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Заголовок',
            'content' => 'Текст статьи',
        ];
    }
}
