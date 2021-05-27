@extends('adminlte::page')

@section('content')


<div class="row pb-3">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Modalidades</h2>
        </div>
        <div class="pull-right">
        @can('manager')
            <a class="btn btn-success" href="{{ route('modality.create') }}"> Criar nova Modalidade</a>
        @endcan
        </div>
    </div>
</div>

@if(!empty($modalities))

<table class="table table-bordered">
  <tr>
     <th width="25px">No</th>
     <th>Nome</th>
     <th width="168px">Ação</th>
  </tr>
    @foreach ($modalities as $key => $modality)
    <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $modality->name }}</td>
        <td>
            @can('manager')
                <a class="btn btn-primary" href="{{ route('modality.edit',$modality->id) }}">Editar</a>
            @endcan
            @can('manager')
                {!! Form::open(['method' => 'DELETE','route' => ['modality.destroy', $modality->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>
@else
    <div class="alert alert-warning alert-dismissible fade show pb-3">
        <p>Não existem Modalidades cadastradas</p>
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
        <script>MessageAlert('message');</script>
    @endif

    <script>deleteAlert('btn-danger')</script>
@endsection
