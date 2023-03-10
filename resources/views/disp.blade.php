@extends('layout.picturediary')

@section('title', 'picture diary')

@section('header')
    @parent
    <nav>
        <ul class="clearfix">
            {{-- <li class="current"><a class="link" href="/">HOME</a></li> --}}
            <li><a class="link" href="input">New Diary</a></li>
        </ul>
    </nav>
@endsection

@section('main')

@endsection

@section('footer')
    <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
@endsection
