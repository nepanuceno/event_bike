@extends('adminlte::page')


@section('content')



<div class="container-fluid h-100">
    @foreach ($csv_head as $collum)
        <div class="card card-primary card-outline">
            <div class="card-header">
            <h5 class="card-title">{{ $collum }}</h5>
            </div>
            <div class="card-body">
                <select name="csv_head">
                    <option value="1">Coluna 1</option>
                    <option value="2">Coluna 2</option>
                    <option value="3">Coluna 3</option>
                    <option value="4">Coluna 4</option>
                    <option value="5">Coluna 5</option>
                    <option value="6">Coluna 6</option>
                </select>
            </div>
        </div>
    @endforeach
</div>


@if ($message = Session::get('success'))
    <span id="message" style="display: none">{{ $message }}</span>
@endif

@endsection

@section('js')
    <script src="{{ asset('js/sweetalert.js') }}"></script>

    @if ($message = Session::get('success'))
        <script>MessageAlert(['message','success']);</script>
    @endif

    @if ($message = Session::get('error'))
        <script>MessageAlert(['message','error']);</script>
    @endif

@endsection
