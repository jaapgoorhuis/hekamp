<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            @if(Session::has('success'))
                <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Downloads</p>
                    <a class="close-card" href="" wire:click="cancelPage()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form  x-data="{ buttonDisabled: false}" x-on:livewire-upload-start="buttonDisabled = true" x-on:livewire-upload-finish="buttonDisabled = false" >
                        <h5 class="form-section-title">Downloads:</h5>
                        <small>Deze downloads komen onderin de footer op de pagina te staan</small><br/>
                        <small>Afbeeldingen, videos en PDF bestanden zijn toegestaan</small>
                        <br/>
                        <div class="form-section">
                            <x-filepond::upload
                                multiple="true"
                                wire:model="files"

                            />
                        </div>

                        @if(count($this->existingFiles))
                            <hr class="rounded">
                            <h5 class="form-section-title">Downloads:</h5>
                            <small>De volgorde van de downloads zijn aan te passen door ze op volgorde te slepen. </small>
                            <br/>
                            <br/>
                            <br/>
                            <div class="accordion" id="accordionExample">
                                <ul style="list-style: none; padding:0px" wire:sortable="updateImageOrder" >
                                    @foreach($this->existingFiles as $items)
                                        <li wire:sortable.item="{{$items->id}}" wire:key="items_{{$items->id}}" wire:sortable.handle>
                                            <div class="flex-grid">
                                                <div class="col sorting-col">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </div>
                                                <div class="col accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree_{{$items->id}}" aria-expanded="false" aria-controls="collapseThree">
                                                            @if(str_contains($items->mime_type,'image'))
                                                            <img src="{!! $items['original_url'] !!}" style="width:150px;"/>
                                                            @else
                                                                {{$items->friendly_name}}
                                                            @endif
                                                        </button>
                                                    </h2>
                                                    <div wire:ignore>
                                                        <div id="collapseThree_{{$items->id}}" style="width:100%;" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="form-section">
                                                                    <div class="form-group mb-3">
                                                                        <label for="friendly_name">Bestandsnaam:</label>

                                                                        <input type="text" class="form-control @error('friendly_name')is-invalid @enderror" value="{{$items->friendly_name}}"  wire:keyup="updateFileName({{$items['id']}},{{'$event.target.value'}})"  id="friendly_name">

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
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
