<div class="faq-specifications">
                
    
    <div class="faq-description-text">

        <div class="nombre">
            <h3>{{isset($mueble->name) ? $mueble->name : ""}}</h3>
        </div>

        <div class="description-container active">

            <div class="container">
                <div class="descripcion-producto"><p> Descripción del producto </p> </div>
                <div class="plus-button">
                    <svg viewBox="0 0 24 24">
                        <path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                    </svg> 
                </div>
            </div>

            <div class="descripcion">
                {!!isset($mueble->locale['description']) ? $mueble->locale['description'] : "" !!}
            </div>
            
        </div>

        <div class="precio-total">
            <h3>{!!isset($mueble->product['total_price']) ? $mueble->product['total_price'] : "" !!} €</h3>
        </div>

        <div class="precio-oferta">
            <h3>{!!isset($mueble->product['offer_price']) ? $mueble->product['offer_price'] : "" !!} €</h3>
        </div>

    </div>
    

    <div class="buttons-wrap">


        <div class="quantity-wrap">
            <div class="quantity">
                <button class="btn minus-btn disabled" type="button"> - </button>
                    <input type="text" id="quantity" value="1">
                <button class="btn plus-btn" type="button"> + </button>
            </div>
        </div>

        <div class="cart-button">
            <button id="send-button" class="add-to-cart"> 
                <svg viewBox="0 0 24 24">
                    <path fill="currentColor" d="M17,18C15.89,18 15,18.89 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20C19,18.89 18.1,18 17,18M1,2V4H3L6.6,11.59L5.24,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42A0.25,0.25 0 0,1 7.17,14.75C7.17,14.7 7.18,14.66 7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.58 17.3,11.97L20.88,5.5C20.95,5.34 21,5.17 21,5A1,1 0 0,0 20,4H5.21L4.27,2M7,18C5.89,18 5,18.89 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20C9,18.89 8.1,18 7,18Z" />
                </svg>
                    <p> Añadir al carrito </p>
            </button>
        </div>

        <div class="buy-button">
            <button id="send-button"> 
                <svg viewBox="0 0 24 24">
                    <path fill="currentColor" d="M5.5,21C4.72,21 4.04,20.55 3.71,19.9V19.9L1.1,10.44L1,10A1,1 0 0,1 2,9H6.58L11.18,2.43C11.36,2.17 11.66,2 12,2C12.34,2 12.65,2.17 12.83,2.44L17.42,9H22A1,1 0 0,1 23,10L22.96,10.29L20.29,19.9C19.96,20.55 19.28,21 18.5,21H5.5M12,4.74L9,9H15L12,4.74M12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17A2,2 0 0,0 14,15A2,2 0 0,0 12,13Z" />
                </svg>
                    <p> Comprar ahora </p>
            </button>
        </div>

        <div class="dispo-button">
            <button id="send-button">
                <svg viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z" />
                </svg>
                    <p> Disponibilidad en tienda </p>
            </button>
        </div>

    </div>
</div>