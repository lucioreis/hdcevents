@extends('layouts.main')

@section('title')

@section('main')

<div id="search-container" class="col-md-12">
  <h1>Busque um evento</h1>
  <form action="/" method="GET">
    <input type="text" id="search" name="search" class="form-control" placeholder="Search...">
  </form>
</div>
<div id="events-container" class="col-md-12">
  @if($search)
  <h2> Buscando por {{ $search}} </h2>
  @else
  <h2>Próximos Eventos</h2>
  <p class="subtitle">Veja os eventos dos próximos dias</p>
  @endif
  <div id="cards-container" class="row">
    @foreach($events as $event)
    <div class="card col-md-3">
      <img src="/img/events/{{$event->image}}" alt="{{ $event->title }}">
      <div class="card-body">
        <p class="card-date"> {{date('d/m/Y', strtotime($event->date))}}</p>
        <h5 class="card-title">{{ $event->name }}</h5>
        <p class="card-participants">X Participantes</p>
        <a href="/events/{{$event->id}}" class="btn btn-primary">Saber mais</a>
      </div>
    </div>
    @endforeach
    @if(count($events) == 0 && $search)
    <h4> <b>{{$search}}</b> not found. <a href="/"> See all events. </a> </h4>
    @ifelse(count($events) == 0)
    <h3> There is no events right now. </h3>
    @endif
  </div>
</div>

@endsection
