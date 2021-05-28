@extends('adminlte::page')


@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Criar Evento</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" methos="POST" name="frm_event" id="frm_event">
                {!! csrf_field() !!}

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nome do Evento</label>
                        <input type="name" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="date">Data do Evento</label>
                        <input type="text" class="form-control" id="date" name="date">
                    </div>

                    <div class="form-group">
                        <label for="date_start_subscribe">Data de início das inscrições</label>
                        <input type="text" class="form-control" id="date_start_subscribe" name="date_start_subscribe">
                    </div>

                    <div class="form-group">
                        <label for="date_end_subscribe">Data do fim das Inscrições</label>
                        <input type="text" class="form-control" id="date_end_subscribe" name="date_end_subscribe">
                    </div>


                    <div class="form-group">
                        <label for="adress">Endereço do Evento</label>
                        <input type="text" class="form-control" id="adress" name="adress">
                    </div>

                    <div class="form-group">
                        <label for="modality ">Modalidade</label>
                        <select class="form-control select2" id="modality " name="modality">
                            @foreach($modalities as $modality)
                                <option></option>
                                <option value="{{ $modality->id }}">{{ $modality->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="categories">Categorias</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group clearfix">

                                    @foreach($categories as $category)
                                        <div class="icheck-success">
                                            <input type="checkbox" name="category[]" id="{{ $category->id }}">
                                            <label for="{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="logo">Logo do Evento</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" onchange="readURL(this);" class="custom-file-input" id="logo" name="logo">
                                <label class="custom-file-label" for="exampleInputFile">Escolher Arquivo</label>
                            </div>
                        </div>
                    </div>

                    <img class="float-right img-fluid img-thumbnail" src="#" id="img" alt="" style="display:none;">

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar Evento</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/preview.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Selecione uma opção',
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-orange',
            radioClass: 'iradio_square-orange',
            increaseArea: '20%' // optional
        });
    });
</script>
@endsection
