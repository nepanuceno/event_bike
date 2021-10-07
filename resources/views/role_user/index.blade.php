@extends('adminlte::page')


@section('content')

    @if ($message = Session::get('success'))
        <p id="message" style="display: none;">{{ $message }}</p>
    @endif

    @if (count($errors) > 0)

        <div class="alert alert-danger">
            <strong>{{ __('roles_user.whoops') }}!</strong> {{ __('roles_user.problem_with_data') }}.<br><br>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>

    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
            <h5 class="card-header bg-dark">{{ __('roles_user.profiles_assing_user') }}</h5>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('role_user.store') }}" method="post">
                            {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('roles_user.user') }}</label>
                                            <select class="select2bs4 select_input_users" id="user" name="user" data-placeholder="{{ __('roles_user.search_user') }}" style="width: 100%;">
                                            <option value="null">{{ __('roles_user.search_user') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('roles_user.profiles_assing_user') }}</label>
                                            <select class="select2 select_input_roles" multiple name="roles[]" id="roles" data-placeholder="{{ __('roles_user.select_profiles') }}" style="width: 100%;">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <hr>
                            <button class="btn btn-secondary" type="submit"><i class="fas fa-sitemap"></i> {{ __('roles_user.associate_profile') }}</button>

                        </form>
                    </div>
                    <div class="col-md-4 roles border-left shadow-sm p-3 mb-5 bg-white rounded"></div>
                </div>
            </div>
        </div>

        </div>

    </div>

    <span id='are_you_sure' style="display: none">{{ __('roles_user.are_you_sure') }}</span>
    <span id='after_positive' style="display: none">{{ __('roles_user.after_positive') }}</span>
    <span id='confirmation_unlink' style="display: none">{{ __('roles_user.confirmation_unlink') }}</span>
    <span id='unlinked' style="display: none">{{ __('roles_user.unlinked') }}</span>
    <span id='user_unlinked' style="display: none">{{ __('roles_user.user_unlinked') }}</span>
    <span id='error_unlinked' style="display: none">{{ __('roles_user.error_unlinked') }}</span>
    <span id='user_not_unlinked' style="display: none">{{ __('roles_user.user_not_unlinked') }}</span>
    <span id='cancel' style="display: none">{{ __('roles_user.cancel') }}</span>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.select_input_roles').select2();

        $('.select_input_users').select2({
            placeholder: 'Selecione um usuário',
            ajax: {
                url: '/search_user',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },

                cache: true
            }
        });

       // Bind an event
        $('.select_input_users').on('select2:select', function (e) {
            var user = $('.select_input_users').val();

            $(".roles").html('');

            $.ajax({
                url: "/roles_user/"+user,
                dataType: 'json',
                success: function(result){

                    var are_you_sure = document.querySelector('#are_you_sure').textContent;
                    var after_positive = document.querySelector('#after_positive').textContent;
                    var confirmation_unlink = document.querySelector('#confirmation_unlink').textContent;
                    var unlinked = document.querySelector('#unlinked').textContent;
                    var user_unlinked = document.querySelector('#user_unlinked').textContent;
                    var error_unlinked = document.querySelector('#error_unlinked').textContent;
                    var user_not_unlinked = document.querySelector('#user_not_unlinked').textContent;
                    var cancel = document.querySelector('#cancel').textContent;

                    $.each(result, function(key, value) {

                        let data = `${user},
                            '${value}',
                            '${are_you_sure}',
                            '${after_positive}',
                            '${confirmation_unlink}',
                            '${unlinked}',
                            '${user_unlinked}',
                            '${error_unlinked}',
                            '${user_not_unlinked}',
                            '${cancel}'`;

                        // console.log(data)
                        $button = "<h5><button onclick=\"confirmeUrlExcludeRoleUserAlert(this, ["+data+"])\" type=\"button\" class=\"btn btn-info text-white btn-sm\">"+value+"<span class=\"fas fa-trash text-white pl-2\"></span></button></h5>";
                        // console.log($button)
                        $(".roles").append($button);
                    });
                }
            });
        });
    });

</script>

<script src="js/sweetalert.js"></script>
@if ($message = Session::get('success'))
    <script>MessageAlert(['message','success']);</script>
@endif

@if ($message = Session::get('error'))
    <script>MessageAlert(['message','error']);</script>
@endif

@endsection
