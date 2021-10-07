@extends('adminlte::page')


@section('content')

<nav class="navbar navbar-light bg-light">
    <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fas fa-plus-square"></i> {{__('roles.new_role') }}</a>
        @endcan
    </div>
</nav>

<div class="card mt-2">
    <div class="card-header bg-dark">
        <h3>{{ __('roles.role_management') }}</h3>
    </div>
    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th width="35px">{{ __('roles.id') }}</th>
                <th>{{ __('roles.name') }}</th>
                <th width="280px">{{ __('roles.actions') }}</th>
            </tr>

            @foreach ($roles as $key => $role)
            <tr>
                <td class="align-middle text-center">{{ ++$i }}</td>
                <td class="align-middle">{{ $role->name }}</td>
                <td width="220px" class="align-middle text-center">
                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}"><i class="fas fa-info"></i> {{ __('roles.details') }}</a>
                    @can('role-edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-edit"></i> {{ __('roles.edit') }}</a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {{-- {!! Form::submit(__('roles.delete'), ['class' => 'btn btn-danger']) !!} --}}
                            <a href='#' class="btn btn-danger"><i class="fas fa-trash-alt"></i> {{ __('roles.delete') }}</a>
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>
  </div>
</div>

{!! $roles->render() !!}


@if ($message = Session::get('success'))
    <span id="message" style="display: none">{{ $message }}</span>
    <span id="msg_status" style="display: none">{{ __('roles.success') }}</span>
@endif

@if ($message = Session::get('error'))
    <span id="message" style="display: none">{{ $message }}</span>
    <span id="msg_status" style="display: none">{{ __('roles.error') }}</span>
@endif

<span id="title" style="display: none">{{ __('roles.are_you_sure') }}?</span>
<span id="text" style="display: none">{{ __('roles.alert_not_reversed') }}</span>
<span id="text_button" style="display: none">{{ __('roles.confirm_delete') }}</span>
@endsection

@section('js')
    <script src="/js/sweetalert.js"></script>
    @if ($message = Session::get('success'))
        <script>
            let msg_status = document.querySelector('#msg_status').textContent;
            MessageAlert(['message','success', msg_status]);
        </script>
    @endif

    @if ($message = Session::get('error'))
        <script>
            let msg_status = document.querySelector('#msg_status').textContent;
            MessageAlert(['message','error', msg_status]);
        </script>
    @endif

    <script>
        let title = document.querySelector('#title').textContent;
        let text = document.querySelector('#text').textContent;
        let text_button = document.querySelector('#text_button').textContent;

        deleteAlert(['btn-danger',title, text, 'warning', text_button])
    </script>

@endsection
