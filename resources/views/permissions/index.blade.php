@extends('adminlte::page')

@section('content')

<div class="row pb-3">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Permissões</h2>
        </div>
        <div class="pull-right">
        @can('permission-create')
            <a class="btn btn-success" href="{{ route('permissions.create') }}"> Criar nova Permissão</a>
        @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show pb-3">
        <p>{{ $message }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<table class="table table-bordered">
  <tr>
     <th width="25px">No</th>
     <th>Nome</th>
     <th width="168px">Ação</th>
  </tr>
    @foreach ($permissions as $key => $permission)
    <tr>
        <td>{{ ++$i }}</td>
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
</table>

<!-- {!! $permissions->render() !!} -->

@endsection
