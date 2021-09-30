@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            @if(!$user->hasRole('Manager') && !$user->hasRole('Administrator')) {{-- Not modifier Roles / não modifique --}}

                @if($user->profile)
                    <div class="card">
                        <div class="card-header">{{ __('home.dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('home.logged_in') }}
                        </div>
                    </div>
                @else
                <div class="callout callout-info">
                    <h5>{{ __('home.important_warning') }}</h5>

                    <p>{{ __('home.home_message_user') }}</p>
                    <a href="/user/profile">{{ __('home.my_profile') }}</a>
                </div>
                @endif
            @else
                @if($user->hasRole('Administrator'))
                        <h1> {{ __('home.administrative_area') }}</h1>
                @else
                    @if($user->hasRole('Manager'))
                        <h1> {{ __('home.manager_of_area') }}</h1>
                    @endif
                @endif

            @endif
        </div>
    </div>
</div>
@endsection
