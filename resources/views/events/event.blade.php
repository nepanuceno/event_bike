@extends('adminlte::page')


@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
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
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Criar Evento</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('event') }}" method="POST" name="frm_event" id="frm_event" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nome do Evento</label>
                        <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="date">Data do Evento</label>
                        <input type="text" class="form-control" id="date" name="date_event" value="{{ old('date_event') }}">
                    </div>

                    <div class="form-group">
                        <label for="start_date">Data de início das inscrições</label>
                        <input type="text" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                    </div>

                    <div class="form-group">
                        <label for="end_date">Data do fim das Inscrições</label>
                        <input type="text" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                    </div>


                    <div class="form-group">
                        <label for="adress">Endereço do Evento</label>
                        <input type="text" class="form-control" id="adress" name="adress" value="{{ old('adress') }}">
                    </div>

                    <div class="form-group">
                        <label for="modality_id ">Modalidade</label>
                        <select class="form-control select2" id="modality_id" name="modality_id">
                            @foreach($modalities as $modality)
                                <option></option>
                                <option value="{{ $modality->id }}" {{ $modality->id == old('modality')? 'selected':'' }}>{{ $modality->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category ">Categoria</label>
                        <select class="form-control select2" id="category" name="category[]" multiple>
                            @foreach($categories as $category)

                                <option></option>
                                <option value="{{ $category->id }}" {{ (is_array(old('category')) && in_array($category->id, old('category'))) ? ' selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="logo">Logo do Evento</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" onchange="readURL(this);" class="custom-file-input" id="logo" name="logo" value="{{ old('logo') }}">
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
