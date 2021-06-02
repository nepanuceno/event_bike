@extends('adminlte::page')


@section('content')


    <div class="col-md-12">
        <div class="card" style="width: 25rem;">
            <img class="card-img-top" src="/storage/logo_events/{{ $event->logo }}" alt="Logo do Evento">
            <div class="card-body">
                <h2>{{ $event->name }}</h2>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Data do Evento: </strong>{{ $event->date_event }}</li>
                <li class="list-group-item"><strong>Modalidade: </strong>{{ $event->modality->name }}</li>
            </ul>
            <div class="card-body">
                <div class="bg-white clearfix">
                    @can('manager')
                        <a class="btn btn-success float-left mr-1 text-white" href="{{ route('event.edit',$event->id) }}">Editar</a>

                        {!! Form::open(['method' => 'DELETE','route' => ['event.destroy', $event->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Desativar', ['class' => 'btn btn-danger float-left']) !!}
                        {!! Form::close() !!}
                    @endcan
                    <a class="btn btn-default float-right" href="{{ url()->previous() }}">Voltar</a>
                </div>
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
