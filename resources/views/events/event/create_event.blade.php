@extends('adminlte::page')


@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>{{ __('events.error_expression') }}</strong> {{ __('events.data_error') }}<br><br>
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
                <h3 class="card-title">{{ __('events.create_an_event') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('event') }}" method="POST" name="frm_event" id="frm_event" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('events.event_name') }}</label>
                        <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">{{ __('events.event_description') }}</label>
                        <textarea  class="form-control" name="description" id="description" cols="30" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="date">{{ __('events.event_date') }}</label>
                        <div class="form-group">
                            <div class="input-group date datetimepicker" id="date_event" data-target-input="nearest">
                                <input name="date_event" value="{{ old('date_event') }}" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#date_event"/>
                                <div class="input-group-append" data-target="#date_event" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_date">{{ __('events.registration_start_date') }}</label>
                        <div class="form-group">
                            <div class="input-group date datetimepicker" id="start_date" data-target-input="nearest">
                                <input name="start_date" value="{{ old('start_date') }}" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#start_date"/>
                                <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="end_date">{{ __('events.enrollment_end_date') }}</label>
                        <div class="form-group">
                            <div class="input-group date datetimepicker" id="end_date" data-target-input="nearest">
                                <input name="end_date" value="{{ old('end_date') }}" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#end_date"/>
                                <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="adress">{{ __('events.event_address') }}</label>
                        <input type="text" class="form-control" id="adress" name="adress" value="{{ old('adress') }}">
                    </div>

                    <div class="form-group">
                        <label for="modality_id ">{{ __('events.modality') }}</label>
                        <select class="form-control select2" id="modality_id" name="modality_id">
                            @foreach($modalities as $modality)
                                <option></option>
                                <option value="{{ $modality->id }}" {{ $modality->id == old('modality_id')? 'selected':'' }}>{{ $modality->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category ">{{ __('events.category') }}</label>
                        <select class="form-control select2" id="category" name="category[]" multiple>
                            @foreach($categories as $category)

                                <option></option>
                                <option value="{{ $category->id }}" {{ (is_array(old('category')) && in_array($category->id, old('category'))) ? ' selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="event_notice">{{ __('events.event_notice') }}</label>
                        <div class="input-group">
                            <div class="custom-file col-md-7">
                                <input type="file" onchange="readURL(this,'#pdf');" class="custom-file-input" id="event_notice" name="event_notice" value="{{ old('event_notice') }}">
                                <label class="custom-file-label" for="event_notice">{{ __('events.choose_file') }}</label>
                            </div>
                            <div class="col-md-5 mt-2">
                                <embed class="float-right img-fluid img-thumbnail" id="pdf" src="" type="application/pdf" width="100%" height="100%" style="display:none;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="logo">{{ __('events.event_logo') }}</label>
                        <div class="input-group">
                            <div class="custom-file col-md-7">
                                <input type="file" onchange="readURL(this, '#img');" class="custom-file-input" id="logo" name="logo" value="{{ old('logo') }}">
                                <label class="custom-file-label" for="logo">{{ __('events.choose_image') }}</label>
                            </div>
                            <div class="col-md-5">
                                <img class="float-right img-fluid img-thumbnail" src="#" id="img" alt="" style="display:none;">
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ __('events.event_save_button') }}</button>
                  <a class="btn btn-default float-right" href="{{ url('event') }}">{{ __('events.back_page') }}</a>
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
                placeholder: '{{ __('events.select_an_option') }}',
                allowClear: true
            });
        });
    </script>
{{--
    <script>
        $(document).ready(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-orange',
                radioClass: 'iradio_square-orange',
                increaseArea: '20%' // optional
            });
        });
    </script> --}}

    <script>
        //Datemask dd/mm/yyyy
        // $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    </script>
@endsection
