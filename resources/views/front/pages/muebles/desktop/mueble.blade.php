<div class="faq">

    <div class="faq-title">
        <h3>{{isset($mueble->seo->title) ? $mueble->seo->title : ""}}</h3>
    </div>
    
    <div class="faq">
        <div class="faq-description-single">
            @include("front.components.desktop.slider")
            @include("front.components.desktop.description")
        </div>
    </div>

    @include("front.components.desktop.cartbutton")
    
</div>
