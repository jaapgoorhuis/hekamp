<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Afbeelding blok - aanmaken</p>
                    <a class="close-card" href="" wire:click.prevent="cancel()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form>
                        <div wire:ignore>
                            <div class="form-group mb-3" wire:ignore>
                                <h5 class="form-section-title">Template selecteren:</h5>
                                <div class="template_1 template">
                                    <label>Template 1:</label>
                                    <div class="row" style="margin-left: 0px;">
                                        <div class="col-md-6 template-column">
                                            Afbeelding 1

                                        </div>
                                        <div class="col-md-6 template-column">
                                            Afbeelding 2
                                        </div>
                                    </div>

                                    <button wire:click.prevent="updateTemplate(2)" class="btn btn-primary btn-block select-template-button">Kies dit template</button>
                                </div>

                                <div  class="template_2 template">
                                    <label>Template 2:</label>
                                    <div class="row" style="margin-left: 0px;">
                                        <div class="template-column">
                                            Afbeelding 1
                                        </div>
                                    </div>

                                    <button wire:click.prevent="updateTemplate(1)" class="btn btn-primary btn-block select-template-button">Kies dit template</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if($showTemplateOption1)
                        <h5 class="form-section-title">Template 2: Afbeelding uploaden:</h5>
                        <div wire:ignore>
                            <div class="form-group mb-3" wire:ignore>
                                <label for="value">Upload een afbeelding:</label><br/>
                                <input type="file" wire:model.live="image_url">
                                @error('value')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif

                        @if($showTemplateOption2)
                            <h5 class="form-section-title">Template 1: Afbeeldingen uploaden:</h5>
                            <div wire:ignore>
                                <div class="form-group mb-3" wire:ignore>
                                    <label for="value">Upload afbeelding links:</label><br/>
                                    <input type="file" wire:model.live="image_url">
                                    @error('value')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div wire:ignore>
                                    <div class="form-group mb-3" wire:ignore>
                                        <label for="value">Upload afbeelding rechts:</label><br/>
                                        <input type="file" wire:model.live="image_url2">
                                        @error('value')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        @endif

                        <div class="d-grid gap-2">
                            <button wire:click.prevent="storeBlock" class="btn btn-success btn-block">Opslaan</button>
                            <button wire:click.prevent="cancel" class="btn btn-primary btn-block">Annuleren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

