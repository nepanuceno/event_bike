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
                                {{-- {!! Form::submit(__('category.delete'), ['class' => 'btn btn-danger']) !!} --}}
                                <a href='#' class="btn btn-danger">{{ __('category.delete') }}</a>
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
    <span id="msg_status" style="display: none">{{ __('category.success') }}</span>
@endif

@if ($message = Session::get('error'))
    <span id="message" style="display: none">{{ $message }}</span>
    <span id="msg_status" style="display: none">{{ __('category.error') }}</span>
@endif

<span id="title" style="display: none">{{ __('category.ara_you_sure') }}?</span>
<span id="text" style="display: none">{{ __('category.alert_not_reversed') }}</span>
<span id="text_button" style="display: none">{{ __('category.confirm_delete') }}</span>
@endsection

@section('js')
    <script src="/js/sweetalert.js"></script>
    @if ($message = Session::get('success'))
        <script>
            let msg_status = document.querySelector('#msg_status').textContent;
            MessageAlert(['message','success', msg_status]);
        </script>
    @endif

    @if ($message = Session::get('error'))
        <script>
            let msg_status = document.querySelector('#msg_status').textContent;
            MessageAlert(['message','error', msg_status]);
        </script>
    @endif

    <script>
        let title = document.querySelector('#title').textContent;
        let text = document.querySelector('#text').textContent;
        let text_button = document.querySelector('#text_button').textContent;

        deleteAlert(['btn-danger',title, text, 'warning', text_button])
    </script>

@endsection
