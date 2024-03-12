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
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Homepagina" wire:model="title">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="route">route:</label><br/>
                                <small class="sub-label-admin">Maak deze route zo eenvoudig mogelijk</small>
                                <input class="form-control @error('route') is-invalid @enderror" id="route" wire:model="route" placeholder="index">
                                @error('route')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="route">Type pagina:</label><br/>
                                <small class="sub-label-admin">Is de pagina een vervolgpagina of een projecten pagina</small>
                                <select wire:model="page_type" class="form-control">
                                    @if(\Illuminate\Support\Facades\Auth::user()->role_id >= 3)
                                        <option value="index">Home pagina</option>
                                        <option value="projects">Projecten pagina</option>
                                        <option value="projectDetail">Project detail pagina</option>
                                        <option value="contact">Contact pagina</option>2
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
                                <select wire:model="is_active" class="form-control">
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
                                    <select wire:model="is_removable" class="form-control">
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
                                <select wire:model="show_header" class="form-control">
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
                                <select wire:model="show_footer" class="form-control">
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
                                <div
                                    x-data="{ isUploadingEmviBaseImage: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploadingEmviBaseImage = true"
                                    x-on:livewire-upload-finish="isUploadingEmviBaseImage = false"
                                    x-on:livewire-upload-error="isUploadingEmviBaseImage = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                                    <label for="header_image">Header afbeelding:</label>
                                    <small class="sub-label-admin">Afbeelding zichtbaar op de pagina als header</small>
                                    <input type="file" class="form-control @error('header_image') is-invalid @enderror" id="header_image" wire:model="header_image">

                                    <div
                                        class="bg-blue-500 h-[2px]"
                                        style="transition: width 1s"
                                        :style="`width: ${progress}%;`"
                                        x-show="isUploadingEmviBaseImage"
                                    >
                                    </div>

                                    @if ($this->header_image)
                                        <br/>
                                        <h5 class="form-section-title">Geuploade foto:</h5>
                                        <div class="project-upload-preview-container">
                                            <div class="project-upload-preview-box">
                                                <i wire:click.prevent="removeHeaderImage()" class="fa-solid fa-trash"></i>
                                                <img src="{{ $this->header_image->temporaryUrl() }}"/>
                                            </div>
                                        </div>
                                    @endif
                                    @error('header_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div wire:ignore>
                                <div class="form-group mb-3" wire:ignore>
                                    <label for="header_text">Header knop tekst:</label><br/>
                                    <small class="sub-label-admin">Dit is de tekst in de button in de header afbeelding</small>
                                    <textarea id="header_text" wire:model.defer="header_text"></textarea>
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
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="meta_title">Meta titel:</label><br/>
                                <small class="sub-label-admin">Dit is de titel van je webpagina!</small>
                                <input class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" wire:model="meta_title" placeholder="Homepagina">
                                @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="meta_keywords">Meta Keywords:</label><br/>
                                <small class="sub-label-admin">Keywords scheiden met een comma en een spatie!</small>
                                <input class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" wire:model="meta_keywords" placeholder="ICT, Webontwikkeling, Websites">
                                @error('meta_keywords')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="meta_description">Meta beschrijving:</label><br/>
                                <small class="sub-label-admin">Omschrijf hier je pagina (minimaal 70 en maximaal 155 characters)</small>
                                <textarea class="form-control @error('meta_description') is-invalid @enderror" minlength="70" maxlength="155" id="meta_description" wire:model="meta_description" placeholder="ICT, Webontwikkeling, Websites"></textarea>
                                @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{--<div class="form-group mb-3">
                                <label for="route">Meta robots:</label><br/>
                                <small class="sub-label-admin">Keywords scheiden met een comma en een spatie!</small>
                                <input class="form-control @error('meta_robots') is-invalid @enderror" id="meta_robots" wire:model="meta_robots" placeholder="ICT, Webontwikkeling, Websites">
                                @error('meta_robots')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>--}}
                        </div>
                        <div class="d-grid gap-2">
                            <button wire:click.prevent="storePage()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
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
