<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Menu item toevoegen</p>
                    <a class="close-card" href="" wire:click.prevent="cancelProject()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Menu items:</h5>

                        <br/>
                        <div class="form-section">
                            <div wire:ignore>
                                <ul class="nav2 nav-tabs" id="myTab" role="tablist">
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
                                                <label for="title_nl">NL - Menu titel:</label>
                                                <input type="text" class="form-control @error('title_nl') is-invalid @enderror" id="title_nl" placeholder="Homepagina" wire:model.live="title_nl">
                                                @error('title_nl')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="de-title-tab-pane" role="tabpanel" aria-labelledby="de-title-tab" tabindex="0">
                                        <div class="form-section">
                                            <div class="form-group mb-3">
                                                <label for="title_de">DE - Menu titel:</label>
                                                <input type="text" class="form-control @error('title_de') is-invalid @enderror" id="title_de" placeholder="Homepagina" wire:model.live="title_de">
                                                @error('title_de')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="en-title-tab-pane" role="tabpanel" aria-labelledby="en-title-tab" tabindex="0">
                                        <div class="form-section">

                                            <div class="form-group mb-3">
                                                <label for="title_en">EN - Menu titel:</label>
                                                <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="Homepagina" wire:model.live="title_en">
                                                @error('title_en')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="route">Pagina koppelen:</label><br/>
                                <small class="sub-label-admin">Selecteer de pagina die je aan dit menu item wil koppelen</small>
                                <select wire:model.live="page_id" class="form-control">
                                    @foreach($pages as $page)
                                        <option value="{{$page->id}}">{{$page->title}}
                                    @endforeach
                                </select>
                                @error('page_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="route">Item zichtbaar in het menu:</label><br/>
                                <small class="sub-label-admin">Kies of het item zichtbaar is in het menu op de website</small>
                                <select wire:model.live="show_menu" class="form-control">
                                    <option value="1">Ja</option>
                                    <option value="0">Nee</option>
                                </select>
                                @error('show_menu')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="route">Item zichtbaar in de footer:</label><br/>
                                <small class="sub-label-admin">Kies of het item zichtbaar is in de footer op de website</small>
                                <select wire:model.live="show_footer" class="form-control">
                                    <option value="1">Ja</option>
                                    <option value="0">Nee</option>
                                </select>
                                @error('show_footer')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="d-grid gap-2">
                            <button wire:click.prevent="storeMenu()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
                            <button wire:click.prevent="cancelMenu()" :disabled="buttonDisabled" class="btn btn-primary btn-block">Annuleren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
