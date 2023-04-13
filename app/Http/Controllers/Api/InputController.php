<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\InputRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InputController extends Controller
{

    public function makepic_validate(InputRequest $request)
    {
        return response()->json([
            'texts' => $request->input('texts'),
            'checkboxes' => $request->input('checkboxes'),
        ]);
    }
}
