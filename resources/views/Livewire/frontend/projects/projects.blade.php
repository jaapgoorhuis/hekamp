<div>
    @foreach($this->pageBlocks as $key => $blocks)
        <?php $blockNames = \App\Models\Block::where('id', $blocks->block_id)->get();?>
        @include('Livewire.Blocks.'.$blockNames[0]['block_name'].'.frontend.index', ['blocks' => $blocks])
    @endforeach
</div>
