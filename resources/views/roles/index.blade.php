@extends('adminlte::page')


@section('content')

<nav class="navbar navbar-light bg-light">
    <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Criar nova Função</a>
            @endcan
    </div>
</nav>


<div class="card mt-3">
    <div class="card-header">
        <h2>Gerenciamento de Funções</h2>
    </div>
    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nome</th>
                <th width="280px">Ações</th>
            </tr>

            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Detalhes</a>
                    @can('role-edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
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
