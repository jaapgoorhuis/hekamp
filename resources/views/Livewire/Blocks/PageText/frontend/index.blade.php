
<?php $blockContent = \Illuminate\Support\Facades\DB::table('text_block')->where('id', $blocks->block_value_id)->first()?>
    <div class="page-text" id="page-text-{{$blocks->id}}">
        @if($blockContent)
        {!! $blockContent->value !!}
        @endif
    </div>
