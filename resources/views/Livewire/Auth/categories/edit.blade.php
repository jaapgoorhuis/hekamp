<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Categorie bewerken</p>
                    <a class="close-card" href="" wire:click.prevent="cancelPage()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Categorie gegevens:</h5>

                        <br/>
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
                                            <label for="title_nl">NL - Naam van de categorie:</label>
                                            <input type="text" class="form-control @error('title_nl') is-invalid @enderror" id="title_nl" placeholder="Shovels" wire:model.live="title_nl">
                                            @error('title_nl')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="de-title-tab-pane" role="tabpanel" aria-labelledby="de-title-tab" tabindex="0">
                                    <div class="form-section">
                                        <div class="form-group mb-3">
                                            <label for="title_de">DE - Naam van de categorie:</label>
                                            <input type="text" class="form-control @error('title_de') is-invalid @enderror" id="title_de" placeholder="Schaufel" wire:model.live="title_de">
                                            @error('title_de')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="en-title-tab-pane" role="tabpanel" aria-labelledby="en-title-tab" tabindex="0">
                                    <div class="form-section">
                                        <div class="form-group mb-3">
                                            <label for="title_en">EN - Naam van de categorie:</label>
                                            <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="Shovel" wire:model.live="title_en">
                                            @error('title_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <br/>
                        <hr class="rounded">
                        <h5 class="form-section-title">Categorie instellingen:</h5>
                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="is_active">Categorie actief:</label><br/>
                                <small class="sub-label-admin">Is de categorie actief op de website?</small>
                                <select wire:model.live="is_active" class="form-control">
                                    <option value="1" wire:selected>Ja</option>
                                    <option value="0">Nee</option>
                                </select>
                                @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->role_id >= 3)
                                <div class="form-group mb-3">
                                    <label for="is_removable">Categorie verwijderbaar:</label><br/>
                                    <small class="sub-label-admin">Is de categorie verwijderbaar voor gebruikers:</small>
                                    <select wire:model.live="is_removable" class="form-control">
                                        <option value="1" wire:selected>Ja</option>
                                        <option value="0">Nee</option>
                                    </select>
                                    @error('is_active')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>

                        <br/>
                        <hr class="rounded">
                        <h5 class="form-section-title">Icon:</h5>
                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="is_removable">Uploaden:</label><br/>
                                <small class="sub-label-admin">Dit icoon is zichtbaar in het menu op elke pagina.</small>
                                <div class="form-group mb-3">
                                    <x-filepond::upload
                                        multiple="false"
                                        wire:model="newIcon"

                                    />
                                </div>
                            </div>


                            @if(count($this->categorie->getMedia('icon')))
                                <hr class="rounded">
                                <h5 class="form-section-title">Icon:</h5>

                                <br/>
                                <div class="accordion" id="accordionExample">
                                    <ul style="list-style: none; padding:0px" >
                                        @foreach($this->categorie->getMedia('icon') as $items)
                                            <li >
                                                <div class="flex-grid">
                                                    <div class="col accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree_{{$items->id}}" aria-expanded="false" aria-controls="collapseThree">
                                                                <img src="{!! $items['original_url'] !!}" style="width:150px;"/>
                                                            </button>
                                                        </h2>
                                                        <div >
                                                            <div wire:ignore id="collapseThree_{{$items->id}}" style="width:100%;" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="form-section">
                                                                        <div class="form-group mb-3">
                                                                            <label for="friendly_name">Bestandsnaam:</label>
                                                                            <input type="text" class="form-control @error('friendly_name')is-invalid @enderror" value="{{$items->friendly_name}}"  wire:keyup.prevent="updateFileName({{$items['id']}},{{'$event.target.value'}})"  id="friendly_name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="align-right">
                                                                        <button wire:click.prevent="removeExistingFiles({{$items['id']}})" class="btn btn-danger btn-sm">Verwijderen</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <br/>



                            <div class="d-grid gap-2">
                                <button wire:click.prevent="edit()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
                                <button wire:click.prevent="cancel()" :disabled="buttonDisabled" class="btn btn-primary btn-block">Annuleren</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @script

    <script>
        $(document).ready(function(){
            $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function(e){
                var activeTab = $(e.target).text(); // Get the name of active tab
                var previousTab = $(e.relatedTarget).text(); // Get the name of previous active tab
                $(".active-tab span").html(activeTab);
                $(".previous-tab span").html(previousTab);
            });
        });





        let buttons = $('.note-editor button[data-toggle="dropdown"]');

        buttons.each((key, value) => {
            $(value).on('click', function (e) {
                $(this).closest('.note-btn-group').toggleClass('open');
            })
        });
        $(' ul.note-dropdown-menu.dropdown-menu').on('click', function() {
            $('.note-btn-group').removeClass('open');
        });


        $('.dropdown-menu > li ').on('click', function() {
            $('.note-btn-group').removeClass('open');
        });


        $('.note-editable').on('click', function () {
            $('.note-btn-group').removeClass('open');
        });
    </script>
    @endscript
</div>
