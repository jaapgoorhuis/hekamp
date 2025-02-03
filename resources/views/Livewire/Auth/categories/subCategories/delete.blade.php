<div>
    <div class="row justify-content-center mt-5" >
        <div class="col-md-12 admin-page-container">
            <div class="modal fade show" id="removeModal" data-bs-backdrop="static" data-bs-keyboard="false" style="display: block" tabindex="-1" aria-labelledby="removeModalLabel" aria-modal="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="removeModalLabel">Subcategorie verwijderen</h5>
                            <button type="button" class="btn-close" wire:click="cancel" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                         Weet u zeker dat u de subcategorie wilt verwijderen? Alle producten onder deze subcategorie worden ook verwijderd.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="cancel" data-bs-dismiss="modal">Annuleren</button>
                            <button type="button" class="btn btn-primary" wire:click="remove" >Verwijderen</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
