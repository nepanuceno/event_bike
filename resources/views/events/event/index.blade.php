@extends('adminlte::page')

@section('content')

<div class="card card-secondary" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
    <div class="card-header pl-2 pr-0">
        @can('manager')
            @cannot('administrator')
            <a class="btn btn-app mb-2 ml-0 bg-olive mr-4" href="{{ route('event.create') }}"> <i class="fas fa-plus"></i> {{ __('events.create_an_event') }}</a>
            @endcannot
        @endcan
        <button type="button" class="btn btn-tool align-top float-right mr-0 ml-3" data-card-widget="maximize"><i class="fas fa-expand fa-2x"></i></button> <!-- Full Screen Activator Button !-->

        <div class="card-tools">
        <a class="btn btn-app  mb-1 bg-primary btn-tool" href="{{ url('event')}}">
            <span class="badge bg-success">{{ count($event_queries['all']) }}</span>
            <i class="fas fa-barcode"></i> {{ __('events.all_events_button') }}
          </a>
          <a class="btn btn-app mb-1 bg-info" href="{{ url('event/filter', 2)}}">
              <span class="badge bg-danger">{{ count($event_queries['released_events']) }}</span>
              <i class="fas fa-heart"></i> {{ __('events.releases_button') }}
          </a>
          <a class="btn btn-app mb-1 bg-success" href="{{ url('event/filter', 3)}}">
            <span class="badge bg-purple">{{ count($event_queries['open_subscriptions']) }}</span>
            <i class="fas fa-users"></i> {{ __('events.open_for_subscriptions_button')}}
          </a>
          <a class="btn btn-app mb-1 bg-warning" href="{{ url('event/filter', 4)}}">
            <span class="badge bg-info">{{ count($event_queries['closed_subscriptions']) }}</span>
            <i class="fas fa-envelope"></i> {{ __('events.registration_closed_button') }}
        </a>
        <a class="btn btn-app mb-1 bg-gradient-danger" href="{{ url('event/filter', 5)}}">
          <span class="badge bg-teal">{{ count($event_queries['past_events']) }}</span>
          <i class="fas fa-inbox"></i>{{ __('events.past_events_button') }}
        </a>

        <a class="btn btn-app mb-1 mr-1 bg-dark" href="{{ url('event/filter', 6)}}">
            <span class="badge bg-info">{{ count($event_queries['disabled_events']) }}</span>
            <i class="fas fa-ban"></i> {{ __('events.disabled_events_button') }}
        </a>

    </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <h3 class="">
            @switch($status)
            @case(1)
            {{ __('events.all_events_label') }}
            @break

            @case(2)
            {{ __('events.releases_label') }}
            @break

            @case(3)
            {{ __('events.open_for_subscriptions_label') }}
            @break

            @case(4)
            {{ __('events.registration_closed_label') }}
            @break

            @case(5)
            {{ __('events.past_events_label') }}
            @break

            @case(6)
            {{ __('events.disabled_events_label') }}
            @break

            @default
            {{ __('events.events') }}
            @endswitch
        </h3>

        @if(count($events) > 0)
        <div class="col-md-12 table-responsive-md">

            <table id="events" class="table display table-striped" style="width:100%">
                <thead class="bg-dark">
                    <tr>
                        <th>{{ __('events.event_name') }}</th>
                        <th>{{ __('events.event_place') }}</th>
                        <th>{{ __('events.event_date') }}</th>
                        <th>{{ __('events.registration_start_date') }}</th>
                        <th>{{ __('events.enrollment_end_date') }}</th>
                        <th>{{ __('events.modality') }}</th>
                        @cannot('administrator')
                        <th class="text-middle">{{ __('events.actions') }}</th>
                        @endcannot
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>
                                @cannot('administrator')
                                <a class="btn btn-outline-info" href="{{ route('event.show',$event->id) }}">
                                    <i class="fa fa-cogs mr-1"></i>{{ $event->name }}
                                </a>
                                @else
                                {{ $event->name }}
                                @endcannot()

                            </td>
                            <td>{{ $event->adress }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date_event)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->end_date)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $event->modality->name }}</td>
                            @cannot('administrator')
                            <td class="float-right">
                                @if($event->active <> 0)


                                    {{-- <a class="btn btn-success" href="{{ route('event.show',$event->id) }}"><i class="fa fa-cogs"> Configurações & Valores</i></a> --}}
                                    @can('manager')
                                        @cannot('administrator')
                                            <a class="btn btn-secondary" href="{{ route('event.edit',$event->id) }}"><i class="fa fa-edit"></i></a>
                                        @endcannot
                                    @endcan
                                    @can('manager')
                                        @cannot('administrator')
                                            {!! Form::open(['method' => 'DELETE','route' => ['event.destroy', $event->id],'style'=>'display:inline']) !!}
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type'=>'submit', 'class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcannot
                                    @endcan
                                    @else
                                    @can('manager')
                                    {!! Form::open(['method' => 'DELETE','route' => ['event.destroy', $event->id],'style'=>'display:inline']) !!}
                                    {!! Form::button('<i class="fa fa-arrow-up"> Reativar</i>', ['type'=>'submit','class' => 'btn bg-indigo']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    @endif
                            </td>
                            @endcannot
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info" role="alert">
                {{ __('events.without_events_message') }}
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
