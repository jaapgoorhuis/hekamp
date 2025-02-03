<?php

namespace App\Livewire\Auth\Account;

use App\Models\MenuItems;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Account extends Component
{
    public $user;
    public $firstname;
    public $lastname;
    public $email;
    public $street;
    public $city;
    public $zipcode;
    public $role_id;
    public $password_confirmation;
    public $password;


    use WithFileUploads;

public function mount() {
    $this->user = Auth::user();
    $this->firstname = $this->user->firstname;
    $this->lastname = $this->user->lastname;
    $this->email = $this->user->email;
    $this->street = $this->user->street;
    $this->city = $this->user->city;
    $this->zipcode = $this->user->zipcode;
    return view('livewire.auth.account.account');
}

    public function render()
    {

        return view('livewire.auth.account.account');
    }



    public function rules() {
        return [
            'email' => 'required|string|email|unique:users,email,' .$this->user->id,
            'firstname' => 'required',
            'lastname' => 'required',
        ];
    }
    public function passwordRules() {
        return [
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8'
        ];
    }

    public function update() {
        $this->validate($this->rules());

        $this->user->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'street' => $this->street,
            'city' => $this->city,
            'zipcode' => $this->zipcode,
        ]);

        if($this->password) {
            $this->validate($this->passwordRules());

            $this->user->update([
                'password' => Hash::make($this->password)
            ]);

        }

        session()->flash('success','Account bijgewerkt');

        return $this->redirect('/auth/account', navigate: true);
    }


}
