@extends('adminlte::page')


@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success pb-3">
            <p>{{ $message }}</p>
        </div>
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
            <h5 class="card-header bg-dark">Funções por usuário</h5>
            <div class="card-body">
                <form action="{{ route('role_user.store') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Ususário</label>
                                <select class="select2bs4 select_input_users" id="user" name="user" data-placeholder="Pesquise por um usuário" style="width: 100%;">
                                <option value="null">Pesquise por um usuário</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Funções para atribuir ao Usuário</label>
                                <select class="select2 select_input_roles" multiple="multiple" name="roles" id="roles" data-placeholder="Selecione as funções" style="width: 100%;">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-secondary" type="submit">Atribuir Função</button>

                </form>
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
            console.log('select event');
        });

    });

</script>
@endsection
