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
                <h3 class="card-title">Editar Evento</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('event',$event->id) }}" method="POST" name="frm_event" id="frm_event" enctype="multipart/form-data">
                {!! csrf_field() !!}
                {{ method_field('PUT') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nome do Evento</label>
                        <input type="name" class="form-control" id="name" name="name" value="{{ $event->name }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição do Evento</label>
                        <textarea  class="form-control" name="description" id="description" cols="30" rows="4">{{ $event->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="date">Data do Evento</label>
                        <div class="form-group">
                            <div class="input-group date datetimepicker" id="date_event" data-target-input="nearest">
                                <input name="date_event" value="{{$event->date_event }}" type="text" class="form-control datetimepicker-input" data-target="#date_event"/>
                                <div class="input-group-append" data-target="#date_event" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_date">Data de início das inscrições</label>
                        <div class="form-group">
                            <div class="input-group date datetimepicker" id="start_date" data-target-input="nearest">
                                <input name="start_date" value="{{ $event->start_date }}" type="text" class="form-control datetimepicker-input" data-target="#start_date"/>
                                <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="end_date">Data do fim das Inscrições</label>
                        <div class="form-group">
                            <div class="input-group date datetimepicker" id="end_date" data-target-input="nearest">
                                <input name="end_date" value="{{ $event->end_date }}" type="text" class="form-control datetimepicker-input" data-target="#end_date"/>
                                <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="adress">Endereço do Evento</label>
                        <input type="text" class="form-control" id="adress" name="adress" value="{{$event->adress }}">
                    </div>

                    <div class="form-group">
                        <label for="modality_id ">Modalidade</label>
                        <select class="form-control select2" id="modality_id" name="modality_id">
                            @foreach($modalities as $modality)
                                <option></option>
                                <option value="{{ $modality->id }}" {{ $modality->id == $event->modality_id ? 'selected':'' }}>{{ $modality->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category ">Categoria</label>
                        <select class="form-control select2" id="category" name="category[]" multiple>
                            @foreach($categories as $category)

                                <option></option>
                                <option value="{{ $category->id }}" {{ $event->categories->contains($category) ? ' selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class=" row form-group shadow p-3">
                        <label for="logo">Edital do Evento</label>
                        <div class="input-group">
                            <div class="custom-file col-md-7">
                                <input type="file" onchange="readURL(this);" class="custom-file-input" id="event_notice" name="event_notice" value="{{ $event->event_notice }}">
                                <label class="custom-file-label" for="event_notice">Escolher Arquivo</label>
                            </div>
                            <div class="col-md-5">
                                <embed src="/storage/event_notices/{{ $event->event_notice }}" type="application/pdf" width="100%" height="100%">
                            </div>
                        </div>
                    </div>

                    <div class="row form-group shadow p-3">
                        <label for="logo">Logo do Evento</label>
                        <div class="input-group">
                            <div class="custom-file col-md-7">
                                <input type="file" onchange="readURL(this);" class="custom-file-input" id="logo" name="logo">
                                <label class="custom-file-label" for="exampleInputFile">Escolher Arquivo</label>
                            </div>
                            <div class="col-md-5">
                                @if(isset($event->logo))
                                    <img class="float-right img-fluid img-thumbnail" src="/storage/logo_events/{{ $event->logo }}" id="img">
                                @else
                                    <img class="float-right img-fluid img-thumbnail" src="#" id="img" alt="" style="display:none;">
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-left">Salvar Evento</button>
                  <a class="btn btn-default float-right" href="{{ url()->previous() }}">Cancelar</a>

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@if ($message = Session::get('success'))
    <span id="message" style="display: none">{{ $message }}</span>
@endif

@endsection

@section('js')
    <script src="{{ asset('js/dateTimeConfig.js') }}"></script>

    <script src="{{ asset('js/sweetalert.js') }}"></script>

    @if ($message = Session::get('success'))
        <script>MessageAlert(['message','success']);</script>
    @endif

    @if ($message = Session::get('error'))
        <script>MessageAlert(['message','error']);</script>
    @endif

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
