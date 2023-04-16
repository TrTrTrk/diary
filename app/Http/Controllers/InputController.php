<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpParser\Builder\Function_;
use Illuminate\Support\Facades\Auth;
use DB;

class InputController extends Controller
{
    private $sentencesCount = 5;

    public function input()
    { 

        $id = Auth::id();

        $count = DB::table('users')->Where('id', $id)->get(['create_count']);

        return view('input', ['line_counts' => range(0, $this->sentencesCount - 1), 'create_count' => $count[0]->create_count]);
    }
}
