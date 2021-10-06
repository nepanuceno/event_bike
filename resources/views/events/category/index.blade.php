@extends('adminlte::page')

@section('content')

<div class="row pb-3">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
        @can('manager')
            <a class="btn btn-success" href="{{ route('category.create') }}"> {{ __('category.create_new_category') }}</a>
        @endcan
        </div>
    </div>
</div>
@empty($categories)
    <div class="alert alert-warning alert-dismissible fade show pb-3">
        <p>{{ __('category.no_categories_registered') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@else
    <div class="card">
        <div class="card-header bg-dark">
            <h3 class="card-title">{{ __('category.category_management') }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="25px">{{ __('category.id') }}</th>
                    <th>{{ __('category.name') }}</th>
                    <th width="168px">{{ __('category.action') }}</th>
                </tr>
                @foreach ($categories as $key => $category)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @can('manager')
                            <a class="btn btn-primary" href="{{ route('category.edit',$category->id) }}">{{ __('category.edit') }}</a>

                            {!! Form::open(['method' => 'DELETE','route' => ['category.destroy', $category->id],'style'=>'display:inline']) !!}
                                {!! Form::submit(__('category.delete'), ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endempty


@if ($message = Session::get('success'))
    <span id="message" style="display: none">{{ $message }}</span>
@endif

@endsection

@section('js')
    <script src="/js/sweetalert.js"></script>
    @if ($message = Session::get('success'))
    <script>MessageAlert(['message','success']);</script>
    @endif

    @if ($message = Session::get('error'))
        <script>MessageAlert(['message','error']);</script>
    @endif

    <script>deleteAlert('btn-danger')</script>
@endsection
