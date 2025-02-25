<div wire:ignore>
    <div class="row justify-content-center mt-5" >
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Zoekwoorden</p>
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
                        <table class="table table-striped nowrap" style="width:100%">
                            <thead >
                            <tr>

                                <th style="width:200px;">Zoekwoord</th>
                                <th>Product</th>

                                <th style="width: 100px">Bewerken</th>
                                <th style="width: 100px">Verwijderen</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($this->search_items as $item)
                                <tr>

                                    <td>{!! $item->keyword_nl!!}</td>
                                    @if(\App\Models\Product::find( $item->product_id))
                                        <td>{!!\App\Models\Product::find( $item->product_id)->title_nl!!}</td>
                                    @else
                                        <td>Geen titel</td>
                                    @endif
                                    <td style="max-width: 60px;">
                                        <button wire:click="edit({{$item->id}})" class="btn btn-primary btn-sm">Bewerken</button>
                                    </td>
                                    <td style="max-width: 60px">
                                        <button wire:click="delete({{$item->id}})" class="btn btn-danger btn-sm">Verwijderen</button>
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
