@extends('adminlte::page')


@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Criar Categoria</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="POST" name="frm_category" id="frm_category">
                {!! csrf_field() !!}

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nome da Categoria</label>
                        <input type="name" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar Evento</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('js')

@endsection
