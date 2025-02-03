<div wire:ignore>
    <div class="row justify-content-center mt-5" >
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p><a class="style-none" href="/auth/categories">{{$this->headCategory->title_nl}}</a> -> <a class="style-none" href="/auth/categories/{{$this->headCategory->id}}/subcategories">{{$this->subCategory->title_nl}}</a> -> Producten</p>
                    <div class="align-right"><a class="back-arrow" href="/auth/categories/{{$this->headCategory->id.'/subcategories'}}"><i class='bx bx-arrow-back'></i><span class="back-text">Terug</span></a></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if(Session::has('success'))
                            <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <a wire:click='create()' class="plus-icon">
                            <i class='bx bxs-file-plus plus-icon'></i>
                        </a>
                            @if(count($this->products))
                                <small><i class='bx bx-info-circle'></i> Klik op <i class="fa-solid fa-ellipsis-vertical"></i> houd vast en sleep naar de gewenste plek om de volgorde aan te passen</small>
                                <br/><br/>

                                <table class="table table-striped nowrap" style="width:100%">
                                    <thead >
                                    <tr>
                                        <th><i class="fa-solid fa-sort"></i></th>
                                        <th>Menu item</th>

                                        <th style="width: 100px">Bewerken</th>
                                        <th style="width: 100px">Verwijderen</th>
                                    </tr>
                                    </thead>
                                    <tbody wire:sortable="updateProductOrder">
                                    @foreach($this->products as $product)
                                        <tr wire:sortable.item="{{$product->id}}" wire:key="project_{{$product->id}}">
                                            <td wire:sortable.handle class="sort-item"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                                            <td>{!! $product->title_nl!!}</td>
                                            <td style="max-width: 60px;">
                                                <button wire:click="edit({{$product->id}})" class="btn btn-primary btn-sm">Bewerken</button>
                                            </td>
                                            <td style="max-width: 60px">
                                                <button wire:click="delete({{$product->id}})" class="btn btn-danger btn-sm">Verwijderen</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                Oeps! er zijn nog geen producten in deze categorie. Klik op  <i wire:click="create()" class='bx bxs-file-plus plus-icon'></i> om producten toe te voegen
                            @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
