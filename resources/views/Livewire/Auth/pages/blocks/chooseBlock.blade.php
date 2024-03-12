<div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Blok aanmaken -> stap 1</p>
                    <a class="close-card" href="" wire:click.prevent="cancel()"><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="card-body">
                    <form>
                        <h5 class="form-section-title">Type blok selecteren:</h5>

                        <div class="form-section">
                            <div class="form-group mb-3">
                                <label for="block_id">Welk blok wil je gebruiken?</label><br/>
                                <small class="sub-label-admin">Je kunt kiezen uit de volgende blokken om toe te voegen aan de pagina</small>
                                <select wire:model="block_id" class="form-control">
                                    @foreach($this->blocks as $block)
                                        <option value="{{$block->id}}">{{$block->block_name}}</option>>
                                    @endforeach
                                </select>
                                @error('block_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Geef het blok een naam</label><br/>
                                <small class="sub-label-admin">Geef het blok een naam die duidelijk maakt welk blok dit op je pagina is.</small>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" wire:model="name"/>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button wire:click.prevent="storePageBlockChoise()" class="btn btn-success btn-block">Volgende</button>
                            <button wire:click.prevent="cancel()" class="btn btn-primary btn-block">Annuleren</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
