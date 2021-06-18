@extends('adminlte::page')


@section('content')

{{-- <div class="row">

    <div class="col-lg-12 margin-tb">
        <div class="pull-right mt-5 mb-3">
            <a class="btn btn-success" href="{{ route('user.create') }}"><span class="fas fa-plus"></span> Criar novo Usuário</a>
        </div>
    </div>
</div> --}}


@if ($message = Session::get('success'))

    <p id="message" style="display: none;">{{ $message }}</p>

    <!-- <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div> -->

@endif

<div class="card card-primary">
    <div class="card-header">
      <h2 class="card-title">Gerenciamento de Usuários</h2>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
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
             <a class="btn btn-info" href="{{ route('user.show',$user->id) }}"><span class="fas fa-eye"></span> Detalhes</a>
             <!-- <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a> -->
              {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
          </td>
        </tr>

       @endforeach

      </table>


      {!! $data->render() !!}
    </div>
    <!-- /.card-body -->
  </div>




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
