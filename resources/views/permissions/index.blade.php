@extends('adminlte::page')

@section('content')

<div class="row pb-3">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
        @can('permission-create')
            <a class="btn btn-success" href="{{ route('permissions.create') }}"> Criar nova Permissão</a>
        @endcan
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary">
    <h3>Gerenciamento de Permissões</h3>
    </div>
    <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="25px">No</th>
                        <th>Nome</th>
                        <th width="168px">Ação</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $key => $permission)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $permission->name }}</td>
                        <td>
                            @can('permission-edit')
                                <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}">Editar</a>
                            @endcan
                            @can('permission-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}
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
@endif

@endsection

@section('js')
    <script src="js/sweetalert.js"></script>
    @if ($message = Session::get('success'))
        <script>MessageAlert(['message','success']);</script>
    @endif

    @if ($message = Session::get('error'))
        <script>MessageAlert(['message','error']);</script>
    @endif

    <script>deleteAlert('btn-danger')</script>
@endsection
