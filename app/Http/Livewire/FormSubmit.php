<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormSubmit extends Component
{
    public $can_submit = false;

    protected $listeners = [
        'enableSubmit' => 'enable',
        'disableSubmit' => 'disable',
    ];

    public function render()
    {
        return view('livewire.form-submit');
    }

    public function validateForm()
    {
        $this->emit('validateForm');
    }

    public function enable()
    {
        $this->can_submit = true;
    }

    public function disable()
    {
        $this->can_submit = false;
    }
}
