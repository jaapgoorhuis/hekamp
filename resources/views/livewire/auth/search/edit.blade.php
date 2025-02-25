<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Zoekwoord toevoegen</p>
                    <a class="close-card" href="" wire:click.prevent="cancelProject()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Zoekwoord:</h5>

                        <br/>
                        <div class="form-section">

                                <ul wire:ignore class="nav2 nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="nl-tab" data-bs-toggle="tab" data-bs-target="#nl-title-tab-pane" type="button" role="tab" aria-controls="nl-title-tab-pane" aria-selected="true">NL</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="de-tab" data-bs-toggle="tab" data-bs-target="#de-title-tab-pane" type="button" role="tab" aria-controls="de-title-tab-pane" aria-selected="false">DE</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-title-tab-pane" type="button" role="tab" aria-controls="en-title-tab-pane" aria-selected="false">EN</button>
                                    </li>

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="nl-title-tab-pane" role="tabpanel" aria-labelledby="nl-title-tab" tabindex="0">
                                        <div class="form-section">
                                            <div class="form-group mb-3">
                                                <label for="keyword_nl">NL - Zoekwoord:</label>
                                                <input type="text" class="form-control @error('keyword_nl') is-invalid @enderror" id="title_nl" placeholder="kuilbak" wire:model.defer="keyword_nl">
                                                @error('keyword_nl')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="de-title-tab-pane" role="tabpanel" aria-labelledby="de-title-tab" tabindex="0">
                                        <div class="form-section">
                                            <div class="form-group mb-3">
                                                <label for="keyword_de">DE - Zoekwoord:</label>
                                                <input type="text" class="form-control @error('keyword_de') is-invalid @enderror" id="title_de" placeholder="kuilbak" wire:model.defer="keyword_de">
                                                @error('keyword_de')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="en-title-tab-pane" role="tabpanel" aria-labelledby="en-title-tab" tabindex="0">
                                        <div class="form-section">

                                            <div class="form-group mb-3">
                                                <label for="keyword_en">EN - Zoekwoord:</label>
                                                <input type="text" class="form-control @error('keyword_en') is-invalid @enderror" id="title_en" placeholder="Kuilbak" wire:model.defer="keyword_en">
                                                @error('keyword_en')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            <div class="form-group mb-3">
                                <label for="route">Product koppelen:</label><br/>
                                <small class="sub-label-admin">Selecteer het product dat je aan het zoekwoord wilt koppelen. Dit product wordt dan gevonden als er op het zoekwoord gezocht word.</small>
                                <select wire:model.live="product_id" class="form-control">
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->title_nl}}
                                    @endforeach
                                </select>
                                @error('page_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                        </div>
                        <div class="d-grid gap-2">
                            <button wire:click.prevent="update()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
                            <button wire:click.prevent="cancel()" :disabled="buttonDisabled" class="btn btn-primary btn-block">Annuleren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
