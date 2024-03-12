<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Projecten toevoegen aan de pagina</p>
                    <a class="close-card" href="" wire:click.prevent="cancel()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form>
                        <div wire:ignore>
                            <div class="form-group mb-3" wire:ignore>
                                <label for="value">Het blok heeft geen configuratie nodig. Klik op "voeg projecten toe" om het blok aan de pagina toe te voegen</label><br/>

                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button wire:click.prevent="storeBlock" class="btn btn-success btn-block">Voeg projecten toe</button>
                            <button wire:click.prevent="cancel" class="btn btn-primary btn-block">Annuleren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
