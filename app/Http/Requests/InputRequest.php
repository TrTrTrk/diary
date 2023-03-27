<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * このフォームリクエストを利用するアクションで、フォームリクエストの利用が許可されているかどうか
     */
    public function authorize(): bool
    {
        if ($this->path() == 'submit')
        {
            return true;            
        }
        else
        {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'checkbox' => 'required',
        ];
    }

    public function messages()
    {
        return ['checkbox.required' => 'どれか1つ必ずチェックしてください'];
    }

}
