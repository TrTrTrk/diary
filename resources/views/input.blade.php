@extends('layouts.app')

{{-- このページのみ、ロード画面を表示したい --}}
<script src="{{ asset('js/custom.js') }}"></script>

@section('content')
    {{-- <input-component :input-line-count='@json($Counts)'></input-component> --}}

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-auto">
                <p>描きたい文章にチェックを入れます</p>
            </div>
        </div>
        @if ($errors->any())
            <div class="row justify-content-center">
                <div class="col-auto">
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-auto">
                @if ($create_count > 0)
                    <p>あと<b>{{ $create_count }}</b>回生成できます</p>
                @else
                    <p>上限回数を超えました。生成できません</p>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <form action="/make-disp" method="post" onsubmit="showLoading()">

                @csrf

                @if ($create_count > 0)
                    @foreach ($line_counts as $item)
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" name="checkboxes[]" type="checkbox"
                                    value="{{ $item }}" aria-label="Checkbox for following text input">
                            </div>
                            <input type="text" name="texts[]" class="form-control" aria-label="Text input with checkbox"
                                placeholder="">
                        </div>
                    @endforeach
                @endif

                <div class="row justify-content-center my-2">
                    <div class="col-auto">
                        @if ($create_count > 0)
                            <input class="btn btn-primary" type="submit" value="Make Picture">
                        @endif
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-primary" href="/">back</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('footer')
    <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
@endsection
