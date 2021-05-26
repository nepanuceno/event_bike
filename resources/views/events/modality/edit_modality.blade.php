@extends('adminlte::page')


@section('content')

{!! Form::model($modality, ['method' => 'PATCH','route' => ['modality.update', $modality->id]]) !!}

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Modalidade</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <form action="{{ url('modality.update',[1]) }}" method="PATCH" name="frm_modality" id="frm_modality">
                {!! csrf_field() !!}

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nome da Modalidade</label>
                        {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}

                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar Categoria</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('js')

@endsection
