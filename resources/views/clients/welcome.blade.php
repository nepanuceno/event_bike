@extends('layouts.client')

@section('container')

<div class="container">
    <div class="text-center">
        <h2 class="section-heading text-uppercase">Portfolio</h2>
        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
    </div>
    <div class="row">
        @foreach ($events as $event)
            <div class="col-lg-4 col-sm-6 mb-4">
                <!-- Portfolio item 1-->
                <div class="portfolio-item">
                    <a class="portfolio-link" data-bs-toggle="modal" href="#events">
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
</div>
@endsection
