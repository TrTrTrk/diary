<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\TextRequired;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class InputRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * このフォームリクエストを利用するアクションで、フォームリクエストの利用が許可されているかどうか
     */
    public function authorize(): bool
    {
        if ($this->path() == 'make-disp') {
            return true;
        }

        return false;
    }

    private function getArrayString(array $texts): array
    {
        $result = array();

        foreach ($texts as $key => $value) {
            array_push($result, "texts[" . $key . "]");
        }

        return $result;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     * 
     *             'checkboxes' => 'required','texts[]' => 'required_if:checkboxes[],true',
     *             'checkboxes.*' => 'required',            'textboxes.*' => 'required_if:checkboxes.*,1',
     */

    public function rules(Request $request)
    {

        return [
            'checkboxes' => 'required',
            'texts' => new TextRequired(),
        ];

    }

    public function messages()
    {
        return [
            'checkboxes.required' => 'どれか1つ必ずチェックしてください。',
        ];
       
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     $response = response()->json([
    //         'status' => 400, //jsonの返事の中身のエラー番号
    //         'errors' => $validator->errors(),
    //     ], 400); //実際に送られるresponse codeが400番　これが無いと、jsonでエラーメッセージは返ってくるけど送れらてくるのは200番のstatusOKとくる。

    //     throw new HttpResponseException($response); //例外を知らせる。throw new 例外クラス名（例外message）
    // }
}
