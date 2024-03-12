<div wire:ignore>
    <div class="row justify-content-center mt-5" >
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p><a class="breadcrumb-item" href="/auth/pages">{{$this->page->title}}</a> > Pagina blokken </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if(Session::has('success'))
                            <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <a wire:click.defer='choosePageBlock()' class="plus-icon">
                            <i class='bx bxs-file-plus plus-icon'></i>
                        </a>

                        <table class="table table-striped nowrap" style="width:100%">
                            <thead >
                            <tr>
                                <th><i class="fa-solid fa-sort"></i></th>
                                <th>ID</th>
                                <th>Naam</th>

                                <th style="width: 100px">Bewerken</th>
                                <th style="width: 100px">Verwijderen</th>
                            </tr>
                            </thead>
                            <tbody wire:sortable="updateOrder">
                            @foreach($pageBlocks as $block)
                                <tr wire:sortable.item="{{$block->id}}" wire:key="block_{{$block->id}}">
                                    <td wire:sortable.handle class="sort-item"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                                    <td>{{$block->id}}</td>
                                    <td>{{$block->name}}</td>

                                    <td>
                                        <button wire:click="editPageBlock({{$block->id}})" class="btn btn-primary btn-sm">Bewerken</button>
                                    </td>
                                    <td>
                                        <button wire:click="deletePageBlock({{$block->id}})" class="btn btn-danger btn-sm">Verwijderen</button>
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
