<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    public function showEvents(): View
    {
        $events = Event::orderBy('start_date', 'desc')->paginate(15);
        $isAdmin = auth()->user()->is_admin;

        return view('events', ['events' => $events, 'isAdmin' => $isAdmin]);
    }

    public function showCreateEventForm(): View
    {
        return view('create-event');
    }

    public function showEditEventForm(Event $event): View
    {
        return view('edit-event', ['event' => $event]);
    }

    public function storeNewEvent(StoreEventRequest $request)
    {
        $incomingFields = $request->validated();

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['slug'] = Str::slug($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['venue'] = strip_tags($incomingFields['venue']);
        $incomingFields['created_by'] = auth()->id();
        $incomingFields['updated_by'] = $incomingFields['created_by'];
        $incomingFields['start_date'] = Carbon::parse($incomingFields['start_date'])->toISOString();
        $incomingFields['end_date'] = Carbon::parse($incomingFields['end_date'])->toISOString();
        $incomingFields['status'] = $incomingFields['status'] ?? Status::DRAFT->value;

        Event::create($incomingFields);

        return redirect('/events')->with('success', 'You have succesfully created an event!');
    }

    public function updateEvent(Event $event, StoreEventRequest $request): RedirectResponse
    {
        $incomingFields = $request->validated();

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['slug'] = Str::slug($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['venue'] = strip_tags($incomingFields['venue']);
        $incomingFields['updates_by'] = auth()->id();
        $incomingFields['start_date'] = Carbon::parse($incomingFields['start_date'])->toISOString();
        $incomingFields['end_date'] = Carbon::parse($incomingFields['end_date'])->toISOString();
        $incomingFields['status'] = $incomingFields['status'] ?? Status::DRAFT->value;

        $event->update($incomingFields);
        return back()->with('success', 'Event successfully updated.');
    }

    public function publishEvent() {}
}
