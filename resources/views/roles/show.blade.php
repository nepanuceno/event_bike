@extends('adminlte::page')


@section('content')

<div class="card">
  <div class="card-header bg-dark">
    <h3>{{ $role->name }}</h3>
  </div>
  <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item"><h4>{{ __('roles.permissions') }}</h4></li>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <li class="list-group-item">{{ $v->name }}</li>
                @endforeach
            @endif
        </ul>
  </div>

  <div class="card-footer text-muted">
        <a class="btn btn-secondary" href="{{ route('roles.index') }}"> {{ __('roles.back_button') }}</a>
  </div>
</div>

@endsection
