@extends('layouts.client')

@section('container')

<div class="container" id="events">

    <nav class="navbar navbar-expand-lg navbar-dark" id="mainNav">
        <div class="container">
            <span class="custom-dropdown">
                <form action="{{ route('#events') }}" method="post" id="form_filters_modality">
                    @csrf
                    <input type="hidden" name="id_filter" id="id_filter" value="{{ $id }}">
                    <select name="filter" id="filter">
                        <option value="1" {{ isset($id) && $id==1 ? 'selected':'' }}>Lançamentos & Inscrições Abertas</option>
                        <option value="2" {{ isset($id) && $id==2 ? 'selected':'' }}>Lançamentos</option>
                        <option value="3" {{ isset($id) && $id==3 ? 'selected':'' }}>Inscrições Abertas</option>
                        <option value="4" {{ isset($id) && $id==4 ? 'selected':'' }}>Inscrições Encerradas</option>
                    </select>
                    {{-- <button type="submit">Filtrar</button> --}}
                </form>
            </span>
        </div>
    </nav>
<hr>
    <div class="text-center">
        <h2 class="section-heading text-uppercase">Eventos</h2>
        <h3 class="section-subheading text-muted">Escolha os seus eventos e faça já as suas inscrições.</h3>
    </div>

    <div class="row current">
        @foreach ($events as $key=>$event)

            <div class="col-lg-4 col-sm-6 mb-4">

                @if($event->status == 1)
                <div class="position-relative bg-gray">
                    <div class="ribbon-wrapper ribbon-xl">
                      <div class="ribbon bg-warning text-lg">
                        NOVIDADE
                      </div>
                    </div>
                @endif
                     <!-- Portfolio item 1-->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#event{{$key}}">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="/storage/logo_events/{{ $event->logo }}" alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">{{ $event->name }}</div>
                            <div>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date_event)->format('d/m/Y H:i a') }} - {{ $event->adress}}
                            </div>
                            <div class="portfolio-caption-subheading text-muted">{{ $event->description }}</div>
                        </div>
                    </div>
                @if($event->status == 1)
                </div>
                @endif

            </div>
        @endforeach
    </div>

    @foreach($events as $key=>$event)
        <div class="portfolio-modal modal fade" id="event{{$key}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="client/assets/img/close-icon.svg" alt="Close modal" /></div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="modal-body">
                                        <!-- Project details-->
                                        <h2 class="text-uppercase">{{ $event->name }}</h2>
                                        {{-- <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p> --}}
                                        <img class="img-fluid d-block mx-auto" src="/storage/logo_events/{{ $event->logo }}" alt="..." />
                                        <p>{{ $event->description }}</p>
                                        <ul class="list-inline">
                                            <li>
                                                <strong>Início:</strong>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date_event)->format('H:i a') }}
                                            </li>
                                            <li>
                                                <strong>Final</strong>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date_event)->modify('+4 hours')->format('H:i a') }}

                                            </li>
                                        </ul>

                                        @if($event->status == 2)

                                            <form action="{{ route('subscribe.store') }}" method="post">
                                                @csrf

                                                <input type="hidden" name="event" value="{{ $event->id }}">
                                                @foreach ($event->categories as $category)
                                                    <input class="form-check-input" type="radio" id="{{ $category->id }}" name="select_category" value="{{ $category->id }}">
                                                    <label for="html">{{ $category->name}} - @money($category->pivot->cost) </span></label><br>
                                                @endforeach

                                                <button class="btn btn-primary btn-xl text-uppercase"  type="submit">
                                                    <i class="fas fa-thumbs-up me-1"></i>
                                                    @auth
                                                    Inscreva-se
                                                    @else
                                                    Login
                                                    @endauth
                                                </button>

                                            </form>


                                        @elseif ($event->status == 3)
                                            <h3>Incrições Encerradas</h3>
                                        @elseif ($event->status == 1)
                                            <h3>Início das Incrições em {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('d/m/Y H:i a') }}</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>

@if ($message = Session::get('success'))
    <span id="message">{{ $message }}</span>
@endif
@endsection

@section('js')
    <script>
        function scrollToEvents()
        {
            var $valFilter = document.querySelector('#id_filter').value;
            console.log($valFilter)
            if($valFilter != 0) {
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('events').scrollIntoView();
                    console.log('event');

                }, false);
            }
        }

        document.querySelector('#filter').addEventListener('change', function(){
            document.querySelector('#form_filters_modality').submit()
            console.log('eventFilter');

        });
        scrollToEvents();

        // $(document).ready(function(){
            // $('#filter').change(function() {
            //     $.ajax({
            //         url : "/",
            //         type : 'post',
            //         data : {
            //             _token : $('input[name="_token"]').attr('value'),
            //             filter : $(this).find(":selected").val(),
            //         },
            //         beforeSend : function(){
            //             $("#result").html("Aguarde...");
            //         }
            //     })
            //     .done(function(msg){
            //         console.log(msg);
            //         $("#result").html(msg);
            //     })
            //     .fail(function(jqXHR, textStatus, msg){
            //         alert(msg);
            //     });
            // });
        // });


    </script>

@endsection
