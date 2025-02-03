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
                    <p>Gebruikersinstellingen</p>
                    <a class="close-card" href="" wire:click="cancelPage()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Persoonsgegevens:</h5>
                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="firstname">Voornaam:</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" wire:model.live="firstname">
                                @error('firstname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="lastname">Achternaam:</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" wire:model.live="lastname">
                                @error('lastname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.live="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <br/>
                            <hr class="rounded">
                            <h5 class="form-section-title">Adres gegevens:</h5>
                            <br/>

                            <div class="form-group mb-3">
                                <label for="street">Adres:</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="street" wire:model.live="street">
                                @error('street')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="city">Woonplaats:</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" wire:model.live="city">
                                @error('city')
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

                            <br/>
                            <hr class="rounded">
                            <h5 class="form-section-title">Wachtwoord reset:</h5>
                            <br/>

                            <div class="form-group mb-3">
                                <label for="new_password">Nieuw wachtwoord:</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.live="password">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation">Herhaal nieuw wachtwoord:</label>
                                <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"  wire:model.live="password_confirmation">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

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
