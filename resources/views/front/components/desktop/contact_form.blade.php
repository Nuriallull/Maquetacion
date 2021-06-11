<div class="form">

    <form id="form" method="POST" action="{{route('front_contact_form')}}">

        {{ csrf_field() }}
    

        <div class="first-column">
            <div class="form-group">
                <div class="label">
                    <label for="email" class="contact-label">Email</label>
                </div>
                <div class="input">
                    <input type="email" class="contact-input" value="" name="email">
                </div>
            </div>
        </div>
        
        <div class="second-column">
            <div class="form-group">
                <div class="label">
                    <label for="name" class="contact-label">Nombre</label>
                </div>
                <div class="input">
                    <input type="name" class="contact-input" name="name">
                </div>
            </div>
        </div>
    
        <div class="form-group">
            <div class="label">
                <label for="message" class="contact-label">Mensaje</label>
            </div>
            <div class="input">
                <textarea class="contact-input" name="message"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="input-privacy">
                <input type="checkbox" id="privacy" name="privacy">
                <label for="privacy">He leído y acepto la información básica sobre protección de datos.</label>
            </div>
        </div>
        
        <div class="form-errors">
            @include('front.components.desktop.form_errors')
        </div>  
        
        <div class="form-success">
            @include('front.components.desktop.form_success')
        </div>  
        
        <div class="form-group form-submit">
            <button type="send-button">
                @lang('front/contact.send')
            </button>
        </div>
    </form>
 
</div>
