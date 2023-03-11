@extends('layout.picturediary')

@section('title', 'picture diary')

@section('main')
    <div>
        {{-- <img src="{{ storage_path('app/public/{{ $file_name }}') }}" alt=""> --}}
        <div>
            <img src="{{ asset("storage/{$file_path}") }}" alt="">
        </div>
        <div style="writing-mode: vertical-rl;">
            @foreach ($inputLineCount as $count)
                <p >{{ $sentences[$count] }}</p>
            @endforeach
        </div>
        <div>
            <a href="/">confirm</a>
        </div>
    </div>
@endsection

@section('footer')
    <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
@endsection
