<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Pagina toevoegen</p>
                    <a class="close-card" href="" wire:click.prevent="cancelPage()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Pagina gegevens:</h5>

                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="title">Naam van de pagina:</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Homepagina" wire:model.live="title">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="route">route:</label><br/>
                                <small class="sub-label-admin">Maak deze route zo eenvoudig mogelijk</small>
                                <input class="form-control @error('route') is-invalid @enderror" id="route" wire:model.live="route" placeholder="index">
                                @error('route')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="route">Type pagina:</label><br/>
                                <small class="sub-label-admin">Is de pagina een vervolgpagina of een projecten pagina</small>
                                <select wire:model.live="page_type" class="form-control">
                                    @if(\Illuminate\Support\Facades\Auth::user()->role_id >= 3)
                                        <option value="index">Home pagina</option>
                                        <option value="projects">Projecten pagina</option>
                                        <option value="projectDetail">Project detail pagina</option>
                                        <option value="contact">Contact pagina</option>
                                    @endif
                                    <option value="followUp">Normale vervolg pagina</option>
                                </select>
                                @error('page_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br/>
                        <hr class="rounded">
                        <h5 class="form-section-title">Pagina instellingen:</h5>
                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="is_active">Pagina actief:</label><br/>
                                <small class="sub-label-admin">Is de pagina actief op de website of niet</small>
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
                                    <label for="is_removable">Pagina verwijderbaar:</label><br/>
                                    <small class="sub-label-admin">Is de pagina verwijderbaar voor gebruikers:</small>
                                    <select wire:model.live="is_removable" class="form-control">
                                        <option value="1" wire:selected>Ja</option>
                                        <option value="0">Nee</option>
                                    </select>
                                    @error('is_active')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="form-group mb-3">
                                <label for="show_header">Header zichtbaar op pagina:</label><br/>
                                <small class="sub-label-admin">Voeg de header toe aan de pagina.</small>
                                <select wire:model.live="show_header" class="form-control">
                                    <option value="1" wire:selected>Ja</option>
                                    <option value="0">Nee</option>
                                </select>
                                @error('show_header')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="show_footer">Footer zichtbaar op pagina:</label><br/>
                                <small class="sub-label-admin">Voeg de footer toe aan de pagina.</small>
                                <select wire:model.live="show_footer" class="form-control">
                                    <option value="1" wire:selected>Ja</option>
                                    <option value="0">Nee</option>
                                </select>
                                @error('show_header')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <br/>
                        <hr class="rounded">
                        <h5 class="form-section-title">Header instellingen:</h5>
                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <x-filepond::upload
                                    multiple="false"
                                    wire:model="header_image"

                                />
                            </div>
                            <BR/>

                            @if($this->page->getMedia('files'))
                                <hr class="rounded">
                                <h5 class="form-section-title">Header afbeelding:</h5>

                                <br/>
                                <div class="accordion" id="accordionExample">
                                    <ul style="list-style: none; padding:0px" >
                                        @foreach($this->page->getMedia('files') as $items)
                                            <li >
                                                <div class="flex-grid">
                                                    <div class="col accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree_{{$items->id}}" aria-expanded="false" aria-controls="collapseThree">
                                                                <img src="{!! $items['original_url'] !!}" style="width:150px;"/>
                                                            </button>
                                                        </h2>
                                                        <div wire:ignore>
                                                            <div id="collapseThree_{{$items->id}}" style="width:100%;" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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

                            <div wire:ignore>
                                <div class="form-group mb-3" wire:ignore>
                                    <label for="header_text">Header tekst:</label><br/>
                                    <small class="sub-label-admin">Dit is de tekst die zichtbaar is in de header van de pagina</small>
                                    <textarea id="header_text" wire:model="header_text">{{$this->header_text}}</textarea>
                                    @error('header_text')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <br/>
                        <hr class="rounded">
                        <h5 class="form-section-title">SEO:</h5>
                        <br/>
                        <ul class="nav2 nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="nl-tab" data-bs-toggle="tab" data-bs-target="#nl-seo-tab-pane" type="button" role="tab" aria-controls="nl-seo-tab-pane" aria-selected="true">NL</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="de-tab" data-bs-toggle="tab" data-bs-target="#de-seo-tab-pane" type="button" role="tab" aria-controls="de-seo-tab-pane" aria-selected="false">DE</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-seo-tab-pane" type="button" role="tab" aria-controls="en-seo-tab-pane" aria-selected="false">EN</button>
                            </li>

                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="nl-seo-tab-pane" role="tabpanel" aria-labelledby="nl-text-tab" tabindex="0">
                                <div class="form-section">
                                    <div class="form-group mb-3">
                                        <label for="meta_title">NL - Meta titel:</label><br/>
                                        <small class="sub-label-admin">Dit is zoektitel van de pagina</small>
                                        <input class="form-control @error('meta_title_nl') is-invalid @enderror" id="meta_title_nl" wire:model.live="meta_title_nl" placeholder="Shovels">
                                        @error('meta_title_nl')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="meta_keywords">NL - Meta zoekwoorden:</label><br/>
                                        <small class="sub-label-admin">Keywords scheiden met een comma en een spatie!</small>
                                        <input class="form-control @error('meta_keywords_nl') is-invalid @enderror" id="meta_keywords_nl" wire:model.live="meta_keywords_nl" placeholder="Shovels, bakken">
                                        @error('meta_keywords_nl')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="meta_description">NL - Meta beschrijving:</label><br/>
                                        <small class="sub-label-admin">Omschrijf hier je pagina (minimaal 70 en maximaal 155 characters)</small>
                                        <textarea class="form-control @error('meta_description_nl') is-invalid @enderror" minlength="70" maxlength="155" id="meta_description_nl" wire:model.live="meta_description_nl" placeholder="Omschrijving van de categorie"></textarea>
                                        @error('meta_description_nl')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="de-seo-tab-pane" role="tabpanel" aria-labelledby="de-seo-tab" tabindex="0">
                                <div class="form-section">
                                    <div class="form-group mb-3">
                                        <label for="meta_title">DE - Meta-titel:</label><br/>
                                        <small class="sub-label-admin">Dit is zoektitel van de pagina</small>
                                        <input class="form-control @error('meta_title_de') is-invalid @enderror" id="meta_title_de" wire:model.live="meta_title_de" placeholder="Shovels">
                                        @error('meta_title_de')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="meta_keywords">DE - Meta zoekwoorden:</label><br/>
                                        <small class="sub-label-admin">Keywords scheiden met een comma en een spatie!</small>
                                        <input class="form-control @error('meta_keywords_de') is-invalid @enderror" id="meta_keywords_de" wire:model.live="meta_keywords_de" placeholder="Shovels, bakken">
                                        @error('meta_keywords_de')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="meta_description">DE - Meta beschrijving:</label><br/>
                                        <small class="sub-label-admin">Omschrijf hier je pagina (minimaal 70 en maximaal 155 characters)</small>
                                        <textarea class="form-control @error('meta_description_de') is-invalid @enderror" minlength="70" maxlength="155" id="meta_description_de" wire:model.live="meta_description_de" placeholder="Omschrijving van de pagina"></textarea>
                                        @error('meta_description_de')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="en-seo-tab-pane" role="tabpanel" aria-labelledby="en-seo-tab" tabindex="0">
                                <div class="form-section">
                                    <div class="form-group mb-3">
                                        <label for="meta_title">EN - Meta titel:</label><br/>
                                        <small class="sub-label-admin">Dit is de titel van je pagina!</small>
                                        <input class="form-control @error('meta_title_en') is-invalid @enderror" id="meta_title_en" wire:model.live="meta_title_en" placeholder="Shovels">
                                        @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="meta_keywords">EN - Meta zoekwoorden:</label><br/>
                                        <small class="sub-label-admin">Keywords scheiden met een comma en een spatie!</small>
                                        <input class="form-control @error('meta_keywords_en') is-invalid @enderror" id="meta_keywords_en" wire:model.live="meta_keywords_en" placeholder="Shovels, bakken">
                                        @error('meta_keywords_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="meta_description">EN - Meta beschrijving:</label><br/>
                                        <small class="sub-label-admin">Omschrijf hier je pagina (minimaal 70 en maximaal 155 characters)</small>
                                        <textarea class="form-control @error('meta_description_en') is-invalid @enderror" minlength="70" maxlength="155" id="meta_description_en" wire:model.live="meta_description_en" placeholder="Omschrijving van de pagina"></textarea>
                                        @error('meta_description_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button wire:click.prevent="editPage()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
                            <button wire:click.prevent="cancelPage()" :disabled="buttonDisabled" class="btn btn-primary btn-block">Annuleren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @script
    <script>
        $('#header_text').summernote({
            tabsize: 2,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            height: 150,

            callbacks: {
                onChange: function (contents, $editable) {
                @this.set('header_text', contents)
                }
            }
        });
        $("#header_text").on("summernote.enter", function (we, e) {
            $(this).summernote("pasteHTML", "<br><br>");
            e.preventDefault();
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
