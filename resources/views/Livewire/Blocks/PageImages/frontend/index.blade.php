
<?php $blockContent = \Illuminate\Support\Facades\DB::table('image_block')->where('id', $blocks->block_value_id)->first()?>
    <div class="page-text" id="page-text-{{$blocks->id}}">
        @if($blockContent)
            @if($blockContent->template_option == '1')
            <img style="width: 100%;" src="{{asset('/storage/images/uploads/'.$blockContent->image_url)}}"/>
            @else
                <div class="row">
                    <div class="col-md-6">
                        <img style="width: 100%;" src="{{asset('/storage/images/uploads/'.$blockContent->image_url)}}"/>
                    </div>
                    <div class="col-md-6">
                        <img style="width: 100%;" src="{{asset('/storage/images/uploads/'.$blockContent->image_url2)}}"/>
                    </div>
                </div>
            @endif
        @endif
    </div>
