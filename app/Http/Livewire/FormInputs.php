<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class FormInputs extends Component
{
    public $reference_code;
    public $user;
    public $name;
    public $email;
    public $cellphone;
    public $address;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'cellphone' => 'required|numeric|digits:10',
        'address' => 'required|string|max:255',
    ];

    protected $listeners = [
        'validateForm' => 'validateAll',
        'pay' => 'pay',
    ];

    public function mount()
    {
        if ($this->user != null) {
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->cellphone = $this->user->cellphone;
            $this->address = $this->user->address;
        }
    }

    public function render()
    {
        return view('livewire.form-inputs');
    }

    public function updated($propertyName)
    {
        // Disable submit for security
        $this->emit('disableSubmit');
        // Validate current field
        $this->validateOnly($propertyName);
        try {
            // Validate in a try/catch block to intercept the validation error.
            $this->validate();

            // If no exception was thrown, the form is valid, so we enable the button.
            $this->emit('enableSubmit');
        } catch (\Exception $e) {
            // If the global validation failed, keep the button disabled.
            $this->emit('disableSubmit');
        }
    }

    public function validateAll()
    {
        try {
            // Validate in a try/catch block to intercept the validation error.
            $this->validate();

            // If no exception was thrown, the form is valid, so we enable the button.
            $this->emit('enableSubmit');
        } catch (\Exception $e) {
            // If the global validation failed, keep the button disabled.
            $this->emit('disableSubmit');
        }
    }

    public function pay()
    {
        // Save user's name in the order
        $order = Order::find($this->reference_code);
        $order->name = $this->name;
        $order->save();
    }
}
