@extends('adminlte::page')


@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>{{ __('modalities.whoops') }}!</strong> {{ __('modalities.problem_with_data') }}.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="salert"><span class="fas fa-close"></span></button>
            <strong>{{ $message }}</strong>
    </div>
@endif

{!! Form::model($modality, ['method' => 'PATCH','route' => ['modality.update', $modality->id]]) !!}

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ __('modalities.edit_modality') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <form action="{{ url('modality.update',$modality->id) }}" method="PATCH" name="frm_modality" id="frm_modality">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('modalities.modality_name') }}</label>
                        {!! Form::text('name', null, array('placeholder' => __('modalities.name'),'class' => 'form-control')) !!}

                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-footer">
                        <div class="clearfix">
                            <button type="submit" class="btn btn-secondary float-left">{{ __('modalities.save_modality') }}</button>
                            <a href="{{ route('modality.index') }}" type="button" class="btn btn-secondary float-right text-white">{{ __('modalities.cancel') }}</a>
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
