<?php

namespace App\Livewire;

use Livewire\Component;

class EditConference extends Component
{
    public $conference;

    public function render()
    {
        return view('livewire.edit-conference');
    }

    public function mount()
    {
        $this->conference = $this->conference;
    }
}
