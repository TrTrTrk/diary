@extends('layouts.app')

@section('content')
    <make-disp-component 
        :file-name='@json($fileName)' 
        :dir-name='@json($dirName)' 
        :sentences='@json($sentences)'
        :input-line-count='@json($inputLineCount)' 
        :route='@json($route)'
        :is-user='@json($isUser)'>
    </make-disp-component>
@endsection

@section('footer')
    <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
@endsection
