@extends('adminlte::page')

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>{{ __('permissions.whoops') }}!</strong> {{ __('permissions.problem_with_data') }}.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{!! Form::model($permission, ['method' => 'PATCH','route' => ['permissions.update', $permission->id]]) !!}

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3>{{ __('permissions.edit_permission') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <strong>{{ __('permissions.name') }}:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="clearfix">
                    <button type="submit" class="btn btn-secondary float-left"><i class="fas fa-save"></i> {{ __('permissions.save_permission') }}</button>
                    <a href="{{ route('permissions.index') }}" type="button" class="btn btn-secondary float-right text-white"><i class="fas fa-ban"></i> {{ __('permissions.cancel') }}</a>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

{!! Form::close() !!}


@endsection
