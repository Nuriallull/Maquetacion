@extends('admin.layout.table_form')

@section('table')

    <table>
        <div class="titulo-lang">
            <h1>
            @lang('admin/users.parent_section')
            </h1>
        </div>        
        <tr>
			<th>Id</th>
			<th>Usuario</th>
			<th>Email</th>
        </tr>

        @foreach($users as $user_element)
            <tr>
                <td>{{$user_element->id}}</td>
                <td>{{$user_element->name}}</td>
                <td>{{$user_element->email}}</td>
                <td class="table-icons-container">
                    <div class="table-icons edit-button" data-url="{{route('users_edit', ['user' => $user_element->id])}}">
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                        </svg>
                    </div> 
                   
                    <div class="table-icons delete-button" data-url="{{route('users_destroy', ['user' => $user_element->id])}}">
                        <svg class="table-icons" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                        </svg>
                    </div>
                </td>
            </tr>
        @endforeach
        
    </table>

@endsection

@section('form')

    
    @include('admin.components.errors')

    <div class="form-container">

        <form class="admin-form" id="user-form" action="{{route("users_store")}}" autocomplete="off">
            
            {{ csrf_field() }}

            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input type="hidden" name="id" value="{{isset($user->id) ? $user->id : ''}}">
             <div id="menu-container">
                <div class="menu-form">
                    <ul>
                        <li class="menu-button" data-tab="info"> Información </li>
                        <li class="menu-button" data-tab="imagenes"> Imágenes </li>
                        <li class="menu-button" data-tab="herramientas"> Herramientas </li>
                    </ul>
                </div>
            </div>
        <div class="panel" data-tab="info">
            <div class="form-group">
                <div class="form-label">
                    <label for="name" class="label-highlight">Nombre de Usuario</label>
                </div>
                <div class="form-input">
                    <input type="text" name="name" value="{{isset($user->name) ? $user->name : ''}}"  class="input-highlight">
                </div>
            </div>
        </div>
        
        <div class="panel" data-tab="imagenes">
            <div class="form-group">
                <div class="form-label">
                    <label for="email" class="label-highlight">Email</label>
                </div>
                <div class="form-input">
                  	<input type="email" name="email" value="{{isset($user->email) ? $user->email : ''}}"  class="input-highlight"  />
              	</div>
          	</div>
        </div>
		
        <div class="panel" data-tab="herramientas">
			<div class="form-group">
                <div class="form-label">
                    <label for="password" class="label-highlight">Contraseña</label>
                </div>
                <div class="form-input">
                  <input type="password" name="password" id="password" onkeyup='check();' value="{{isset($user->password) ? $user->password : ''}}"  class="input-highlight"  />
                </div>
			</div>

			<div class="form-group">
                <div class="form-label">
                	<label for="password" class="label-highlight">Confirmar Contraseña</label>
              	</div>
            	<div class="form-input">
                	<input type="password" name="password_confirmation" id="confirm_password" onkeyup='check();' value="{{isset($user->password) ? $user->password : ''}}"  class="input-highlight"  />
					<label id="message"></label>
				</div>
			</div>
        <div>
        </form>
    </div>

    <div class="form-footer">        
        <div class="form-submit">
            <button id="send-button">Enviar</button>
        </div>
    </div>

@endsection
