<div>
    <div class="container-full">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=913&amp;height=400&amp;hl=en&amp;q=kruisweg 4 kootwijkerbroek&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 contact-box">
                <form method="post" action="/contact-form">
                   <h1 class="grey">{{__('pages.contact')}}</h1>
                    <br/>
                    <div class="form-section-contact">
                        <div class="form-group mb-3">
                            <label class="grey" for="title">{{__('pages.name')}}</label>
                            <input type="text" class="contact-form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="{{__('pages.name')}}..">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-section-contact">
                        <div class="form-group mb-3">
                            <label class="grey" for="title">{{__('pages.company_name')}}</label>
                            <input type="text" class="contact-form-control @error('company_name') is-invalid @enderror" wire:model="company_name" placeholder="{{__('pages.company_name')}}..">
                            @error('company_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-section-contact">
                        <div class="form-group mb-3">
                            <label class="grey" for="title">{{__('pages.phone')}}</label>
                            <input type="text" class="contact-form-control @error('phone') is-invalid @enderror" wire:model="phone" placeholder="{{__('pages.phone')}}..">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-section-contact">
                        <div class="form-group mb-3">
                            <label class="grey" for="title">{{__('pages.email')}}</label>
                            <input type="text" class="contact-form-control @error('email') is-invalid @enderror" wire:model="email" placeholder="{{__('pages.email')}}..">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-section-contact">
                        <div class="form-group mb-3">
                            <label class="grey" for="title">{{__('pages.message')}}</label>
                            <textarea class="contact-form-control @error('message') is-invalid @enderror" wire:model="message" placeholder="{{__('pages.message')}}...">
                            </textarea>
                            @error('message')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section-contact">
                        <div class="form-group mb-3">
                            <label class="grey" for="title">{{__('pages.areHuman')}}</label>
                            <br/>
                            {!!getCaptchaQuestion()!!}

                            <input type="text" class="contact-form-control @error('email') is-invalid @enderror" name="_answer" wire:model="answer">

                            @error('answer')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>



                    <div class="d-grid gap-2">
                        <button wire:click.prevent="storeContact()" class="btn btn-outline-secondary">{{__('pages.send')}}</button>
                    </div>
                </form>
                <br/>
                @if(Session::has('success'))
                    <div id="succes-alert" class="alert alert-success alert-contact alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <style>
        body {
            background:white !important;
        }
    </style>
</div>

