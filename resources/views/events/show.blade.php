@extends('layouts.main')

@section('title', 'Show Product')

@section('main')
<div class="col-md-10 offset-md-1">
  <div class="row">
    <div id="image-container" class="col-md-6">
      <img src="/img/events/{{$event->image}}" class="img-fluid" alt="{{$event->name}}">
    </div>
    <div id="info-container" class="col-md-6">
      <h1> {{ $event->name}}</h1>
      <p class="event-city">
        <ion-icon name="location-outline"> </ion-icon> {{$event->city}}
      </p>
      <p class="events-participants">
        <ion-icon name="people-outline"></ion-icon>
        X-participants
      </p>
      <p class="event-owner">
        <ion-icon name="star-outline"> </ion-icon>
        Dono do evento
      </p>

      <a ref="#" class="btn btn-primary" id="event-submit">Confirm Attendance</a>
      <h3> The event has: </h3>
      @if($event->items)
      <ul id="items-list">
        @foreach($event->items as $item)
        <li>
          <ion-icon name="play-outline"></ion-icon> <span> {{$item}}</span>
        </li>
        @endforeach
      </ul>
      @else
      <p> Event has nothing </p>
      @endif
    </div>
    <div class="col-md-12" id="description-container">
      <h3> About </h3>
      <p class="event-description">{{$event->description}}</p>
    </div>
  </div>
  @endsection
