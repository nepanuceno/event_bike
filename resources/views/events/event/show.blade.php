@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}")>
<script src="{{ asset('css/ekko-lightbox.css') }}"></script>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-6 col-lg-5 col-xl-4">
            <div class="card">
                <img class="card-img-top p-2" src="/storage/logo_events/{{ $event->logo }}" alt="Logo do Evento">
                <div class="card-body">
                    <h2>{{ $event->name }}</h2>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Data do Evento: </strong>{{ $event->date_event }}</li>
                    <li class="list-group-item"><strong>Modalidade: </strong>{{ $event->modality->name }}</li>
                </ul>
                <div class="card-body">
                    <div class="bg-white clearfix">
                        @can('manager')
                            <a class="btn btn-success float-left mr-1 text-white" href="{{ route('event.edit',$event->id) }}">Editar</a>

                            {!! Form::open(['method' => 'DELETE','route' => ['event.destroy', $event->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Desativar', ['class' => 'btn btn-danger float-left']) !!}
                            {!! Form::close() !!}
                        @endcan
                        <a class="btn btn-default float-right" href="{{ url()->previous() }}">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-7 col-xl-8">

            <div class="card">
                <h5 class="card-header bg-dark">Valores por Categoria</h5>
                <div class="card-body col-md-4">
                    <form action="{{ url('event/add_costs') }}" method="post" class="mb-3">
                        @csrf
                        <input type="hidden" id="event" name="event_id" value="{{ $event->id }}">
                        @foreach ($event->categories as $category)
                            <label for="{{ $category->id }}">Valor de {{ $category->name }}</label>
                            <input type="text" id={{ $category->id }} name={{ $category->id }} value="{{ $category->pivot->cost }}">
                        @endforeach
                        <hr>
                        <button class="btn btn-primary" type="submit">Alterar</button>
                    </form>
                </div>
            </div>

            <div class="card border">
                <div class="card-body">
                    <div class="card-header bg-dark">
                        <h3 class="card-title">Upload de Imagens</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('event.upload', $event->id) }}" class="dropzone" id="dropzoneFrom" style=" border: 2px dashed rgb(54, 183, 0);">
                            @csrf
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h4 class="card-title">Geleria de Imagens</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($event->images as $image)
                            <div class="col-sm-2 border shadow-sm m-3 p-1">
                                <a href="/storage/event_images/{{ $image->image }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
                                    <img src="/storage/event_images/{{ $image->image }}" class="img-fluid mb-2" alt="white sample">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@if ($message = Session::get('success'))
    <span id="message" style="display: none">{{ $message }}</span>
@endif

@endsection

@section('js')
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script src="{{ asset('js/dropzone.min.js') }}"></script>

    @if ($message = Session::get('success'))
        <script>MessageAlert(['message','success']);</script>
    @endif

    @if ($message = Session::get('error'))
        <script>MessageAlert(['message','error']);</script>
    @endif
    <script>
        $(document).ready(function(){
            Dropzone.options.dropzoneFrom = {
                dictDefaultMessage: "Put your custom message here",
                autoProcessQueue: false, //para ele não enviar o arquivo automáticamente
                acceptedFiles:".png, .jpg, .jpeg", //Aqui seram os tipos de arquivos que seram aceitos, ai é simples só colocar a extensão
                maxFiles:10, // Limite de arquivo que pode ser enviado ao mesmo tempo
                addRemoveLinks:true, //aqui caso queira no processo tirar o arquivo ter a opção de remover do dropzone
                init: function(){   // inicio da função do botão
                    var submitButton = document.querySelector('#submit-all'); //aqui entra o id do botão que criamos
                    myDropzone = this;
                    submitButton.addEventListener("click",function(){ // quando clicar ele envia
                        console.log('Enviando')
                        myDropzone.processQueue(); // processo de enviar
                    });
                },
                uploadprogress: function(file, progress, bytesSent) {
                    console.log(progress)
                    // Display the progress
                }
            };
        });
    </script>
<script src="{{ asset('js/ekko-lightbox.js') }}"></script>

<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  })
</script>

@endsection
