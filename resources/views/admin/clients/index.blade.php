@extends('admin.layout.table_form')

@section('table')

    <table>
        <div class="titulo-lang"> 
            <h1>
            @lang('admin/clients.parent_section')
            </h1> 
        </div>    
        <tr>
			<th>Id</th>
			<th>Nombre</th>
            <th>Apellido</th>
			<th>Email</th>
        </tr>

        @foreach($clients as $client_element)
            <tr>
                <td>{{$client_element->id}}</td>
                <td>{{$client_element->name}}</td>
                <td>{{$client_element->surname}}</td>
                <td>{{$client_element->email}}</td>
                <td class="table-icons-container">
                    <div class="table-icons edit-button" data-url="{{route('clients_edit', ['client' => $client_element->id])}}">
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                        </svg>
                    </div> 
                   
                    <div class="table-icons delete-button" data-url="{{route('clients_destroy', ['client' => $client_element->id])}}">
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

   

    <div class="form-container">
        <form class="admin-form" id="admin-form" action="{{route("clients_store")}}" autocomplete="off">
            
            {{ csrf_field() }}

            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input type="hidden" name="id" value="{{isset($client->id) ? $client->id : ''}}">

        <div class=first-column>
            <div class="form-group">
                <div class="form-label">
                    <label for="name" class="label-highlight">Nombre</label>
                </div>
                <div class="form-input">
                    <input type="text" name="name" value="{{isset($client->name) ? $client->name : ''}}"  class="input-highlight">
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-label">
                    <label for="surname" class="label-highlight">Apellido</label>
                </div>
                <div class="form-input">
                    <input type="text" name="surname" value="{{isset($client->surname) ? $client->surname : ''}}"  class="input-highlight">
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label for="address" class="label-highlight">Dirección</label>
                </div>
                <div class="form-input">
                    <input type="text" name="address" value="{{isset($client->address) ? $client->address : ''}}"  class="input-highlight">
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label for="location" class="label-highlight">Población</label>
                </div>
                <div class="form-input">
                    <input type="text" name="location" value="{{isset($client->location) ? $client->location : ''}}"  class="input-highlight">
                </div>
            </div>
        </div>

        <div class="second-column">
            <div class="form-group">
                <div class="form-label">
                    <label for="country_id" class="label-highlight">País</label>
                </div>
                <div class="form-input">
                    <select name="country_id" class="input-highlight">
                        <option></option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}" {{$client->country_id == $country->id ? "selected" : ""}}>{{$country->name}}</option>
                        @endforeach
                    </select>       
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label for="zip" class="label-highlight">Código Postal</label>
                </div>
                <div class="form-input">
                    <input type="text" name="zip" value="{{isset($client->zip) ? $client->zip : ''}}"  class="input-highlight">
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label for="email" class="label-highlight">Email</label>
                </div>
                <div class="form-input">
                  	<input type="email" name="email" value="{{isset($client->email) ? $client->email : ''}}"  class="input-highlight"  />
              	</div>
          	</div>
			
			<div class="form-group">
                <div class="form-label">
                    <label for="password" class="label-highlight">Contraseña</label>
                </div>
                <div class="form-input">
                  <input type="password" name="password" id="password" onkeyup='check();' value="{{isset($client->password) ? $client->password : ''}}"  class="input-highlight"  />
                </div>
			</div>
        </div>

			</div>
        </form>
    </div>

    <div class="form-footer">        
        <div class="form-submit">
            <button id="send-button">Enviar</button>
        </div>
    </div>

@endsection
