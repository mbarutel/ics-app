<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\Event;

class EventController extends Controller
{
    public function showEvents() {}

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
        // $incomingFields['status'] = $incomingFields['status'] ?? Status::DRAFT->value;

        // return $incomingFields;

        $newEvent = Event::create($incomingFields);

        return $newEvent;
    }
}
