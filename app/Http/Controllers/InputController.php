<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use PhpParser\Builder\Function_;
use Intervention\Image\Facades\Image;
use App\Http\Requests\InputRequest;
use Illuminate\Support\Facades\Auth;

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
    private function getSentences(InputRequest $request)
    {

        $checkboxNum = $request->input('checkbox');

        $sentences = "";

        foreach ($checkboxNum as $Num) {
            $sentences = $sentences . $request->input('text' . $Num);
        }

        return $sentences;
    }

    private function checkUserDir()
    {
        $user = Auth::user();

        $dirName = storage_path($this->path . $user->id);

        if (!file_exists($dirName)) {
            mkdir($dirName);
        }

        return $user->id;
    }

    private function getImageFromOpenAi(String $prompt)
    {

        try {
            $response = OpenAI::images()->create([
                'prompt' => $prompt . " 絵画風",
                'n' => 1,
                'size' => '256x256',
                'response_format' => 'url',
            ]);
        } catch (FailedRequestException $e) {
            return response()->json(['error' => 'Failed to generate image.']);
        }

        // $url = $response->data[0]->url;
        // $file_name = time() . ".png"; //現在のUnixタイムスタンプを利用してファイル名をつける
        // $userId = checkUserDir();
        // $file_path = storage_path($this->path . $userId . "/". $file_name); //保存場所として大丈夫？→~\storage\app\public以下の指定パスフォルダに保存される
        // Image::make($url)->save($file_path);

        // 生成された画像を保存する
        $image_data = base64_decode($response->data[0]->url);
        $file_name = time() . '.png';
        $userId = checkUserDir();
        $file_path = $userId . "/" . $file_name;
        Storage::disk('public')->put($file_path, $image_data); //'public'は /Storage/app/public にアクセス

        return $file_name; //ファイル名だけ返す
    }

    public function submit(InputRequest $request)
    {

        $prompt = $this->getSentences($request); //画像にしたい文章を取得する

        // var_dump($request->toArray());

        $file_path = $this->getImageFromOpenAi($prompt);

        // var_dump($response);

        $array = array();

        foreach (range(0, $this->sentencesCount) as $num) {
            array_push($array, $request->input("text" . $num));
        }

        return view('disp', ['file_path' => $file_path, 'sentences' => $array, 'inputLineCount' => range(0, $this->sentencesCount - 1)]);
    }
}
