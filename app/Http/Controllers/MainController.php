<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    private function getImagePathes()
    {
    }

    public function main(Request $request)
    {
        $user = Auth::user(); //ログインユーザー

        $param = ['user' => $user];

        //DBからユーザー名（Storage保存しているフォルダ名）のTOP10位を取得

        //取得したフォルダ名分だけループを回してファイルパスを取得

        //取得したパスで画像を表示する

        return view('list', $param);
    }
}
