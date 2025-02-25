<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            @if(Session::has('success'))
                <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Website instellingen</p>
                    <a class="close-card" href="" wire:click="cancelPage()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Website gegevens:</h5>
                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="site_name">Website naam:</label>
                                <input type="text" class="form-control @error('site_name') is-invalid @enderror" id="site_name" wire:model.live="site_name">
                                @error('site_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">Telefoonnummer:</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" wire:model.live="phone">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="mobile_phone">Mobiele telefoonnummer:</label><br/>
                                <small>Het nummer komt in de footer op de website te staan</small>
                                <input type="text" class="form-control @error('mobile_phone') is-invalid @enderror" id="mobile_phone" wire:model.live="mobile_phone">
                                @error('mobile_phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email adres:</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.live="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="second_email">Tweede email adres:</label>
                                <input type="text" class="form-control @error('second_email') is-invalid @enderror" id="second_email" wire:model.live="second_email">
                                @error('second_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <br/>
                            <hr class="rounded">
                            <h5 class="form-section-title">Adres gegevens:</h5>
                            <br/>

                            <div class="form-group mb-3">
                                <label for="address">Adres:</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" wire:model.live="address">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="zipcode">Postcode:</label>
                                <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode"  wire:model.live="zipcode">
                                @error('zipcode')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="town">Woonplaats:</label>
                                <input type="text" class="form-control @error('town') is-invalid @enderror" id="town" wire:model.live="town">
                                @error('town')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="province">Provincie:</label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" wire:model.live="province">
                                @error('province')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br/>
                        </div>
                        <div class="d-grid gap-2">
                            <button wire:click.prevent="update()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
