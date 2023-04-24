@extends('layouts.app')

@section('content')
    <list-component :pic-items='@json($items)' :can-make-pic='@json($can_make_pic)'></list-component>
@endsection

@section('footer')
    <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
@endsection
