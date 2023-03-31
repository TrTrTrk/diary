<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpParser\Builder\Function_;

class InputController extends Controller
{
    private $sentencesCount = 5;
   
    public function input()
    {
        // inputLineCountはユーザー設定の入力行数
        // 20230338 今は5個に固定   

        return view('input',['Counts' => range(0, $this->sentencesCount - 1) ]);

    }

}
