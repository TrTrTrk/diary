<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use PhpParser\Builder\Function_;
use Intervention\Image\Facades\Image;

class InputController extends Controller
{

    private $path = 'app/public/'; //保存場所として大丈夫？
    private $sentencesCount = 5;

    public function input()
    {
        // inputLineCountはユーザー設定の入力行数
        // 20230338 今は5個に固定
        return view('input', ['inputLineCount' => range(0, $this->sentencesCount - 1)]);
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

    private function getImageFromOpenAi(String $prompt)
    {
        $response = OpenAI::images()->create([
            'prompt' => $prompt . " 絵画風",
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);

        $url = $response->data[0]->url;

        $file_name = time() . ".png"; //現在のUnixタイムスタンプを利用してファイル名をつける

        $file_path = storage_path($this->path . $file_name); //保存場所として大丈夫？→~\storage\app\public以下の指定パスフォルダに保存される

        Image::make($url)->save($file_path);

        return $file_name; //ファイル名だけ返す
    }

    public function submit(Request $request)
    {

        //テキスト・チェックボックスにvalidationをかけよう！

        $prompt = $this->getSentences($request);

        // var_dump($request->toArray());

        $file_path = $this->getImageFromOpenAi($prompt);

        // var_dump($response);

        $array = array();

        foreach (range(0, $this->sentencesCount) as $num) {
            array_push($array,$request->input("text" . $num));
        }

        return view('disp', ['file_path' => $file_path, 'sentences' => $array,'inputLineCount' => range(0, $this->sentencesCount - 1)]);
    }
}
