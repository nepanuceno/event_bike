@extends('adminlte::page')


@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Houve algum problema na sua enrada de dados.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert"><span class="fas fa-close"></span></button>
            <strong>{{ $message }}</strong>
    </div>
@endif

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Criar Modalidade</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('modality') }}" method="POST" name="frm_modality" id="frm_modality">
                {!! csrf_field() !!}

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nome da Modalidade</label>
                        <input type="name" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-footer">
                        <div class="clearfix">
                            <button type="submit" class="btn btn-secondary float-left">Salvar Modalidade</button>
                            <a href="{{ route('modality.index') }}" type="button" class="btn btn-secondary float-right text-white">Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('js')

@endsection
