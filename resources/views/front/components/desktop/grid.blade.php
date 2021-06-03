
@foreach ($muebles as $mueble)
    
    <div class="faq" data-content="{{$loop->iteration}}">
        <div class="faq-title-container">
            <div class="faq-title">
                <h3>{{isset($mueble->locale['title']) ? $mueble->locale['title'] : ""}}</h3>
            </div>
            <div class="faq-plus-button" data-button="{{$loop->iteration}}"></div>
        </div>

        <div class="faq-wrap-images">
            @isset($mueble->image_featured_desktop->path)
                <div class="faq-description-images-collection">
                    <img src="{{Storage::url($mueble->image_featured_desktop->path)}}" alt="{{$mueble->image_featured_desktop->alt}}" title="{{$mueble->image_featured_desktop->title}}" />
                       
                    <div class="iconos-imagen">
                        <div class="icono-corazon">
                            <svg viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 18C12 19 12.25 19.92 12.67 20.74L12 21.35L10.55 20.03C5.4 15.36 2 12.27 2 8.5C2 5.41 4.42 3 7.5 3C9.24 3 10.91 3.81 12 5.08C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.41 22 8.5C22 9.93 21.5 11.26 20.62 12.61C19.83 12.23 18.94 12 18 12C14.69 12 12 14.69 12 18M19 14H17V17H14V19H17V22H19V19H22V17H19V14Z" />
                            </svg>
                        </div>
        
                        <div class="icono-carrito">
                            <svg viewBox="0 0 24 24">
                                <path fill="currentColor" d="M17,18C15.89,18 15,18.89 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20C19,18.89 18.1,18 17,18M1,2V4H3L6.6,11.59L5.24,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42A0.25,0.25 0 0,1 7.17,14.75C7.17,14.7 7.18,14.66 7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.58 17.3,11.97L20.88,5.5C20.95,5.34 21,5.17 21,5A1,1 0 0,0 20,4H5.21L4.27,2M7,18C5.89,18 5,18.89 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20C9,18.89 8.1,18 7,18Z" />
                            </svg>
                        </div>
                    </div>
                    
                </div>
            @endif    

           
        
            
        </div>
        
        <div class="information-grid">

            <div class="nombre-collection">
                <h3>{{isset($mueble->name) ? $mueble->name : ""}}</h3>
            </div>

            <div class="precio-total-collection">
                <h3>{!!isset($mueble->product['total_price']) ? $mueble->product['total_price'] : "" !!} €</h3>
            </div>


        </div>
        
    </div>
    
@endforeach

@include("front.components.desktop.cartbutton")
