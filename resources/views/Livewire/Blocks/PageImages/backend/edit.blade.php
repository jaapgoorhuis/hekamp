<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Afbeelding blok - bewerken</p>
                    <a class="close-card" href="" wire:click.prevent="cancel()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false">
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

                                    <button wire:click.prevent="updateTemplate(2)" class="btn btn-primary btn-block select-template-button" >Gebruik dit template</button>
                                </div>

                                <div  class="template_2 template">
                                    <label>Template 2:</label>
                                    <div class="row" style="margin-left: 0px;">
                                        <div class="template-column">
                                            Afbeelding 1
                                        </div>
                                    </div>

                                    <button wire:click.prevent="updateTemplate(1)" class="btn btn-primary btn-block select-template-button">Gebruik dit template</button>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        @if($this->showTemplateOption1)
                            <h5 class="form-section-title">Template 2: Afbeelding uploaden:</h5>
                            <div
                                x-data="{ isUploadingImageurl: true, progress: 0 }"
                                x-on:livewire-upload-start="isUploadingImageurl = true"
                                x-on:livewire-upload-finish="isUploadingImageurl = false"
                                x-on:livewire-upload-error="isUploadingImageurl = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <label for="header_image">Afbeelding:</label>
                                <input @if($image_url) disabled @endif type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url" wire:model="image_url">

                                <div
                                    class="bg-blue-500 h-[2px]"
                                    style="transition: width 1s"
                                    :style="`width: ${progress}%;`"
                                    x-show="isUploadingImageurl"
                                >
                                </div>

                                @if($this->image_url)
                                    <br/>
                                    <h5 class="form-section-title">Geuploade foto:</h5>
                                    <div class="project-upload-preview-container">
                                        <div class="project-upload-preview-box">
                                            <i wire:click="removeImageUrl()" class="fa-solid fa-trash"></i>
                                            @if(is_string($this->image_url))
                                                <img src="{{asset('storage/images/uploads/'.$this->image_url) }}"/>
                                            @else
                                                <img src="{{ $this->image_url->temporaryUrl() }}"/>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @error('image_url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if($this->showTemplateOption2)
                            <div class="row">
                                <h5 class="form-section-title">Template 1: Afbeeldingen uploaden:</h5>
                                <div class="col-md-6">
                                    <div
                                        x-data="{ isUploadingImageurl: true, progress: 0 }"
                                        x-on:livewire-upload-start="isUploadingImageurl = true"
                                        x-on:livewire-upload-finish="isUploadingImageurl = false"
                                        x-on:livewire-upload-error="isUploadingImageurl = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                                        <div class="form-group mb-3">
                                            <label for="image_url">Links afbeelding:</label>
                                            <input @if($this->image_url) disabled @endif type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url" wire:model="image_url">
                                            @error('image_url')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div
                                            class="bg-blue-500 h-[2px]"
                                            style="transition: width 1s"
                                            :style="`width: ${progress}%;`"
                                            x-show="isUploadingImageurl"
                                        >
                                        </div>

                                        @if($this->image_url)
                                            <br/>
                                            <h5 class="form-section-title">Geuploade foto:</h5>
                                            <div class="project-upload-preview-container">
                                                <div class="project-upload-preview-box">
                                                    <i wire:click="removeImageUrl()" class="fa-solid fa-trash"></i>
                                                    @if(is_string($this->image_url))
                                                        <img src="{{asset('storage/images/uploads/'.$this->image_url) }}"/>
                                                    @else
                                                        <img src="{{ $this->image_url->temporaryUrl() }}"/>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        x-data="{ isUploadingImageurl2: true, progress: 0 }"
                                        x-on:livewire-upload-start="isUploadingImageurl2 = true"
                                        x-on:livewire-upload-finish="isUploadingImageurl2 = false"
                                        x-on:livewire-upload-error="isUploadingImageurl2 = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                                        <div class="form-group mb-3">
                                            <label for="value">Upload afbeelding rechts:</label><br/>
                                            <input  @if($this->image_url2) disabled @endif class="form-control @error('image_url2') is-invalid @enderror" type="file" wire:model="image_url2">
                                            @error('image_url2')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div
                                            class="bg-blue-500 h-[2px]"
                                            style="transition: width 1s"
                                            :style="`width: ${progress}%;`"
                                            x-show="isUploadingImageurl2"
                                        >
                                        </div>

                                        @if($this->image_url2)
                                            <br/>
                                            <h5 class="form-section-title">Geuploade foto:</h5>
                                            <div class="project-upload-preview-container">
                                                <div class="project-upload-preview-box">
                                                    <i wire:click="removeImageUrl2()" class="fa-solid fa-trash"></i>
                                                    @if(is_string($this->image_url2))
                                                        <img src="{{asset('storage/images/uploads/'.$this->image_url2) }}"/>
                                                    @else
                                                        <img src="{{ $this->image_url2->temporaryUrl() }}"/>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        <br/>
                        <div class="d-grid gap-2">
                            <button wire:click.prevent="updateBlock" :disabled="buttonDisabled" class="btn btn-success btn-block">Opslaan</button>
                            <button wire:click.prevent="cancel" :disabled="buttonDisabled" class="btn btn-primary btn-block">Annuleren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

