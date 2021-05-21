@if($type == "image" )

        @foreach ($files as $image)
            @if($image->language == $alias)
            <div class="upload-image single" data-image-id="{{$image->id}}" data-url="{{route('show_image_seo', ['image' => $image->id])}}">
                
                <div class="upload-image-options">
                    <svg viewBox="0 0 24 24">
                        <path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z" />
                    </svg>
                </div>

                <div class="upload-thumb" style="background-image: url({{Storage::url($image->path)}})"></div>
            
            </div>
            @endif
        @endforeach
    

        @if($files->count() == 0)
        
            <div class="upload-image-add single" data-entity="{{$entity}}" data-content="{{$content}}" data-alias="{{$alias}}">
                <span class="drop-zone__prompt">@lang('admin/upload.image')</span>
                <input  class="drop-zone__input" type="file" name="images[{{$content}}.{{$alias}}]">
            </div>
        @endif

@endif


@if($type == "images")


        <div class="upload-multiple" id="multiple-element"> 
            
            <div class="upload-image-add multiple" data-content="{{$content}}" data-alias="{{$alias}}">
                <span class="drop-zone__prompt">@lang('admin/upload.images')</span>
                <input class="drop-zone__input" type="file">
            </div>

            @foreach ($files as $image)
                @if($image->language == $alias)
                    <div class="upload-image multiple {{$image->id}}" data-url="{{route('show_image_seo', ['image' => $image->id])}}">
                            <div class="upload-image-options">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z" />
                                </svg>
                            </div>
                        <div class="upload-thumb multiple" style="background-image: url({{Storage::url($image->path)}})"></div>
                    </div>
                @endif
            @endforeach
        

        </div>

@endif


