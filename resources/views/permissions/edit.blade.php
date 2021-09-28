@extends('adminlte::page')

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Houve algum problema na sua entrada de dados.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{!! Form::model($permission, ['method' => 'PATCH','route' => ['permissions.update', $permission->id]]) !!}

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Editar Permissão</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <strong>Nome:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="clearfix">
                    <button type="submit" class="btn btn-secondary float-left">Salvar Permissão</button>
                    <a href="{{ route('permissions.index') }}" type="button" class="btn btn-secondary float-right text-white">Cancelar</a>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

{!! Form::close() !!}


@endsection
