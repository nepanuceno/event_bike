@extends('adminlte::page')

@section('content')


<div class="row pb-3">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
        @can('manager')
            <a class="btn btn-success" href="{{ route('modality.create') }}"> {{ __('modalities.create_new_modality') }}</a>
        @endcan
        </div>
    </div>
</div>

@empty($modalities)
    <div class="alert alert-warning alert-dismissible fade show pb-3">
        <p>{{ __('modalities.no_modalities_registered') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@else
    <div class="card">
        <h5 class="card-header bg-dark">{{ __('modalities.modality_management') }}</h5>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="25px">{{ __('modalities.id') }}</th>
                    <th>{{ __('modalities.name') }}</th>
                    <th width="168px">{{ __('modalities.action') }}</th>
                </tr>
                    @foreach ($modalities as $key => $modality)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $modality->name }}</td>
                        <td>
                            @can('manager')
                                <a class="btn btn-primary" href="{{ route('modality.edit',$modality->id) }}">{{ __('modalities.edit') }}</a>
                            @endcan
                            @can('manager')
                                {!! Form::open(['method' => 'DELETE','route' => ['modality.destroy', $modality->id],'style'=>'display:inline']) !!}
                                    {{-- {!! Form::submit( __('modalities.delete') , ['class' => 'btn btn-danger']) !!} --}}
                                    <a href='#' class="btn btn-danger">{{ __('modalities.delete') }}</a>
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
    <span id="msg_status" style="display: none">{{ __('modalities.success') }}</span>
@endif

@if ($message = Session::get('error'))
    <span id="message" style="display: none">{{ $message }}</span>
    <span id="msg_status" style="display: none">{{ __('modalities.error') }}</span>
@endif

<span id="title" style="display: none">{{ __('modalities.ara_you_sure') }}?</span>
<span id="text" style="display: none">{{ __('modalities.alert_not_reversed') }}</span>
<span id="text_button" style="display: none">{{ __('modalities.confirm_delete') }}</span>
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
