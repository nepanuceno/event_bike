@extends('adminlte::page')


@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Usuários</h2>
        </div>

        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('user.create') }}"> Criar novo Usuário</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))

    <p id="message" style="display: none;">{{ $message }}</p>

    <!-- <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div> -->

@endif


<table class="table table-bordered">

 <tr>

   <th>No</th>

   <th>Name</th>

   <th>Email</th>

   <th>Roles</th>

   <th width="280px">Action</th>

 </tr>

 @foreach ($data as $key => $user)

  <tr>

    <td>{{ ++$i }}</td>

    <td>{{ $user->name }}</td>

    <td>{{ $user->email }}</td>

    <td>

      @if(!empty($user->getRoleNames()))

        @foreach($user->getRoleNames() as $v)

           <label class="badge badge-success">{{ $v }}</label>

        @endforeach

      @endif

    </td>

    <td>
       <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Ver</a>
       <!-- <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a> -->
        {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>

 @endforeach

</table>


{!! $data->render() !!}


@endsection

@section('js')
    <script>
        $('.btn-danger').click(function(event){
            event.preventDefault(); //nao deixa o botao fazer o submit
            Swal.fire({
                title: 'Tem certeza disso?',
                text: "Esta ação não poderá ser revertida",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.value) {
                    this.parentNode.submit(); //submit do pai(form) do botao acionado
                } else {
                    console.log('Error', result)
                }
            });

        });
    </script>

    @if ($message = Session::get('success'))
        <script>
            let message = document.querySelector('#message').textContent;
            Swal.fire(
                'Excluído!',
                message,
                'success'
            )
        </script>
    @endif
@endsection
