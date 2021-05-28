<div class="faqs">

    <div class="faqs-title">
        <h3>@lang('front/faqs.title')</h3>
    </div>

    @foreach ($faqs as $faq)
        <div class="faq" data-content="{{$loop->iteration}}">
            <div class="faq-title-container">

                <div class="faq-title">
                    <h3>{{isset($faq->locale['title']) ? $faq->locale['title'] : ""}}</h3>
                </div>

                <div class="faq-plus-button" data-button="{{$loop->iteration}}"></div>
            </div>
            <div class="faq-description">
                <div class="faq-description-text">
                <p>  {!!isset($faq->locale['description']) ? $faq->locale['description'] : "" !!} </p>
                </div>

            

                <div class="faq-wrap-images">

                    @isset($faq->image_featured_desktop->path)
                        <div class="faq-description-image">
                            <img src="{{Storage::url($faq->image_featured_desktop->path)}}" alt="{{$faq->image_featured_desktop->alt}}" title="{{$faq->image_featured_desktop->title}}" />
                        </div>
                    @endif
                    
                    <div class="faq-grid-images">
                        @isset($faq->image_grid_desktop)
                            @foreach($faq->image_grid_desktop as $image)
                                <div class="faq-description-images">
                                    <img src="{{Storage::url($image->path)}}" />
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    @endforeach

</div>
