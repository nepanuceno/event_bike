@extends('adminlte::page')


@section('content')


    <div class="col-md-12">
        <div class="card" style="width: 25rem;">
            <img class="card-img-top" src="/storage/logo_events/{{ $event->logo }}" alt="Logo do Evento">
            <div class="card-body">
                <h5 class="card-title">{{ $event->name }}</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{ $event-> }}</li>
                <li class="list-group-item">{{ $event-> }}</li>
                <li class="list-group-item">{{ $event-> }}</li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
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
