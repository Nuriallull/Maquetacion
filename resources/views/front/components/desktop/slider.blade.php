<div class="faq-wrap-images">

    @isset($mueble->image_featured_desktop->path)
        <div class="faq-description-image">
            <img src="{{Storage::url($mueble->image_featured_desktop->path)}}" alt="{{$mueble->image_featured_desktop->alt}}" title="{{$mueble->image_featured_desktop->title}}" />
        </div>
    @endif


    
    <div class="faq-grid-images">
        @isset($mueble->image_grid_desktop)
            @foreach($mueble->image_grid_desktop as $image)
                <div class="faq-description-images">
                    <img src="{{Storage::url($image->path)}}" />
                </div>
            @endforeach
        @endif
    </div>
</div>