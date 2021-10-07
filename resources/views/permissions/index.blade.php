@extends('adminlte::page')

@section('content')

<div class="row pb-3">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
        @can('permission-create')
            <a class="btn btn-success" href="{{ route('permissions.create') }}"><i class="fas fa-plus-square"></i> {{ __('permissions.new_permission') }}</a>
        @endcan
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-dark">
    <h3>{{ __('permissions.permissions_management') }}</h3>
    </div>
    <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="25px">{{ __('permissions.id') }}</th>
                        <th>{{ __('permissions.name') }}</th>
                        <th width="200px">{{ __('permissions.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $key => $permission)
                    <tr>
                        <td class="align-middle text-center" scope="row">{{ ++$i }}</td>
                        <td class="align-middle">{{ $permission->name }}</td>
                        <td class="align-middle text-center">
                            @can('permission-edit')
                                <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}"><i class="fas fa-edit"></i> {{ __('permissions.edit') }}</a>
                            @endcan
                            @can('permission-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                    {{-- {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!} --}}
                                    <a href='#' class="btn btn-danger"><i class="fas fa-trash-alt"></i> {{ __('permissions.delete') }}</a>

                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
</div>


{!! $permissions->render() !!}

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
