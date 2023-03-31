<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Requests\InputRequest;
use Exception;
// use Illuminate\Support\Facades\DB;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MakeAndDispController extends Controller
{

    private $path = 'app/public/'; //保存場所として大丈夫？
    private $sentencesCount = 5;

    //テキストボックスの入力がすべてある前提
    private function getSentences(Request $request)
    {

        $checkboxNum = $request->input('checkboxes');

        $texts = $request->input('texts');

        $sentences = "";

        foreach ($checkboxNum as $Num) {
            $sentences = $sentences . $texts[$Num];
        }

        return $sentences;
    }

    private function getUserId()
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

        $url = $response->data[0]->url;

        $file_name = time() . ".png"; //現在のUnixタイムスタンプを利用してファイル名をつける

        $userId = $this->getUserId();

        $file_path = storage_path($this->path . $userId . "/" . $file_name); //保存場所として大丈夫？→~\storage\app\public以下の指定パスフォルダに保存される

        Image::make($url)->save($file_path);

        return $file_name;
    }

    public function makepic(Request $request)
    {

        $array = $request->input('texts');

        $prompt = $this->getSentences($request); //画像にしたい文章を取得する

        $file_name = $this->getImageFromOpenAi($prompt);

        session()->put("filename", $file_name);

        $user = Auth::user();

        $file_path = $user->id . "/" . $file_name;

        return view(
            'make-disp',
            [
                'filePath' => $file_path,
                'sentences' => $array,
                'inputLineCount' => range(0, $this->sentencesCount - 1)
            ]
        );
    }

    public function create(Request $request)
    {
        $file_name = session('filename');

        session()->forget('filename');

        $param = [
            "id" => Auth::user()->id,
            "imageName" => $file_name,
        ];

        DB::table('images')->insert($param);

        return redirect()->route("main");
    }

    public function cancel()
    {
        $file_name = session('filename');

        session()->forget('filename');

        if (!Storage::disk('public')->delete(Auth::user()->id . "/" . $file_name)) {

            throw Exception("Delete Image File Failed");

        }

        return redirect()->route("main");
    }
}
