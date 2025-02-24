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
    public $phone;
    public $company_name;
    public $message;
    public $answer;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
        'answer' => 'required|simple_captcha'

    ];

    public function render()
    {
        return view('livewire.frontend.contact.contact');
    }

    public function resetFields() {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->company_name = '';
        $this->message = '';
        $this->answer = '';
    }
    public function sendForm() {

    }

    public function storeContact() {
        $this->validate();
        Mail::to('info@crewa.nl')->send(new SendContactFormMail($this->name, $this->company_name, $this->email, $this->phone, $this->message));
        session()->flash('success','Uw bericht is verzonden. Wij nemen zo snel mogelijk contact met u op!');
        $this->resetFields();
    }
}
