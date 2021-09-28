@extends('adminlte::page')


@section('content')
<div class="card card-secondary" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
    <div class="card-header pl-2 pr-0">
        <a class="btn btn-app mb-2 ml-0 bg-olive mr-4" href="{{ route('event.create') }}"> <i class="fas fa-plus"></i> Criar um evento</a>
        <button type="button" class="btn btn-tool align-top float-right mr-0 ml-3" data-card-widget="maximize"><i class="fas fa-expand fa-2x"></i></button>

        <div class="card-tools">
        <a class="btn btn-app  mb-1 bg-primary btn-tool" href="{{ url('event')}}">
            <span class="badge bg-success">{{ count($event_queries['all']) }}</span>
            <i class="fas fa-barcode"></i> Todos
          </a>
          <a class="btn btn-app mb-1 bg-info" href="{{ url('event/filter', 2)}}">
              <span class="badge bg-danger">{{ count($event_queries['released_events']) }}</span>
              <i class="fas fa-heart"></i> Lançamentos
          </a>
          <a class="btn btn-app mb-1 bg-success" href="{{ url('event/filter', 3)}}">
            <span class="badge bg-purple">{{ count($event_queries['open_subscriptions']) }}</span>
            <i class="fas fa-users"></i> Abertos
          </a>
          <a class="btn btn-app mb-1 bg-warning" href="{{ url('event/filter', 4)}}">
            <span class="badge bg-info">{{ count($event_queries['closed_subscriptions']) }}</span>
            <i class="fas fa-envelope"></i> Encerrados
        </a>
        <a class="btn btn-app mb-1 bg-gradient-danger" href="{{ url('event/filter', 5)}}">
          <span class="badge bg-teal">{{ count($event_queries['past_events']) }}</span>
          <i class="fas fa-inbox"></i> Executados
        </a>

        <a class="btn btn-app mb-1 mr-1 bg-dark" href="{{ url('event/filter', 6)}}">
            <span class="badge bg-info">{{ count($event_queries['disabled_events']) }}</span>
            <i class="fas fa-ban"></i> Desativados
        </a>

    </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <h3 class="">
            @switch($status)
            @case(1)
            Todos os Eventos
            @break
            
            @case(2)
            Eventos Lançados Recentemente
            @break
            
            @case(3)
            Eventos com Inscrições Abertas
            @break
            
            @case(4)
            Eventos com Inscrições Encerradas
            @break
            
            @case(5)
            Eventos que já aconteceram
            @break
            
            @case(6)
            Eventos Desativados
            @break
            
            @default
            Eventos
            @endswitch
        </h3>

        @if(count($events) > 0)
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
                        <th class="text-middle">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>
                                <a class="btn btn-outline-info" href="{{ route('event.show',$event->id) }}">
                                    <i class="fa fa-cogs mr-1"></i>{{ $event->name }}
                                </a>
                            </td>
                            <td>{{ $event->adress }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date_event)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->end_date)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $event->modality->name }}</td>
                            <td class="float-right">
                                @if($event->active <> 0)
                                <div class="btn-group">

                                    {{-- <a class="btn btn-success" href="{{ route('event.show',$event->id) }}"><i class="fa fa-cogs"> Configurações & Valores</i></a> --}}
                                    @can('manager')
                                    <a class="btn btn-secondary" href="{{ route('event.edit',$event->id) }}"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('manager')
                                    {!! Form::open(['method' => 'DELETE','route' => ['event.destroy', $event->id],'style'=>'display:inline']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type'=>'submit', 'class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </div>
                                @else
                                    @can('manager')
                                        {!! Form::open(['method' => 'DELETE','route' => ['event.destroy', $event->id],'style'=>'display:inline']) !!}
                                            {!! Form::button('<i class="fa fa-arrow-up"> Reativar</i>', ['type'=>'submit','class' => 'btn bg-indigo']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info" role="alert">
                Não há resultados para esta consulta!
            </div>
            @endif

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
