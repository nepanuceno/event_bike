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

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Criar Categoria</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('category') }}" method="POST" name="frm_category" id="frm_category">
                {!! csrf_field() !!}

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nome da Categoria</label>
                        <input type="name" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="clearfix">
                        <button type="submit" class="btn btn-secondary float-left">Salvar Categoria</button>
                        <a href="{{ route('category.index') }}" type="button" class="btn btn-secondary float-right text-white">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('js')

<script src="/js/sweetalert.js"></script>
@if ($message = Session::get('success'))
<script>MessageAlert(['message','success']);</script>
@endif

@if ($message = Session::get('error'))
    <script>MessageAlert(['message','error']);</script>
@endif

@endsection
