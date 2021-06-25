@extends('adminlte::page')


@section('content')

<fieldset>

    <label for="">Selecione um Grupo para continuar</label>

    <ul class="list-group">
    @foreach ($tenants as $tenant)
        <li class="btn btn-link list-group-item text-left"><a href="{{ route('setTenantId', $tenant->id)}}">{{ $tenant->name }}</a></li>
        
    @endforeach
    <li class="list-group-item list-group-item-action list-group-item-info text-center">
        Você deseja 
        <a href="{{ route('tenant.create') }}"> Cadastar </a> 
        um grupo ou 
        <a href="#" data-toggle="modal" data-target="#joinTenant">Solicitar Participação </a>
        em um grupo ja existente?
        </li>
    </ul>
</fieldset>

@endsection