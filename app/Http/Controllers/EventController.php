<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
  private function uploadImage(Request $request)
  {
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
      $requestImage = $request->image;
      $extension = $requestImage->extension();
      $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;
      $requestImage->move(public_path('img/events'), $imageName);
      return $imageName;
    }
    return "";
  }
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
    $event->image = $this->uploadImage($request);

    $user = auth()->user();
    $event->user_id =  $user->id;

    $event->save();

    return redirect('/')->with('msg', "Created event succesfully!");
  }

  function show($id)
  {
    $event = Event::findOrFail($id);

    $eventOwner = User::where('id', '=', $event->user_id)->first()->toArray();

    return view('events.show', ['event' => $event, 'owner' => $eventOwner]);
  }

  function edit($id)
  {
    $event = Event::findOrFail($id);

    return view('events.edit', ['event' => $event]);
  }

  public function update(Request $request)
  {
    $data = $request->all();
    $data['image'] = $this->uploadImage($request);
    Event::findOrFail($request->id)->update($data);

    return redirect('/dashboard')->with('msg', "Event EDITED successfully!!!");
  }

  public function destroy($id)
  {
    Event::findOrFail($id)->delete();

    return redirect('/dashboard')->with('msg', "Event removed successfully!");
  }

  public function joinEvent($id)
  {
    $user = auth()->user();
    $event = Event::findOrFail($id);
    if ($user->eventsAsParticipant()->where('event_id', '=', $id)->exists()) {
      return redirect('/dashboard')->with('msg', 'Already enrolled in event');
    }
    $user->eventsAsParticipant()->attach($id);
    return redirect('/dashboard')->with('msg', 'Joined Event' . $event->name);
  }

  public function leaveEvent($id)
  {
    $user = auth()->user();
    $user->eventsAsParticipant()->detach($id);

    $event = Event::findOrFail($id);

    return redirect('/dashboard')->with('msg', "Left event" . $event->name);
  }

  function dashboard()
  {
    $user = auth()->user();

    $events = $user->events;

    $eventsAsParticipant = $user->eventsAsParticipant;

    return view('events.dashboard', ['events' => $events, 'eventsAsParticipant' => $eventsAsParticipant]);
  }
}
