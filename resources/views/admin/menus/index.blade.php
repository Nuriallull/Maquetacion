@php
    $route = 'menus';
@endphp

@extends('admin.layout.table_form')

@section('table')

    @isset($menus)

        <div class="titulo-lang">
            <h1>
                @lang('admin/menus.parent_section')
            </h1>
        </div>

        <div id="table-container" class="table">

            <table>
                <tr>
                    <th>Nombre</th>
                </tr>
                @foreach($menus as $menu_element)
                    <tr>
                        <td>{{$menu_element->name}} </td>
                        
                        <td class="table-icons-container">
                            <div class="table-icons edit-button" data-url="{{route('menus_edit', ['menu' => $menu_element->id])}}">
                                <svg viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                            </div> 
                        
                            <div class="table-icons delete-button" data-url="{{route('menus_destroy', ['menu' => $menu_element->id])}}">
                                <svg class="table-icons" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                </svg>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @include('admin.components.table_pagination', ['items' => $menus])

    @endisset

@endsection

@section('form')

    @isset($menu)

        <div class="form-container">

            <form class="admin-form" id="menus-form" action="{{route("menus_store")}}" autocomplete="off">
                {{ csrf_field() }}

                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <input type="hidden" name="id" value="{{isset($menu->id) ? $menu->id : ''}}">
            
                <div class="form-header">
                    <div class="form-update">
                            <button id="update-button" class="update" data-url="{{route('menus_create')}}"> 
                                <svg class="button_text" style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M21,10.12H14.22L16.96,7.3C14.23,4.6 9.81,4.5 7.08,7.2C4.35,9.91 4.35,14.28 7.08,17C9.81,19.7 14.23,19.7 16.96,17C18.32,15.65 19,14.08 19,12.1H21C21,14.08 20.12,16.65 18.36,18.39C14.85,21.87 9.15,21.87 5.64,18.39C2.14,14.92 2.11,9.28 5.62,5.81C9.13,2.34 14.76,2.34 18.27,5.81L21,3V10.12M12.5,8V12.25L16,14.33L15.28,15.54L11,13V8H12.5Z" />
                                </svg>
                            </button>
                    </div>

                    <div class="switch-container">
                        <label class="switch"> 
                        <input type="checkbox">
                            <span class="slider"> </span>
                        </label>
                    </div>
                </div>  

                <div class="menu-form">
                    <ul>
                        <li class="menu-button" data-tab="contenido"> Contenido </li>
                        
                    </ul>
                
                </div>


                <div class="panel tab-active" data-tab="contenido">
                            
                    <div class=first-column>
                        <div class="form-group">
                            <div class="form-label">
                                <label for="name" class="label-highlight">Nombre</label>
                            </div>
                            <div class="form-input">
                                <input type="text" name="name" value="{{isset($menu->name) ? $menu->name : ''}}"  class="input-highlight"  />
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <div class="form-footer">        
            <div class="form-submit">
                <button id="send-button"> Enviar </button>
            </div>
        </div>

        @isset($menu->name)
        <div id="menu-item-form-container">
            @include('admin.menu_items.index', ['menu' => $menu])
        </div>
        @endisset
        

    @endisset

@endsection