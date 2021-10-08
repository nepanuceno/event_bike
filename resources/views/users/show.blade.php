@extends('adminlte::page')


@section('content')

<!-- <div class="card align-middle" style="width: 18rem;">
  <img class="card-img-top" src="{{ $user->adminlte_image() }}" alt="Card image cap" style="width: 250px;">
  <div class="card-body">
    <h5 class="card-title">{{ $user->name }}</h5>
    <p class="card-text">
        {{ $user->email }}
        <hr>
        <strong>Funções:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
    </p>
    <a class="btn btn-primary" href="{{ route('user.index') }}"> Voltar</a>
  </div>
</div> -->


<div class="row">
<div class="col-md-6">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2 shadow-sm">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-warning">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="{{ $user->adminlte_image() }}" alt="Foto do Usuário">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{ $user->name }}</h3>
                <h5 class="widget-user-desc">{{ $user->email }}</h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <!-- <span class="float-right badge bg-primary">31</span> -->
                    @if(!empty($user->getRoleNames()))
                    <h2>{{ __('users.roles') }}</h2>
                        @foreach($user->getRoleNames() as $v)
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <h5><span class="float-right badge bg-primary ml-1">{{ $v }}</span></h5>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->
</div>

@endsection
