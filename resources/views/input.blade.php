@extends('layout.picturediary')

@section('title', 'picture diary')

@section('main')

    <div>
        <p>Check the sentences you want to draw.</p>
        {{-- validateでエラーが出たとき --}}
        @if (count($errors) > 0)
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="submit" method="post">
            @csrf
            <div>
                @foreach ($inputLineCount as $count)
                    <div>
                        <input name="checkbox[]" type="checkbox" value={{ $count }} placeholder="">
                        <input name="text{{ $count }}" type="text" placeholder=""value="{{old('text' . $count)}}">
                    </div>
                @endforeach
            </div>
            <div>
                <input type="submit" value="Make Picture">
            </div>
        </form>
    </div>

@endsection
