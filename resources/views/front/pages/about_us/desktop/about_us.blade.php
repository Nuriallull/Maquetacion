<div class="about-us">

    <div class="two-columns">
        <div class="about-us-title">
            <h3>@lang('front/about_us.ourbusiness-title')</h3>
        </div>
        
        <div class="about-us-element">
            <div class="about-us-text">
                @lang('front/information.ourbusiness')
            </div>
        </div>

        <div class="about-us-element">
            <div class="about-us-image">
                @if($agent->isDesktop())
                    <img src="{{Storage::url($business->image_our_business_desktop->path)}}" alt="{{$business->image_our_business_desktop->alt}}" title="{{$business->image_our_business_desktop->title}}">
                @endif
            
                @if($agent->isMobile())
                    <img src="{{Storage::url($business->image_our_business_mobile->path)}}" alt="{{$business->image_our_business_mobile->alt}}" title="{{$business->image_our_business_mobile->title}}">
                @endif
            </div>

            <div class="mapa">  
                <h3>¿Dónde estamos?</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3074.6228142241657!2d2.648716715584677!3d39.59065041338637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x129792fad5509d8d%3A0xbafacca5fb207696!2sCarrer%20de%20Miquel%20Capllonch%2C%20Palma%2C%20Illes%20Balears!5e0!3m2!1ses!2ses!4v1623065249450!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

    </div>
    
</div>
