<?php

namespace App\Livewire\Frontend\Contact;

use App\Mail\SendContactFormMail;
use http\Env;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $bericht;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'bericht' => 'required'
    ];

    public function render()
    {
        return view('livewire.frontend.contact.contact');
    }

    public function resetFields() {
        $this->name = '';
        $this->email = '';
        $this->subject = '';
        $this->bericht = '';
    }
    public function sendForm() {
        $this->validate();
        Mail::to('info@crewa.nl')->send(new SendContactFormMail($this->name, $this->email, $this->subject, $this->bericht));
        session()->flash('success','Gelukt! Wij nemen zo snel mogelijk contact met u op');
        $this->resetFields();
    }
}
