@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($profile)
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
        </div>
    </div>
</div>
@endsection
