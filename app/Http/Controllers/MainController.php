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
       
        $items =  DB::table('images')
                    ->leftjoin('sentences', 'images.imageName', '=', 'sentences.imageName')
                    ->orderBy('images.created_at')
                    ->limit(30)
                    ->get(['id','images.imageName','sentences']);

        return view('list', compact("items"));
    }
}
