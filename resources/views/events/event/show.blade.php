@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}")>
<link rel="{{ asset('css/ekko-lightbox.css') }}">

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
                    <li class="list-group-item"><strong>{{ __('events.event_date') }}: </strong>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date_event)->format('d/m/Y H:i:s') }}</li>
                    <li class="list-group-item"><strong>{{ __('events.modality') }}: </strong>{{ $event->modality->name }}</li>
                    <li class="list-group-item"><strong>{{ __('events.event_description')}}: </strong>{{ $event->description }}</li>
                </ul>
                <div class="card-body">
                    <div class="bg-white clearfix">
                        @can('manager')
                            <a class="btn btn-success float-left mr-1 text-white" href="{{ route('event.edit',$event->id) }}">{{ __('events.edit_event') }}</a>

                            {!! Form::open(['method' => 'DELETE','route' => ['event.destroy', $event->id],'style'=>'display:inline']) !!}
                                {!! Form::submit(__('events.disable'), ['class' => 'btn btn-danger float-left']) !!}
                            {!! Form::close() !!}
                        @endcan
                        <a class="btn btn-default float-right" href="{{ url()->previous() }}">{{ __('events.back_page') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-7 col-xl-8">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="card">
                        <h5 class="card-header bg-dark">{{ __('events.event_values_by_category') }}</h5>
                        <div class="card-body form-group"  style="overflow:scroll; height:39em;">
                            <form action="{{ url('event/add_costs') }}" method="post" class="mb-3">
                                @csrf
                                <input type="hidden" id="event" name="event_id" value="{{ $event->id }}">
                                @foreach ($event->categories as $category)

                                <label for="{{ $category->id }}">{{ __('events.valueOf') }} {{ $category->name }}</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="text" class="form-control money"
                                    id={{ $category->id }}
                                    name={{ $category->id }}
                                    {{-- value={{ \Cknow\Money\Money::USD($category->pivot->cost)->formatByIntlLocalizedDecimal(null, null, \NumberFormatter::DECIMAL) }} --}}
                                    value={{ str_replace('.',',',$category->pivot->cost) }}
                                    data-mask >
                                </div>

                                @endforeach
                                <hr>
                                <button class="btn btn-primary" type="submit">{{ __('events.change') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <h5 class="card-header bg-dark">{{ __('events.event_videos') }}</h5>
                        <div class="card-body form-group">
                            <form action="{{ url('event/add_video') }}" method="post" class="mb-3">
                                @csrf
                                <input type="hidden" id="event" name="event_id" value="{{ $event->id }}">
                                <label for="url_video">{{ __('events.video_code') }} - <a href="https://support.google.com/youtube/answer/171780?hl=pt-BR">{{ __('events.help') }}</a></label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="url_video" name="url_video">
                                </div>

                                <button class="btn btn-primary mt-3" type="submit">{{ __('events.add') }}</button>
                                <hr>

                                <fieldset>
                                    <label for="videos">{{ __('events.videos') }}</label>
                                    <div class="row" style="overflow:scroll; height:24em;">
                                        @foreach ($event->videos as $video)
                                            <div class="col-md-6">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    {{!! $video->url_video !!}}
                                                    <a class="btn btn-sm btn-danger text-white remove-video" data-uri="{{ route('event.remove.video',$video->id) }}" style="position: relative; z-index: 1000">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h3 class="card-title">{{ __('events.image_upload') }}</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('event.upload', $event->id) }}" class="dropzone" id="dropzoneFrom" style=" border: 2px dashed rgb(54, 183, 0);">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <div class="card card-dark">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('events.image_gallery') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($event->images as $image)
                                    <div class="col-sm-2 border shadow-sm m-3 p-1 mb-5">
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

        </div>
    </div>









@if ($message = Session::get('success'))
    <span id="message" style="display: none">{{ $message }}</span>
@endif

@if ($message = Session::get('error'))
    <span id="message_error" style="display: none">{{ $message }}</span>
@endif

@endsection

@section('js')
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script src="{{ asset('js/dropzone.min.js') }}"></script>

    @if ($message = Session::get('success'))
        <script>MessageAlert(['message','success']);</script>
    @endif

    @if ($message = Session::get('error'))
        <script>MessageAlert(['message_error','error']);</script>
    @endif
    <script>
        $(document).ready(function(){
            Dropzone.options.dropzoneFrom = {
                dictDefaultMessage: "Arraste suas imagens para cá",
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

    $(".money").inputmask( 'currency',{"autoUnmask": true,
            radixPoint:",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: 'R$ ',
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
    });
  });
</script>

<script>

    let button = document.querySelector('.remove-video');
    if(button) {
        var uri=null;
        button.addEventListener('click', function(){
            uri = button.getAttribute('data-uri')

            Swal.fire({
            title: 'Apagar o Vídeo?',
            text: "Esta operação não poderá ser desfeita",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, apagar!'
            }).then((result) => {
                if (result.value) {
                    console.log(uri)
                    fetch(uri)
                    .then(response => {
                        if (!response.ok) {
                        throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })

                }
            });
        });
    }

</script>

@endsection
