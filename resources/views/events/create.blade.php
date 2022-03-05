@extends('layouts.main')
@section('title', "Create Event")

@section('main')
<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1> Create your event </h1>
  <form action="/events/create" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="image"> Image: </label>
      <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <div class="form-group">
      <label for="title"> Event: </label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Event name">
    </div>
    <div class="form-group">
      <label for="date"> Date: </label>
      <input type="date" class="form-control" id="date" name="date">
    </div>
    <div class="form-group">
      <label for="city"> City: </label>
      <input type="text" class="form-control" id="city" name="city" placeholder="City name">
    </div>
    <div class="form-group">
      <label for="private"> It is a private event: </label>
      <select name="private" id="private" class="form-control">
        <option value="0">No</option>
        <option value="1">Yes</option>
      </select>
      <div class="form-group">
        <label for="description"> Description: </label>
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Event Description"></textarea>
      </div>
      <div class='form-group'>
        <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
      </div>
      <div class='form-group'>
        <input type="checkbox" name="items[]" value="Palco"> Palco
      </div>
      <div class='form-group'>
        <input type="checkbox" name="items[]" value="Cerveja"> Cerveja
      </div>

      <input type="submit" class="btn btn-primary" value="Make Event">
    </div>
  </form>
</div>
@endsection
