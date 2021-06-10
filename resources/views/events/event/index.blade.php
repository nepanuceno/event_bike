@extends('adminlte::page')


@section('content')

<a class="btn btn-app bg-success mb-2" href="{{ route('event.create') }}"> <i class="fas fa-plus"></i> Criar um evento</a>

<div class="card card-primary" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
    <div class="card-header">
      <h3 class="card-title">Eventos</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="col-md-12 table-responsive-md">
            <table id="events" class="table display table-striped" style="width:100%">
                <thead class="bg-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Local do Evento</th>
                        <th>Data do Evento</th>
                        <th>Início das Inscrições</th>
                        <th>Fim das Inscrições</th>
                        <th>Modalidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->adress }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date_event)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->end_date)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $event->modality->name }}</td>
                            <td>
                                <a class="btn btn-success" href="{{ route('event.show',$event->id) }}">Configurações & Valores</a>
                                @can('manager')
                                    <a class="btn btn-secondary" href="{{ route('event.edit',$event->id) }}">Editar</a>
                                @endcan
                                @can('manager')
                                    {!! Form::open(['method' => 'DELETE','route' => ['event.destroy', $event->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Desativar', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
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
