<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function showEvents()
    {
        $events = Event::orderBy('start_date', 'desc')->paginate(15);
        $isAdmin = auth()->user()->is_admin;

        return view('events', ['events' => $events, 'isAdmin' => $isAdmin]);
    }

    public function showCreateEventForm(): View
    {
        return view('create-event');
    }

    public function storeNewEvent(StoreEventRequest $request)
    {
        $incomingFields = $request->validated();

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['slug'] = Str::slug($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['venue'] = strip_tags($incomingFields['venue']);
        $incomingFields['status'] = $incomingFields['status'] ?? Status::DRAFT->value;
        $incomingFields['created_by'] = auth()->id();
        $incomingFields['updates_by'] = $incomingFields['created_by'];

        // Convert to UTC format expected by Laravel
        $incomingFields['start_date'] = Carbon::parse($incomingFields['start_date'])->toISOString();
        $incomingFields['end_date'] = Carbon::parse($incomingFields['end_date'])->toISOString();

        Event::create($incomingFields);

        return redirect('/events')->with('success', 'You have succesfully created an event!');
    }

    public function updateEvent() {}

    public function publishEvent() {}
}
