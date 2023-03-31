<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use DB;

class MainController extends Controller
{

    private function getImagePathes(): array
    {
        $path = public_path("storage/SamplePicture/*.png"); //ファイルパスを取得

        $filePathes = glob($path); //ファイル名一覧を取得 // $files = File::files($path);      

        $filePathes = str_replace('/var/www/html/public', '', $filePathes); //本番環境置くときにここはいらなくなる？

        return $filePathes;
    }

    public function main(Request $request)
    {
        // $user = Auth::user(); //ログインユーザー

        // $filePathes = $this->getImagePathes(); //特定フォルダ下の画像データを取得

        //DBから各画像の文章を取得する
        // $items = DB::select('select id, imageName from images Order by created_at LIMIT 10;');
        $items = DB::table('images')->orderBy('created_at')->limit(10)->get(['id','imageName']);

        return view('list', compact("items"));
    }
}
