@if($type == "image" )
    <div class="upload">      
        @foreach ($files as $image)
            @if($image->language == $alias)
                <div class="upload-thumb" data-label="{{$image->filename}}" style="background-image: url({{Storage::url($image->path)}})"></div>
            @endif
        @endforeach
        
        <div class="drop-zone">
            <span class="drop-zone__prompt">@lang('admin/upload.image')</span>
            <input  class="drop-zone__input" type="file" name="images[{{$content}}.{{$alias}}]">
        </div>
    </div>
@endif
