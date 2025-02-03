<div wire:ignore>
    <div class="row justify-content-center mt-5" >
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Categorieën</p>
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

                        <small><i class='bx bx-info-circle'></i> Klik op <i class="fa-solid fa-ellipsis-vertical"></i> houd vast en sleep naar de gewenste plek om de volgorde aan te passen</small>
                        <br/>
                        <br/>

                        <table class="table table-striped nowrap" style="width:100%">
                            <thead >
                            <tr>
                                <th><i class="fa-solid fa-sort"></i></th>
                                <th style="width:250px">Naam</th>
                                <th >Actief op de website</th>
                                <th style="width: 150px">Sub categorieën</th>
                                <th style="width: 100px">Bewerken</th>
                                <th style="width: 100px">Verwijderen</th>
                            </tr>
                            </thead>
                            <tbody wire:sortable="updateOrder">
                            @foreach($this->categories as $categorie)
                                <tr wire:sortable.item="{{$categorie->id}}" wire:key="category_{{$categorie->id}}">
                                    <td wire:sortable.handle class="sort-item"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                                    <td>{{$categorie->title_nl}}</td>
                                    <td>
                                        @if($categorie->is_active == 1)
                                            Ja
                                        @else
                                            Nee
                                        @endif
                                    </td>
                                    <td style="max-width: 150px">
                                        <button wire:click="subCategories({{$categorie->id}})" class="btn btn-secondary btn-sm">Sub categorieën</button>
                                    </td>
                                    <td style="max-width: 60px;">
                                        <button wire:click="edit({{$categorie->id}})" class="btn btn-primary btn-sm">Bewerken</button>
                                    </td>
                                    <td style="max-width: 60px">
                                        <button wire:click="delete({{$categorie->id}})"  @if($categorie->is_removable == 0) disabled="disabled" @endif class="btn btn-danger btn-sm">Verwijderen</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
