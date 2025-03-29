<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\StoreConferenceRequest;
use App\Models\Conference;
use Illuminate\Support\Str;
use Illuminate\View\View;
use HTMLPurifier;

class ConferenceController extends Controller
{
    protected $purifier;

    public function __construct(HTMLPurifier $purifier)
    {
        $this->purifier = $purifier;
    }

    public function showConferences(): View
    {
        $conferences = Conference::where('status', Status::DRAFT)
            ->orWhereNotNull('published_id')
            ->paginate(15);
        $isAdmin = auth()->user()->is_admin;

        return view('conferences', ['conferences' => $conferences, 'isAdmin' => $isAdmin]);
    }

    public function showCreateConferenceForm(): View
    {
        return view('create-conference');
    }

    /**/
    /* public function showEditConferencesForm(): View {} */

    public function storeNewConference(StoreConferenceRequest $request)
    {
        $incomingFields = $request->validated();

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['slug'] = Str::slug($incomingFields['title']);
        $incomingFields['description'] = $this->purifier->purify($incomingFields['description']);
        $incomingFields['media_release'] = $this->purifier->purify($incomingFields['media_release']);
        $incomingFields['status'] = $incomingFields['status'] ?? Status::DRAFT->value;

        Conference::create($incomingFields);

        return redirect('/conferences')->with('success', 'You have succesfully created a conference!');
    }
}
