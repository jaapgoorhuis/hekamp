<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Project toevoegen</p>
                    <a class="close-card" href="" wire:click.prevent="cancelProject()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Project gegevens:</h5>

                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="title">Project titel:</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Homepagina" wire:model="title">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="route">Project url:</label><br/>
                                <small class="sub-label-admin">Geef het project een eenvoudige duidelijke url. <b>Let op:</b> gebruik geen spaties</small>
                                <input class="form-control @error('friendly_route') is-invalid @enderror" id="friendly_route" wire:model="friendly_route" placeholder="crewa">
                                @error('friendly_route')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="route">Project categorie:</label><br/>
                                <small class="sub-label-admin">Kies binnen welke categorie het project valt</small>
                                <select wire:model="project_category_id" class="form-control">
                                    @foreach($projectCategorys as $categorys)
                                    <option value="{{$categorys->id}}">{{$categorys->title}}</option>
                                    @endforeach
                                </select>
                                @error('page_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="route">Website url:</label><br/>
                                <small class="sub-label-admin">Voer hier de website url van het project in</small>
                                <input class="form-control @error('url') is-invalid @enderror" id="url" wire:model="url" placeholder="crewa.nl">
                                @error('url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <br/>
                        <hr class="rounded">
                        <h5 class="form-section-title">Hoofd afbeelding:</h5>
                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <div
                                    x-data="{ isUploadingTumbnail: true, progress: 0 }"
                                    x-on:livewire-upload-start="isUploadingTumbnail = true"
                                    x-on:livewire-upload-finish="isUploadingTumbnail = false"
                                    x-on:livewire-upload-error="isUploadingTumbnail = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                                    <label for="header_image">Project afbeelding:</label>
                                    <small class="sub-label-admin">Deze afbeelding is zichtbaar op de projecten pagina als hoofd afbeelding</small>
                                    <input type="file" class="form-control @error('tumbnail') is-invalid @enderror" id="tumbnail" wire:model="tumbnail">

                                    <div
                                        class="bg-blue-500 h-[2px]"
                                        style="transition: width 1s"
                                        :style="`width: ${progress}%;`"
                                        x-show="isUploadingTumbnail"
                                    >
                                    </div>

                                    @if ($tumbnail)
                                        <br/>
                                        <h5 class="form-section-title">Geuploade foto:</h5>
                                        <div class="project-upload-preview-container">
                                            <div class="project-upload-preview-box">
                                                <i wire:click.prevent="removeTumbnailImage()" class="fa-solid fa-trash"></i>
                                                <img src="{{ $tumbnail->temporaryUrl() }}"/>
                                            </div>
                                        </div>
                                    @endif

                                    @error('tumbnail')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <br/>
                        <hr class="rounded">
                        <h5 class="form-section-title">Korte beschrijving:</h5>
                        <br/>
                        <div class="form-section">
                            <div wire:ignore>
                                <div class="form-group mb-3" wire:ignore>
                                    <label for="header_text">Korte project beschrijving:</label><br/>
                                    <small class="sub-label-admin">Zorg er voor dat deze tekst kort en krachtig is.</small>
                                    <textarea id="small_description" wire:model.defer="small_description"></textarea>
                                    @error('small_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <br/>
                        <hr class="rounded">
                        <h5 class="form-section-title">Project beschrijving:</h5>
                        <br/>
                        <div class="form-section">
                            <div wire:ignore>
                                <div class="form-group mb-3" wire:ignore>
                                    <label for="header_text">Lange project beschrijving:</label><br/>
                                    <small class="sub-label-admin">Beschrijf hier het project. Wat je gedaan hebt, voor wie je wat gedaan hebt enzovoort.</small>
                                    <textarea id="description" wire:model.defer="description"></textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <br/>
                        <hr class="rounded">
                        <h5 class="form-section-title">Afbeeldingen:</h5>
                        <br/>
                        <div class="form-section">
                            <div class="form-group mb-3">
                                <div
                                    x-data="{ isUploadingProjectImages: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploadingProjectImages = true"
                                    x-on:livewire-upload-finish="isUploadingProjectImages = false"
                                    x-on:livewire-upload-error="isUploadingProjectImages = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                                    <label for="header_image">Project afbeelding:</label>
                                    <small class="sub-label-admin">Deze afbeelding is zichtbaar op de projecten pagina als hoofd afbeelding</small>
                                    <input type="file" class="form-control @error('project_images') is-invalid @enderror" id="project_images" wire:model="project_images" multiple>

                                    <div x-show="isUploadingProjectImages">
                                        <span>Uploaden...</span>
                                    </div>

                                    <div
                                        class="bg-blue-500 h-[2px]"
                                        style="transition: width 1s"
                                        :style="`width: ${progress}%;`"
                                        x-show="isUploadingProjectImages"
                                    >
                                </div>
                                <br/>

                                @error('project_images.*')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @if($project_images)
                                    <h5 class="form-section-title">Geuploade foto:</h5>
                                    <div  class="project-upload-preview-container">
                                        @foreach($project_images as $image)
                                            <div  class="project-upload-preview-box">
                                                <i wire:click.prevent="removeImages({{$loop->index}})" class="fa-solid fa-trash"></i>
                                                <img src="{{ $image->temporaryUrl() }}"/>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="clearfix"></div>
                                @endif
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button wire:click.prevent="storeProject()" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
                            <button wire:click.prevent="cancelProject()" :disabled="buttonDisabled" class="btn btn-primary btn-block">Annuleren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@script
    <script>
            $('#small_description').summernote({
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
                    @this.set('small_description', contents)
                    }
                }
            });
            $("#small_description").on("summernote.enter", function (we, e) {
                $(this).summernote("pasteHTML", "<br><br>");
                e.preventDefault();
            });

            $('#description').summernote({
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
                    @this.set('description', contents)
                    }
                }
            });
            $("#description").on("summernote.enter", function (we, e) {
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
