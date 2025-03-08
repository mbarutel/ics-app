<?php

namespace App\Livewire;

use Livewire\Component;

class EditEvent extends Component
{
    public $event;

    public function render()
    {
        return view('livewire.edit-event');
    }

    public function mount()
    {
        $this->event = $this->event;
    }
}
