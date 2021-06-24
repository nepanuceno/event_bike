@extends('adminlte::page')
@section('content')


@if(isset($tenants))
    <fieldset>

        <label for="">
            <h3>Meus Grupos</h3>
        </label>
        
        @foreach ($tenants as $tenant)
        <p><a href="{{ route('tenant.show', $tenant->id) }}">{{ $tenant->name }}</p>
        @endforeach
    </fieldset>
@else
<div class="alert alert-warning" role="alert"><h3>Usuário sem Grupo (Empresa, Organização, Associação etc.)</h3></div>

<div class="mb-5">Você deseja <a href="{{ route('tenant.create') }}"> Cadastar </a> um grupo ou <a href="#"> Particiapar </a> de um grupo ja existente?</div>
@endif

@if(isset($profile))
<!-- Profile Image -->
<div class="row">
    <div class="col-md-5">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                    src="/storage/photos/{{ $profile->photo }}"
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
    </div>
    <div class="col-md-5">
        <fieldset>
            <label for="">Endereços</label>

            @foreach ($addresses as $key=>$address)
            
                    
                    <div class="card bg-gradient-info">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                          <h3 class="card-title">
                            <i class="fas fa-address-card mr-1"></i>
                            Endereço {{ $key+1 }}
                          </h3>
          
                          <div class="card-tools">
                            <a href="{{ route('user_address.edit', $address->id)}}" class="btn bg-info btn-sm" >
                              <i class="fas fa-edit"></i>
                            </a>

                            <form style="display:inline" id="delete_address" action="{{ url('user_address', $address->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn bg-info btn-sm" type="submit"> <i class="fas fa-times"></i></button>
                            </form>
                            
                          </div>
                        </div>
                        <div class="card-body">
                            
                            {{ $address->address }} - {{ $address->number}} <br>
                            {{ $address->neighborhood }} <br> 
                            {{ $address->city}} - {{ $address->state }} - {{ $address->zip_code }}<br>
                            {{ $address->country }}
                        </div>
                    </div>
            @endforeach
        </fieldset>
    </div>
</div>
    @else
    <div class="alert alert-warning" role="alert"><h3>Usuário sem Informações complementares</h3></div>
    <a class="btn btn-link" href="profile_create">Cadastrar Informações Complementares</a>
@endif

@if(count($addresses) > 0)
@else
    <div class="alert alert-warning mt-5" role="alert"><h3>Usuário sem Endereço</h3></div>
    <a class="btn btn-link" href="{{ route('user_address.create') }}">Cadastrar endereço</a>
@endif

@if ($message = Session::get('success'))
    <span id="message" style="display: none">{{ $message }}</span>
@endif

@endsection


@section('js')
    <script src="{{ asset('js/sweetalert.js') }}"></script>

    @if ($message = Session::get('success'))
        <script>MessageAlert(['message','success']);</script>
    @endif

    @if ($message = Session::get('error'))
        <script>MessageAlert(['message','error']);</script>
    @endif
@endsection