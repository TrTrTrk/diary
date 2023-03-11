<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DispController extends Controller
{
    public function disp(String $file_path, array $sentences, int $inputLineCount)
    {
        return view('disp',['file_path' => $file_path, 'sentences' => $sentences, 'inputLineCount' => $inputLineCount]);
    }
}
