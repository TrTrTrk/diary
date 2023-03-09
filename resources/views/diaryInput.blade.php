@extends('layout.picturediary')

@section('title', 'picture diary')

@section('header')

@section('main')

    <div>
        <p>Check the sentences you want to draw.</p>
        <form action="submit" method="post">
            @csrf
            <div>
                @foreach ($inputLineCount as $count)
                    <div>
                        <input name="checkbox[]" type="checkbox" value={{$count}} placeholder="">
                        <input name="text{{ $count }}" type="text" placeholder="">
                    </div>
                @endforeach
            </div>
            <div>
                <input type="submit" value="Make Picture">
            </div>
        </form>
    </div>

@endsection
