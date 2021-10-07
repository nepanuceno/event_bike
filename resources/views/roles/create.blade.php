@extends('adminlte::page')


@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>{{ __('roles.whoops') }}</strong> {{ __('roles.problem_with_data') }}<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<div class="col-md-8">
    <div class="card">
        <div class="card-header bg-dark">
            <h3>{{ __('roles.new_role') }}</h3>
        </div>

        <div class="row card-body">
            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
            <div class="form-group">
                <label for="name">{{ __('roles.name') }}</label>
                {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
            </div>


            <div class="form-group">
                <strong>{{ __('roles.permissions') }}:</strong>
                <br/>
                @foreach($permission as $value)
                    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                    {{ $value->name }}</label>
                <br/>
                @endforeach
            </div>
        </div>

        <div class="card-footer">
            <div class="clearfix">
                <button type="submit" class="btn btn-primary float-left"><i class="fas fa-save"></i> {{ __('roles.save_role') }}</button>
                <a href="{{ route('roles.index') }}" type="button" class="btn btn-secondary float-right text-white"><i class="fas fa-ban"></i> {{ __('roles.cancel') }}</a>
            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}

@endsection
