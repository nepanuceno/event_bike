@extends('adminlte::page')
@section('content')

@can('manager')
    @if(isset($tenants) && count($tenants) > 0)
       
            
    <!-- Modal -->
    <div class="modal fade" id="joinTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="joinTenantCenterTitle">Participar de um grupo existente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('joingroup') }}" method="post">
                    <div class="modal-body">
                        @if(count($all_tenants) > 0)
                            @csrf
                            <select name="all_tenants" id="all_tenants">
                                @foreach ($all_tenants as  $tenant)
                                <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                @endforeach
                            </select>
                            @else
                            Você já está participando de todos os grupos possíveis.
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        @if(count($all_tenants) > 0)
                            <button type="submit" class="btn btn-primary">Participar</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Meus Grupos</h3>
                    <div class="card-tools">
                        <a href="{{ route('tenant.create') }}" class="btn btn-tool"><i class="fas fa-plus"></i> Novo Grupo</a>
                        <a href="#" class="btn btn-tool" data-toggle="modal" data-target="#joinTenant"><i class="fas fa-object-group" ></i> Entrar em um Grupo</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-caret-down fa-2x"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: none;">
                    @foreach ($tenants as $tenant)
                    <p>
                        <a href="{{ route('tenant.show', $tenant->id) }}">{{ $tenant->name }}</a>
                        <a  class="btn btn-info btn-sm" href="{{ route('tenant.edit', $tenant->id) }}"><i class="fas fa-edit"></i></a>
                    </p>
                    @endforeach
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    @else
        <div class="alert alert-warning" role="alert"><h3>Usuário sem Grupo (Empresa, Organização, Associação etc.)</h3></div>
        <div class="mb-5">Você deseja <a href="{{ route('tenant.create') }}"> Cadastar </a> um grupo ou <a href="#"> Particiapar </a> de um grupo ja existente?</div>
    @endif
@endcan

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