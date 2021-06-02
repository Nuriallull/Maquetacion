<div class="faq">

    <div class="faq-title">
        <h3>{{isset($mueble->seo->title) ? $mueble->seo->title : ""}}</h3>
    </div>
    
    <div class="faq">
        <div class="faq-description">
            <div class="faq-description-text">
                {!!isset($mueble->locale['description']) ? $mueble->locale['description'] : "" !!}
            </div>

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
        </div>
    </div>
    
</div>
