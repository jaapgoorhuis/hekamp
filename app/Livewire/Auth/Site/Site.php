<?php

namespace App\Livewire\Auth\Site;

use App\Models\MenuItems;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Site extends Component
{
    public $site;
    public $site_name;
    public $address;
    public $zipcode;
    public $town;
    public $province;
    public $phone;
    public $mobile_phone;
    public $email;
    public $second_email;


    use WithFileUploads;

public function mount() {
    $this->site = \App\Models\Site::find(1);

        $this->site_name = $this->site->site_name;
        $this->address = $this->site->address;
        $this->zipcode = $this->site->zipcode;
        $this->town = $this->site->town;
        $this->province = $this->site->province;
        $this->phone = $this->site->phone;
        $this->mobile_phone = $this->site->mobile_phone;
        $this->email = $this->site->email;
        $this->second_email = $this->site->second_email;

    return view('livewire.auth.site.site');
}

    public function render()
    {

        return view('livewire.auth.site.site');
    }



    public function rules() {
        return [

        ];
    }


    public function update() {

        $this->site->update([
            'site_name' => $this->site_name,
            'address' => $this->address,
            'zipcode' => $this->zipcode,
            'town' => $this->town,
            'province' => $this->province,
            'phone' => $this->phone,
            'mobile_phone' => $this->mobile_phone,
            'email' => $this->email,
            'second_email' => $this->second_email,
        ]);



        session()->flash('success','Website instellingen bijgewerkt');

        return $this->redirect('/auth/site', navigate: true);
    }


}
