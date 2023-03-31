@extends('layouts.app')

@section('content')
    <make-disp-component :file-path='@json($filePath)' :sentences='@json($sentences)' :input-line-count='@json($inputLineCount)'>    </make-disp-component>
@endsection

@section('footer')
    <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
@endsection
