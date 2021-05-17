@extends('adminlte::page')
@section('content')
<!-- Profile Image -->
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                src="/photos/{{ $profile->photo }}"
                alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{ $user->name }}</h3>

        <p class="text-muted text-center">{{ $user->email }}</p>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
            <b>Rg</b> <a class="float-right">{{ $profile->rg}}</a>
            </li>

            <li class="list-group-item">
            <b>Cpf</b> <a class="float-right">{{ $profile->cpf}}</a>
            </li>

            <li class="list-group-item">
            <b>Telefone</b> <a class="float-right">{{ $profile->phone}}</a>
            </li>

            <li class="list-group-item">
            <b>Telefone para emergência</b> <a class="float-right">{{ $profile->emergency_phone}}</a>
            </li>

            <li class="list-group-item">
            <b>Tipo sanguineo</b> <a class="float-right">{{ $profile->blood_type}}</a>
            </li>

            <li class="list-group-item">
            <b>Gênero</b> <a class="float-right">{{ $profile->gender}}</a>
            </li>

            <li class="list-group-item">
            <b>Alergias</b> <a class="float-right">{{ $profile->allergy}}</a>
            </li>
            <li class="list-group-item">
            <b>Problemas de Saúde</b> <a class="float-right">{{ $profile->health_problem }}</a>
            </li>
            <li class="list-group-item">
            <b>Medicação Controlada</b> <a class="float-right">{{ $profile->take_medication}}</a>
            </li>
        </ul>

        <a href="{{ url('/user/profile_edit') }}" class="btn btn-primary btn-block"><b>Alterar Informações</b></a>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
