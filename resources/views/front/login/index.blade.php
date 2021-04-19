@extends('front.layout.table_form')


@section('form')

<div class="login-errors">
    @include('front.components.desktop.errors')
</div>    

    <div class="form-login">
        <form class="login-form" method="POST" action="{{route("front_login_submit")}}">
            
            {{ csrf_field() }}
        
            <div class="form-content">
                    <h1> Log In </h1>
                <div class="login-form-group">
                    <div class="form-label">
                        <label for="email" class="label-highlight">Email</label>
                    </div>
                </div>
                    <div class="form-input">
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email">
                    </div>
                
                <div class="login-form-group">
                    <div class="form-label">
                        <label for="password" class="label-highlight">Contraseña</label>
                    </div>
                    <div class="form-input">
                    <input type="password" name="password" id="password" class="input-highlight">
                    </div>
                </div>
            </div>
            <div class="form-submit">
                    <button type="submit">
                        Enviar
                    </button>
            </div>
        </form>
    
    </div>
  

@endsection
