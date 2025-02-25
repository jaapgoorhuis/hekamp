
<div class="page-image-box">
<?php $blockContent = \App\Models\ImageBlock::where('id', $blocks->block_value_id)->first()?>
        @if($this->authUser)
            <a wire:click="editBlockImage({{$blocks->block_value_id}})" class="edit-blok-text" ><i class='bx bxs-edit'></i></a>
        @endif
        @if($this->showImageEditBox)

            <form>
                <div class="block-edit-form form-section">
                    <div class="form-group mb-3" >
                        <x-filepond::upload
                            multiple="true"
                            wire:model="files"

                        />
                    </div>
                </div>
            </form>
        @else

            @if($blockContent)
                @if($blockContent->template_option == '1')
                    <?php $media = $blockContent->getMedia('image_block');?>

                <img style="width: 100%;" src="{{$media[0]->getFullUrl()}}"/>
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
        @endif
</div>
