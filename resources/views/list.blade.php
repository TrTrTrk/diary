@extends('layouts.app')

@section('content')
    <list-component :pic-items='@json($items)' :is-login='@json(Auth::check())'></list-component>
@endsection

@section('footer')
    <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
@endsection
