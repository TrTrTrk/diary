@extends('layouts.app')

{{-- このページのみ、ロード画面を表示したい --}}
<script src="{{ asset('js/custom.js') }}"></script>

@section('content')
    {{-- <input-component :input-line-count='@json($Counts)'></input-component> --}}

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-auto">
                <p>Check the sentences you want to draw.</p>

                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach

            </div>
        </div>

        <div class="row justify-content-center">
            <form action="/make-disp" method="post" onsubmit="showLoading()">

                @csrf

                <div class="row justify-content-center my-2">

                    @foreach ($Counts as $item)
                        <div class="row align-items-center my-1">
                            <input class="col-md-2 form-check form-check-input" type="checkbox" name="checkboxes[]"
                                value="{{ $item }}">
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="texts[]" placeholder="">
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="row justify-content-center my-2">
                    <div class="col-auto">
                        <input class="btn btn-primary" type="submit" value="Make Picture">
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('footer')
    <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
@endsection
