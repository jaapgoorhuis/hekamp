
<?php $blockContent = \Illuminate\Support\Facades\DB::table('text_block')->where('id', $blocks->block_value_id)->first()?>

    <div class="page-text" id="page-text-{{$blocks->block_value_id}}">

        @if($this->authUser)
            <a wire:click="editBlockText({{$blocks->block_value_id}})" class="edit-blok-text" ><i class='bx bxs-edit'></i></a>
        @endif

        @if($this->showEditBox)
            <div class="edit-box" id="editBox_{{$blocks->block_value_id}}">
                <ul class="nav2 nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nl-tab" data-bs-toggle="tab" data-bs-target="#nl-text-tab-pane" type="button" role="tab" aria-controls="nl-text-tab-pane" aria-selected="true">NL</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="de-tab" data-bs-toggle="tab" data-bs-target="#de-text-tab-pane" type="button" role="tab" aria-controls="de-text-tab-pane" aria-selected="false">DE</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-text-tab-pane" type="button" role="tab" aria-controls="en-text-tab-pane" aria-selected="false">EN</button>
                    </li>

                </ul>
                <form wire:key="{{$blocks->block_value_id}}">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="nl-text-tab-pane" role="tabpanel" aria-labelledby="nl-text-tab" tabindex="0">
                            <div >
                                <div class="form-group mb-3" >
                                    <label for="block_text_nl">NL - Tekst:</label><br/>
                                    <div>
                                        <livewire:quill-text-editor
                                            wire:model="block_text_nl"
                                            theme="snow" />
                                    </div>
                                    @error('block_text_nl')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="de-text-tab-pane" role="tabpanel" aria-labelledby="de-text-tab" tabindex="0">
                            <div >
                                <div class="form-group mb-3" >
                                    <label for="block_text_de">DE - Tekst</label><br/>
                                    <div >
                                        <livewire:quill-text-editor
                                            wire:model="block_text_de"
                                            theme="snow" />

                                    </div>
                                    @error('block_text_de')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="en-text-tab-pane" role="tabpanel" aria-labelledby="en-text-tab" tabindex="0">
                            <div >
                                <div class="form-group mb-3" >
                                    <label for="block_text_en">EN - Tekst</label><br/>
                                    <livewire:quill-text-editor
                                        wire:model="block_text_en"
                                        theme="snow" />
                                    @error('block_text_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <button wire:click.prevent="updateBlokText({{$blocks->block_value_id}})" data-bs-dismiss="modal"  class="btn btn-primary">Opslaan</button>
                </form>
            </div>
            @endif
            @if($this->showEditBox == false)
            <div id="showTextBlock_{{$blocks->block_value_id}}">
                @if($blockContent)
                    <?php $var = 'value_'.\Illuminate\Support\Facades\App::getLocale()?>
                    {!! $blockContent->$var !!}
                @endif
            </div>
            @endif

    </div>


