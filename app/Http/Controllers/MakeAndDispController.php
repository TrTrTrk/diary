<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use Exception;
// use Illuminate\Support\Facades\DB;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\InputRequest;
use Carbon\Carbon;
use SebastianBergmann\CliParser\Exception as CliParserException;

use function PHPUnit\Framework\throwException;

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
            throw $e;
            // return response()->json(['error' => 'Failed to generate image.']);
        } catch (Exception $e) {
            throw $e;
            // return response()->json(['error' => $e->getMessage()]);
        }

        $url = $response->data[0]->url;

        // time() 現在のUnixタイムスタンプを利用してファイル名をつける
        $file_name = Carbon::now()->format('U.u') . ".png";

        $userId = $this->getUserId();

        $file_path = storage_path($this->path . $userId . "/" . $file_name); //保存場所として大丈夫？→~\storage\app\public以下の指定パスフォルダに保存される

        Image::make($url)->save($file_path);

        return $file_name;
    }

    public function makepic(InputRequest $request)
    {

        $texts = $request->input('texts');

        $prompt = $this->getSentences($request); //画像にしたい文章を取得する

        try {
            $file_name = $this->getImageFromOpenAi($prompt);
        } catch (exception $e) {
            $message = 'リクエストは安全システムで許可されていないテキストが含まれている場合があります。';
            return back()->withErrors(['openai_exception'=>$message]);
        }

        session()->put("filename", $file_name);
        session()->put("texts", $texts);

        $user = Auth::user();

        DB::table('users')
            ->where('id', $user->id)
            ->decrement('create_count');

        return view(
            'make-disp',
            [
                'fileName' => $file_name,
                'dirName' => $user->id,
                'sentences' => $texts,
                'inputLineCount' => range(0, $this->sentencesCount - 1),
                'route' => __FUNCTION__,
                'isUser' => false
            ]
        );
    }

    public function disp(Request $request)
    {

        $file_name = $request->imageName; //URLクエリの値をとる

        if (empty($file_name)) {
            return redirect()->route('/');
        }

        $sentences = DB::table('sentences')->Where('imageName', $file_name)->get(['sentences']);

        if ($sentences->isnotEmpty()) {
            $sentences = $sentences[0]->sentences;
        } else {
            $sentences = "";
        }

        $target_sentences = explode("\\n", $sentences);

        $user = DB::table('images')->Where('imageName', $file_name)->get('id');

        // sentencesCountは、$sentencesの\n個数+1にする。

        return view(
            'make-disp',
            [
                'fileName' => $file_name,
                'dirName' => $user[0]->id,
                'sentences' => $target_sentences,
                'inputLineCount' => range(0, $this->sentencesCount - 1),
                'route' => __FUNCTION__,
                'isUser' => $user[0]->id == Auth::id() ? true : false,
            ]
        );
    }

    public function create(Request $request)
    {
        $user_id = Auth::user()->id;

        $file_name = session('filename');

        $param_images = [
            "id" => $user_id,
            "imageName" => $file_name,
        ];

        $texts = session('texts');

        $param_sentences = [
            "imageName" => $file_name,
            "sentences" => implode('\n', $texts),
        ];

        if (DB::table('images')->insert($param_images) && DB::table('sentences')->insert($param_sentences)) {
            session()->forget('filename');
            session()->forget('texts');
        } else {
            throw Exception("Fail Insert to Database");
        }

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

    public function delete(Request $request)
    {

        $file_name = $request->imageName; //URLクエリの値をとる
        $dir_name = $request->dirName; //URLクエリの値をとる

        if (empty($file_name)) {
            return redirect()->route('/');
        }

        if (
            !DB::table('images')->where('imagename', $file_name)->delete() > 0 ||
            !DB::table('sentences')->where('imagename', $file_name)->delete() > 0 ||
            !Storage::disk('public')->delete($dir_name . "/" . $file_name)
        ) {
            throw Exception("Delete Image file Failed");
        }

        return redirect()->route("main");
    }
}
