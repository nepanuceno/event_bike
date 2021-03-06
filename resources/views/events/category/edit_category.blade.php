@extends('adminlte::page')


@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>{{ __('category.whoops') }}!</strong> {{ __('category.problem_with_data') }}.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert"><span class="fas fa-close"></span></button>
            <strong>{{ $message }}</strong>
    </div>
@endif

{!! Form::model($category, ['method' => 'PATCH','route' => ['category.update', $category->id]]) !!}

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">{{ __('category.edit_category') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <form action="{{ url('category.update',$category->id) }}" method="PATCH" name="frm_category" id="frm_category">
                {!! csrf_field() !!}
                @method('PATCH')

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('category.category_name') }}</label>
                        {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}

                    </div>
                </div>
                    <div class="card-footer">
                        <div class="clearfix">
                            <button type="submit" class="btn btn-primary float-left">{{ __('category.save_category') }}</button>
                            <a href="{{ route('category.index') }}" type="button" class="btn btn-secondary float-right text-white">Cancelar</a>
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
