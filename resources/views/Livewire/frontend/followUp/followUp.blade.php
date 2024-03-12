<div>
    <div class="followup-content-box">
        <div class="followup-content">
            <div class="container">
                    <div class='row'>
                        <div class='column'>
                            <div class='left-box' id="content-box-1">
                                @if($this->blockName2 != '')
                                    @include('Livewire.Blocks.'.$this->blockName2[0]['block_name'].'.frontend.index', ['blocks' => $this->secondPageBlock])
                                @endif
                            </div>
                        </div>
                        <div class='column column-right'>
                            <div class='right-box'>
                                @if($this->blockName != '')
                                    @include('Livewire.Blocks.'.$this->blockName[0]['block_name'].'.frontend.index', ['blocks' => $this->firstPageBlock])
                                @endif
                            </div>
                        </div>
                    </div>
                <br/>
                @foreach($this->pageBlocks as $key => $blocks)
                    <?php $blockNames = \App\Models\Block::where('id', $blocks->block_id)->get();?>
                    <div class='row'>
                        <div class='double-column' >
                            <div class='orange-column'>
                                @include('Livewire.Blocks.'.$blockNames[0]['block_name'].'.frontend.index', ['blocks' => $blocks])
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
