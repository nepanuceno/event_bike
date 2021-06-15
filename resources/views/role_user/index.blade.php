@extends('adminlte::page')


@section('content')


    @if ($message = Session::get('success'))
        <p id="message" style="display: none;">{{ $message }}</p>
    @endif

    @if (count($errors) > 0)

        <div class="alert alert-danger">
            <strong>Whoops!</strong> Houve problemas nas suas entradas de dados.<br><br>
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
            <h5 class="card-header bg-dark">Perfis por usuário</h5>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('role_user.store') }}" method="post">
                            {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Ususário</label>
                                            <select class="select2bs4 select_input_users" id="user" name="user" data-placeholder="Pesquise por um usuário" style="width: 100%;">
                                            <option value="null">Pesquise por um usuário</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Perfis para atribuir ao Usuário</label>
                                            <select class="select2 select_input_roles" multiple name="roles[]" id="roles" data-placeholder="Selecione as funções" style="width: 100%;">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <hr>
                            <button class="btn btn-secondary" type="submit">Assossiar Perfil</button>

                        </form>
                    </div>
                    <div class="col-md-4 roles border-left shadow-sm p-3 mb-5 bg-white rounded"></div>
                </div>
            </div>
        </div>

        </div>

    </div>
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

                    $.each(result, function(key, value) {
                        $(".roles").append("<h5><button onclick=\"confirmeUrlExcludeRoleUserAlert([this, '"+user+"','"+value+"'])\" type=\"button\" class=\"btn btn-info text-white btn-sm\">"+value+"<span class=\"fas fa-trash text-white pl-2\"></span></button></h5>");
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
