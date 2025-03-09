<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use HTMLPurifier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    protected $purifier;

    public function __construct(HTMLPurifier $purifier)
    {
        $this->purifier = $purifier;
    }

    public function showEvents(): View
    {
        $events = Event::where('status', Status::DRAFT)
            ->orWhereNotNull('published_id')
            ->orderBy('start_date', 'desc')
            ->paginate(15);
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
        $incomingFields['description'] = $this->purifier->purify($incomingFields['description']);
        $incomingFields['venue'] = strip_tags($incomingFields['venue']);
        $incomingFields['created_by'] = auth()->id();
        $incomingFields['updated_by'] = $incomingFields['created_by'];
        $incomingFields['start_date'] = $incomingFields['start_date'];
        $incomingFields['end_date'] = $incomingFields['end_date'];
        $incomingFields['status'] = $incomingFields['status'] ?? Status::DRAFT->value;

        Event::create($incomingFields);

        return redirect('/events')->with('success', 'You have succesfully created an event!');
    }

    public function updateEvent(Event $event, StoreEventRequest $request): RedirectResponse
    {
        $incomingFields = $request->validated();

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['slug'] = Str::slug($incomingFields['title']);
        $incomingFields['description'] = $this->purifier->purify($incomingFields['description']);
        $incomingFields['venue'] = strip_tags($incomingFields['venue']);
        $incomingFields['updated_by'] = auth()->id();
        $incomingFields['start_date'] = $incomingFields['start_date'];
        $incomingFields['end_date'] = $incomingFields['end_date'];
        $incomingFields['status'] = Status::DRAFT->value;

        $event->update($incomingFields);

        return back()->with('success', 'Event successfully updated.');
    }

    public function publishEvent(Event $event)
    {
        if (! isset($event->published_id)) {
            $publishedCopy = $event->replicate();
            $publishedCopy = $this->initPublishedCopy($publishedCopy);
            $event->published_id = $publishedCopy->id;
        } else {
            $publishedCopy = Event::find($event->published_id);

            // If this has happened, there is a bug in the system
            // There has been steps in place before reaching this point
            if (! $publishedCopy) {
                return back()->with('failure', 'BUG: This published event\'s draft version could not be found.');
            }

            $publishedCopy->fill($event->toArray());
            $this->initPublishedCopy($publishedCopy);
        }

        $event->status = Status::PUBLISHED->value;
        $event->save();

        return back()->with('success', 'This event is now published');
    }

    private function initPublishedCopy(Event $eventCopy): Event
    {

        $eventCopy->status = Status::PUBLISHED->value;
        $eventCopy->save();

        return $eventCopy;
    }
}
