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

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">{{ __('modalities.create_modality') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('modality') }}" method="POST" name="frm_modality" id="frm_modality">
                {!! csrf_field() !!}

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('modalities.modality_name') }}</label>
                        <input type="name" class="form-control" id="name" name="name">
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
<script src="/js/sweetalert.js"></script>
@if ($message = Session::get('success'))
<script>MessageAlert(['message','success']);</script>
@endif

@if ($message = Session::get('error'))
    <script>MessageAlert(['message','error']);</script>
@endif
@endsection
