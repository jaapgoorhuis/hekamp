<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Tekst blok bewerken</p>
                    <a class="close-card" href="" wire:click.prevent="cancel()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form>
                        <div wire:ignore>
                            <div class="form-group mb-3" wire:ignore>
                                <label for="value">blok tekst:</label><br/>
                                <small class="sub-label-admin">Schrijf hier de tekst voor dit blok</small>
                                <textarea id="value" wire:model="value">
                                    {{$this->existingValue}}
                                </textarea>
                                @error('value')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button wire:click.prevent="updateBlock" class="btn btn-success btn-block">Updaten</button>
                            <button wire:click.prevent="cancel" class="btn btn-primary btn-block">Annuleren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @script
    <script>
        $('#value').summernote({
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
                @this.set('value', contents)
                }
            }
        });
        $("#value").on("summernote.enter", function (we, e) {
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
