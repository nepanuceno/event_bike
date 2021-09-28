@extends('adminlte::page')


@section('content')

{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}

<div class="row">

    <div class="col-md-8">
        
        <div class="card">
            <div class="card-header bg-dark">
                <h3>Editar Função</h3>
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permissões:</strong>
                        <br/>
                        @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                            <br/>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="clearfix">
                        <button type="submit" class="btn btn-primary float-left">Salvar Alteração</button>
                        <a href="{{ route('roles.index') }}" type="button" class="btn btn-secondary float-right text-white">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
        
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

{!! Form::close() !!}

@endsection