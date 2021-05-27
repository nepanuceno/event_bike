@extends('adminlte::page')

@section('content')

<div class="row pb-3">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Categorias</h2>
        </div>
        <div class="pull-right">
        @can('manager')
            <a class="btn btn-success" href="{{ route('category.create') }}"> Criar nova Categoria</a>
        @endcan
        </div>
    </div>
</div>

@if($categories)

<table class="table table-bordered">
  <tr>
     <th width="25px">No</th>
     <th>Nome</th>
     <th width="168px">Ação</th>
  </tr>
    @foreach ($categories as $key => $category)
    <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $category->name }}</td>
        <td>
            @can('manager')
                <a class="btn btn-primary" href="{{ route('category.edit',$category->id) }}">Editar</a>
            @endcan
            @can('manager')
                {!! Form::open(['method' => 'DELETE','route' => ['category.destroy', $category->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>
@else
    <div class="alert alert-warning alert-dismissible fade show pb-3">
        <p>Não existem Categorias cadastradas</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif


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
