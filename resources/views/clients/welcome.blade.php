@extends('layouts.client')

@section('container')

<div class="container">

    <nav class="navbar navbar-expand-lg navbar-dark" id="mainNav">
        <div class="container">
            <span class="custom-dropdown">
                <form action="{{ route('filter') }}" method="get" id="from_filters_modality">
                    <select name="filter" id="filter">
                        <option value="1" {{ isset($id) && $id==1 ? 'selected':'' }}>Lançamentos & Inscrições Abertas</option>
                        <option value="2" {{ isset($id) && $id==2 ? 'selected':'' }}>Lançamentos</option>
                        <option value="3" {{ isset($id) && $id==3 ? 'selected':'' }}>Inscrições Abertas</option>
                        <option value="4" {{ isset($id) && $id==4 ? 'selected':'' }}>Inscrições Encerradas</option>
                    </select>
                    <button type="submit">Filtrar</button>
                </form>
            </span>
        </div>
    </nav>

    <div class="text-center">
        <h2 class="section-heading text-uppercase">Eventos</h2>
        <h3 class="section-subheading text-muted">Escolha os seus eventos e faça já as suas inscrições.</h3>
    </div>

    <div class="row">
        @foreach ($events as $key=>$event)
            <div class="col-lg-4 col-sm-6 mb-4">
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
                        <div class="portfolio-caption-subheading text-muted">{{ $event->description }}</div>
                    </div>
                </div>
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
                                        <a class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                            <i class="fas fa-times me-1"></i>
                                            Inscreva-se
                                        </a>
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
@endsection

@section('js')
    <script>

    $(document).ready(function(){

        $('#filters').on('change',function(){
            alert(this);
        });
        // $('#from_filters_modality').submit();
    });
    </script>

@endsection
