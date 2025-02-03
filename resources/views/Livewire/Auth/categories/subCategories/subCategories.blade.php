<div wire:ignore>
    <div class="row justify-content-center mt-5" >
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p><a class="style-none" href="/auth/categories">{{$this->headCategory->title_nl}}</a> -> Sub categorieën</p>
                    <div class="align-right"><a class="back-arrow" href="/auth/categories"><i class='bx bx-arrow-back'></i></a><span class="back-text">Terug</span></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if(Session::has('success'))
                            <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(count($this->subcategories))
                            <a wire:click='create()' class="plus-icon">
                                <i class='bx bxs-file-plus plus-icon'></i>
                            </a>

                            <small><i class='bx bx-info-circle'></i> Klik op <i class="fa-solid fa-ellipsis-vertical"></i> houd vast en sleep naar de gewenste plek om de volgorde aan te passen</small>
                            <br/>
                            <br/>
                                <table class="table table-striped nowrap" style="width:100%">
                                <thead >
                                <tr>
                                    <th><i class="fa-solid fa-sort"></i></th>
                                    <th style="width:200px">Subcategorieën:</th>
                                    <th style="width:200px;">Actief op homepagina:</th>
                                    <th>Actief op website:</th>
                                    <th style="width: 100px">Producten</th>
                                    <th style="width: 100px">Bewerken</th>
                                    <th style="width: 100px">Verwijderen</th>
                                </tr>
                                </thead>
                                <tbody wire:sortable="updateOrder">
                                @foreach($this->subcategories as $subcategory)
                                    <tr wire:sortable.item="{{$subcategory->id}}" wire:key="category_{{$subcategory->id}}">
                                        <td wire:sortable.handle class="sort-item"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                                        <td>{{$subcategory->title_nl}}</td>
                                        <td>
                                            @if($subcategory->show_home == 1)
                                                Ja
                                            @else
                                                Nee
                                            @endif
                                        </td>
                                        <td>
                                            @if($subcategory->is_active == 1)
                                                Ja
                                            @else
                                                Nee
                                            @endif
                                        </td>
                                        <td style="max-width: 60px;">
                                            <button wire:click="products({{$subcategory->id}})" class="btn btn-secondary btn-sm">Producten</button>
                                        </td>
                                        <td style="max-width: 60px;">
                                            <button wire:click="edit({{$subcategory->id}})" class="btn btn-primary btn-sm">Bewerken</button>
                                        </td>
                                        <td style="max-width: 60px">
                                            <button wire:click="delete({{$subcategory->id}})"  @if($subcategory->is_removable == 0) disabled="disabled" @endif class="btn btn-danger btn-sm">Verwijderen</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                Oeps! er zijn nog geen subcategorieën in deze categorie. Klik op  <i wire:click="create()" class='bx bxs-file-plus plus-icon'></i> om producten toe te voegen
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
