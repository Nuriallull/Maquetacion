<div class="mueble-wrap-images">

    @isset($mueble->image_featured_desktop->path)
        <div class="mueble-description-image">
            <img src="{{Storage::url($mueble->image_featured_desktop->path)}}" alt="{{$mueble->image_featured_desktop->alt}}" title="{{$mueble->image_featured_desktop->title}}" />
        </div>
    @endif


    
    <div class="mueble-grid-images">
        @isset($mueble->image_grid_desktop)
            @foreach($mueble->image_grid_desktop as $image)
                <div class="mueble-description-images">
                    <img src="{{Storage::url($image->path)}}" />
                </div>
            @endforeach
        @endif
    </div>
</div>