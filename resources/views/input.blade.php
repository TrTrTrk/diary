@extends('layouts.app')

@section('content')
    <input-component
        :input-line-count='@json($Counts)'>
    </input-component>
@endsection

@section('footer')
    <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
@endsection
