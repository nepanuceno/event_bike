@extends('adminlte::page')


@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Parece que houve algum problema com as insformações.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<div class="col-md-8">
    <div class="card">
        <div class="card-header bg-dark">
            <h3>Criar novo Grupo</h3>
        </div>

        <div class="row card-body">
            {!! Form::open(array('route' => 'tenant.store','method'=>'POST')) !!}
            <div class="form-group">
                <label for="name">Nome</label>
                {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                <label for="name">API Key da empresa de Cartao de Crédito</label>
                {!! Form::text('api_key', null, array('placeholder' => 'KEY','class' => 'form-control')) !!}
            </div>

        </div>

        <div class="card-footer">
            <div class="clearfix">
            <input type="submit" class="btn btn-primary float-left" value="Salvar Função" />
                <a href="{{ route('profile') }}" type="button" class="btn btn-secondary float-right text-white">Cancelar</a>
            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}

@endsection
