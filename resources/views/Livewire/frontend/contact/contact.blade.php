<div>
    <div class="contact-content-box">
        @if(Session::has('success'))
            <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                <div style="text-align: center">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container">
            <div class="contact-content">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="color-gold">enthousiast <span class="color-white">geworden?</span></h4>
                        <p>Wij ook! neem vrijblijvend contact met ons op</p>
                        <div class="contact-info-box">
                            <ul class="contact-info-list">
                                <li style="margin-top:20px;">
                                    <span class="color-gold">Contactgegevens:</span>
                                </li>
                                <li>
                                    <a href="mailto:info@crewa.nl"><i class="fa-solid fa-mobile-screen"></i> 06 - 31 93 35 06</a>
                                </li>

                                <li>
                                    <a href="mailto:info@crewa.nl"><i class="fa-regular fa-envelope"></i> info@crewa.nl</a>
                                </li>

                                <li style="margin-top:50px;">
                                    <span class="color-gold">Adresgegevens:</span>
                                </li>
                                <li>
                                    <span class="color-white">
                                       <i class="fa-solid fa-house-chimney"></i>
                                        Hulstweg 24 BIS<br/>
                                        3774 TM<br/>
                                        Kootwijkerbroek
                                    </span>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-md-8 contact-form-box">
                        <form id="contact-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <label for="name" class="">Je naam</label>
                                        <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror">

                                         @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <label for="email" class="">Je email adres</label>
                                        <input type="text" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <label for="subject" class="">Onderwerp</label>
                                        <input type="text" id="subject" wire:model="subject" class="form-control @error('subject') is-invalid @enderror">
                                        @error('subject')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form">
                                        <label for="message">Je vraag/opmerking</label>
                                        <textarea id="message" wire:model="bericht" rows="4" class="form-control md-textarea @error('bericht') is-invalid @enderror"></textarea>
                                        @error('bericht')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </form>

                        <div class="text-md-left form-button">
                            <span class="next-button">Aanvraag versturen</span>
                            <a class="white" wire:click="sendForm()"><span class="next-button-end"><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="status"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
