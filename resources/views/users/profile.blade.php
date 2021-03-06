@extends('adminlte::page')
@section('content')

@can('manager')
    <!-- Modal -->
    <div class="modal fade" id="joinTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="joinTenantCenterTitle">{{ __('profile.join_exist_group') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('create.notify.joingroup') }}" method="post">
                    <div class="modal-body">
                        @if(count($all_tenants) > 0)
                            @csrf
                            <select name="all_tenants" id="all_tenants">
                                @foreach ($all_tenants as  $tenant)
                                <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                @endforeach
                            </select>
                            @else
                            {{ __('profile.alert_participating') }}
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('profile.close') }}</button>
                        @if(count($all_tenants) > 0)
                            <button type="submit" class="btn btn-primary">{{ __('profile.participate') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(isset($tenants) && count($tenants) > 0)

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card card-primary collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('profile.my_groups') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('tenant.create') }}" class="btn btn-tool"><i class="fas fa-plus"></i>  {{ __('profile.new_group') }}</a>
                        <a href="#" class="btn btn-tool" data-toggle="modal" data-target="#joinTenant"><i class="fas fa-object-group" ></i> {{ __('profile.join_a_group') }}</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-caret-down fa-2x"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: none;">
                    <ul class="list-group list-group-flush">
                    @foreach ($tenants as $tenant)
                        <a href="{{ route('tenant.show', $tenant->id) }}" class="list-group-item list-group-item-action">{{ $tenant->name }}</a>
                        <a  class="btn btn-info btn-sm float-left" href="{{ route('tenant.edit', $tenant->id) }}"><i class="fas fa-edit"></i></a>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    @else
        @cannot('administrator')
            <div class="alert alert-warning" role="alert">
                <h3>{{ __('profile.user_without') }}</h3>
            </div>
            <div class="mb-5">
                {{ __('profile.you_wish') }}
                <a href="{{ route('tenant.create') }}"> {{ __('profile.register') }} </a>
                {{ __('profile.a_group') }}
                <a href="#" data-toggle="modal" data-target="#joinTenant">{{ __('profile.participate') }} </a>
                {{ __('profile.existing_group')}}
            </div>
        @endcannot
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
                        <b>Telefone para emerg??ncia</b> <a class="float-right">{{ $profile->emergency_phone}}</a>
                    </li>

                    <li class="list-group-item">
                        <b>Tipo sanguineo</b> <a class="float-right">{{ $profile->blood_type}}</a>
                    </li>

                    <li class="list-group-item">
                        <b>G??nero</b> <a class="float-right">{{ $profile->gender}}</a>
                    </li>

                    <li class="list-group-item">
                        <b>Alergias</b> <a class="float-right">{{ $profile->allergy}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Problemas de Sa??de</b> <a class="float-right">{{ $profile->health_problem }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Medica????o Controlada</b> <a class="float-right">{{ $profile->take_medication}}</a>
                    </li>
                </ul>

                <a href="{{ url('/user/profile_edit') }}" class="btn btn-primary btn-block"><b>{{ __('profile.change_information') }}</b></a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
    @else
    <div class="alert alert-warning" role="alert"><h3>{{ __('profile.user_without_additional_information') }}</h3></div>
    <a class="btn btn-link" href="profile_create">{{ __('profile.register_complementary_information')  }}</a>
@endif

@if(count($addresses) > 0)
<div class="col-md-5">
    <fieldset>
        <label for="">{{ __('profile.addresses')}}</label>
        <nav class="navbar navbar-expand navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('user_address.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i>{{ __('profile.register_address') }}</a>
              </li>
            </ul>
        </nav>
        @foreach ($addresses as $key=>$address)
                <div class="card bg-gradient-info">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                      <h3 class="card-title">
                        <i class="fas fa-address-card mr-1"></i>
                        {{ __('profile.address') }} {{ $key+1 }}
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
@else
    <div class="alert alert-warning mt-5" role="alert"><h3>{{ __('profile.user_without_address') }}</h3></div>
    <a class="btn btn-link" href="{{ route('user_address.create') }}">{{ __('profile.register_address') }}</a>
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
