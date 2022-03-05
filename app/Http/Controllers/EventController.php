<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
  function index()
  {
    $search = request('search');
    if ($search) {
      $events = Event::where([
        ['name', 'like', '%' . $search . '%']
      ])->get();
      return view('welcome', ['events' => $events, 'search' => $search]);
    } else {
      $events = Event::all();
      return view('welcome', ['events' => $events, 'search' => $search]);
    }
  }
  //
  function create()
  {
    return view('events.create');
  }

  function store(Request $request)
  {
    $event = new Event();
    $event->name = $request->title;
    $event->date = $request->date;
    $event->city = $request->city;
    $event->description = $request->description;
    $event->private = $request->private;
    $event->items = $request->items;

    //Image upload
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
      $requestImage = $request->image;
      $extension = $requestImage->extension();
      $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;
      $requestImage->move(public_path('img/events'), $imageName);
      $event->image = $imageName;
    }
    $event->save();

    return redirect('/')->with('msg', "Created event succesfully!");
  }

  function show($id)
  {
    $event = Event::findOrFail($id);

    return view('events.show', ['event' => $event]);
  }
}
