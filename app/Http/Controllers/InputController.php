<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use PhpParser\Builder\Function_;

class InputController extends Controller
{
    public function input()
    {
        // inputLineCountはユーザー設定の入力行数
        // 20230338 今は5に固定
        return view('diaryinput', ['inputLineCount' => range(0, 4)]);
    }

    
    //テキストボックスの入力がすべてある前提
    private function getSentences(Request $request)
    {

        $checkboxNum = $request->input('checkbox');

        $sentences = "";

        foreach ($checkboxNum as $Num) {
            $sentences = $sentences . $request->input('text' . $Num);
        }

        return $sentences;
    }


    public function submit(Request $request)
    {

        //テキスト・チェックボックスにvalidationをかけよう！
        $prompt = $this->getSentences($request);

        var_dump($request->toArray());

        $response = OpenAI::images()->create([
            'prompt' => $prompt . " 絵画風",
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);

        var_dump($response);

        // foreach($response->data as $result) {
        // }

    }
}
