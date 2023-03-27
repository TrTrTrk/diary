@extends('layout.picturediary')

@section('title', 'picture diary')

@section('main')
    <div class="container">
        <div>
            @if (Auth::Check())
                <p>User: {{ $user->name }}</p>
            @else
                <p>No Login (<a href="/login">Login</a> <a href="/register">regist</a>)</p>
            @endif
        </div>
        <div>
            @if (Auth::Check())
                <a href="/input">make diary</a>
            @endif
        </div>
        <div>
            {{-- このループがVueの構文になる。 --}}
            @foreach ($collection as $item)

                @if ($loop->index % 3 == 0)
                    <div class="row">
                @endif

                <div class="col-md-4">
                    <img src="" alt="">
                </div>

                @if ($loop->index % 3 == 0)
                    </div>
                @endif
        @endforeach

    </div>

@endsection

@section('footer')
    <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
@endsection
