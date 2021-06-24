@extends('adminlte::page')


@section('content')

<fieldset>

    <label for="">Selecione um Grupo para continuar</label>

    <ul class="list-group">
    @foreach ($tenants as $tenant)
        <li class="list-group-item"><a href="{{ route('setTenantId', $tenant->id)}}">{{ $tenant->name }}</a></li>
        
        @endforeach
    </ul>
</fieldset>

@endsection