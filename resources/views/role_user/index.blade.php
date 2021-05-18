@extends('adminlte::page')


@section('content')

    <form action="" method="post">
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

    <button class="btn btn-primary" type="submit">Atribuir</button>

    </form>



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
    });

</script>
@endsection
