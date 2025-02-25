<div class="mobile-grid-menu-projecten">
    <a href="/index"><img src="{{asset('storage/images/frontend/logo-white.png')}}" class="project-logo" alt="Crewa Logo"/></a>
    <button class="btn btn-primary menu-button" type="button" data-bs-toggle="collapse" data-bs-target="#menuCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-controls="collapseWidthExample" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div>
        <div class="collapse collapse-horizontal" id="menuCollapse">
            <div class="card card-body mobile-menu-card">
                <img src="{{asset('storage/images/frontend/logo-gold-white.png')}}" class="mobile-logo" alt="Crewa Logo"/>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mobile-project-navbar">
                    @include('livewire.frontend.partials.menu')
                </ul>
            </div>
        </div>
    </div>
</div>
