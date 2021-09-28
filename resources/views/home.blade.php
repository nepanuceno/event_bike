@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            @if(!$user->hasRole('Manager') && !$user->hasRole('Administrator')) {{-- Not modifier Roles / não modifique --}}

                @if($user->profile)
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                @else
                <div class="callout callout-info">
                    <h5>Aviso Importante!</h5>

                    <p>Para continuar a utilizar o programa você deverá preencher as suas informações complementares e endereços.</p>
                    <a href="/user/profile">Meu Perfil</a>
                </div>
                @endif
            @else
                @if($user->hasRole('Administrator'))
                        <h1> Área Administrativa</h1>
                @else
                    @if($user->hasRole('Manager'))
                        <h1> Área do Gerente</h1>
                    @endif
                @endif

            @endif
        </div>
    </div>
</div>
@endsection
