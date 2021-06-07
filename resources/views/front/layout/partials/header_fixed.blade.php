<header class="header-fixed fixed">

    <div class="header-container">
        <div class="header-logo">
            @isset($business->images_logo_preview->path)
                <img src="{{Storage::url($business->images_logo_preview->path)}}" alt="{{$logo->alt}}" title="{{$logo->title}}">
            @endisset
        </div>
    
        <div class="header-menu">

            {{display_menu('principal','horizontal')}}

        </div>
    </div>

</header>

<div class="header-checkpoint"></div>
