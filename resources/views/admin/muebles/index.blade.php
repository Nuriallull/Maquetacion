@php
    $route = 'muebles';
    $filters = ['category' => $muebles_categories, 'search' => true, 'created_at' => true]; 
    $order  = ['Nombre' => 'name', 'Fecha' => 't_muebles.created_at', 'Categoria' => 't_muebles_categorias.name'];
@endphp

@extends('admin.layout.table_form')


@section('table')   

    @isset($muebles)
        @if($agent->isMobile())

            <div class="titulo-lang">
                <h1>
                    @lang('admin/muebles.parent_section')
                </h1>
            </div>

            <div id="table-container" class="table">   

                @foreach($muebles as $mueble_element)
                    <div class="table-row swipe-element">
                        <div class="table-field-container swipe-front">
                            <div class="table-field"> <p><span>Título:</span>  {{$mueble_element->name}} </p></div> 
                            <div class="table-field"> <p><span>Categoría:</span> {{$mueble_element->category->name}} </p></div> 
                            <div class="table-field"> <p><span>Creado en:</span> {{ Carbon\Carbon::parse($mueble_element->created_at)->format('d-m-Y') }} </p></div>
                        </div>
                        <div class="table-icons-container swipe-back">
                            <div class="table-icons edit-button right-swipe" data-url="{{route('muebles_edit', ['mueble' => $mueble_element->id])}}">
                                <svg viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                            </div> 
                            
                            <div class="table-icons delete-button left-swipe" data-url="{{route('muebles_destroy', ['mueble' => $mueble_element->id])}}">
                                <svg class="table-icons delete-button left-swipe" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>

        @endif

        @if($agent->isDesktop())

            <table>    
                <div class="titulo-lang">
                    <h1>
                    @lang('admin/muebles.parent_section')
                    </h1>
                </div>        
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Fecha de creación</th>
                    <th></th>
                </tr>

                @foreach($muebles as $mueble_element)
                    <tr>
                        <td>{{$mueble_element->name}}</td>
                        <td>{{$mueble_element->category->name}}</td>
                        <td>{{ Carbon\Carbon::parse($mueble_element->created_at)->format('d-m-Y') }}</td>
                        <td class="table-icons-container">
                            <div class="table-icons edit-button" data-url="{{route('muebles_edit', ['mueble' => $mueble_element->id])}}">
                                <svg viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                            </div> 
                        
                            <div class="table-icons delete-button" data-url="{{route('muebles_destroy', ['mueble' => $mueble_element->id])}}">
                                <svg class="table-icons" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                </svg>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            

            @include('admin.components.table_pagination', ['items' => $muebles])   
            

        @endif
        
    @endisset

@endsection

@section('form')

    @isset($mueble)
    
        
        <div class="form-container">

            <form class="admin-form" id="muebles-form" action="{{route("muebles_store")}}" autocomplete="off">
                {{ csrf_field() }}

                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <input type="hidden" name="id" value="{{isset($mueble->id) ? $mueble->id : ''}}">
            
                <div class="form-header">
                    <div class="form-update">
                            <button id="update-button" class="update" data-url="{{route('muebles_create')}}"> 
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
                        <li class="menu-button" data-tab="imagenes"> Imágenes </li>
                        <li class="menu-button" data-tab="seo"> SEO </li>
                        <li class="menu-button" data-tab="product"> Producto </li>
                    </ul>
                
                </div>


                <div class="panel tab-active" data-tab="contenido">
                            
                    <div class=first-column>
                        <div class="form-group">
                            <div class="form-label">
                                <label for="name" class="label-highlight">Nombre</label>
                            </div>
                            <div class="form-input">
                                <input type="text" name="name" value="{{isset($mueble->name) ? $mueble->name : ''}}"  class="input-highlight"  />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label for="mueble_categoria_id" class="label-highlight">
                                    Categoría 
                                </label>
                            </div>
                            <div class="form-input">
                                <select name="mueble_categoria_id" data-placeholder="Seleccione una categoría" class="input-highlight">
                                    <option></option>
                                    @foreach($muebles_categories as $muebles_category)
                                        <option value="{{$muebles_category->id}}" {{$mueble->mueble_categoria_id == $muebles_category->id ? 'selected':''}} class="category_id">{{ $muebles_category->name }}</option>
                                    @endforeach
                                </select>  
                            </div>                  
                        </div>
                    </div>

                    <div class="second-column">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="color_id" class="label-highlight">Color</label>
                            </div>
                            <div class="form-input">
                                <select name="color_id" class="input-highlight">
                                    <option></option>
                                    @foreach ($colors as $color)
                                        <option value="{{$color->id}}" {{$mueble->color_id == $color->id ? "selected" : ""}}>{{$color->name}}</option>
                                    @endforeach
                                </select>       
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label for="tamaño_id" class="label-highlight"> Tamaño </label>
                            </div>
                            <div class="form-input">
                                <select name="tamaño_id" class="input-highlight">
                                    <option></option>
                                    @foreach ($tamaños as $tamaño)
                                        <option value="{{$tamaño->id}}" {{$mueble->tamaño_id == $tamaño->id ? "selected" : ""}}>{{$tamaño->dimensions}}</option>
                                    @endforeach
                                </select>       
                            </div>
                        </div>
                    </div>

                    @component('admin.components.locale', ['tab' => 'content'])

                        @foreach ($localizations as $localization)

                            <div class="subpanel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="content" data-localetab="{{$localization->alias}}">

                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="title" class="label-highlight">
                                            Titulo
                                        </label>
                                    </div>
        
                                    <div class="form-input">
                                        <input type="text" name="seo[title.{{$localization->alias}}]" value="{{isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : ''}}" class="input-highlight"> 
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="description" class="label-highlight">
                                            Descripcion
                                        </label>
                                    </div>
        
                                    <div class="form-input">
                                        <textarea class="ckeditor input-highlight" name="locale[description.{{$localization->alias}}]">{{isset($locale["description.$localization->alias"]) ? $locale["description.$localization->alias"] : ''}}</textarea>
                                    </div>
                                </div>
            
                            
                            </div>
                        @endforeach
                        
                    @endcomponent
                        
                </div>

                <div class="panel" data-tab="imagenes">

                    @component('admin.components.locale', ['tab' => 'imagenes'])

                        @foreach ($localizations as $localization)
                                
                            <div class="subpanel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="imagenes" data-localetab="{{$localization->alias}}">
                                
                               
                                @include('admin.components.upload', [
                                    'entity' => 'muebles',
                                    'type' => 'image', 
                                    'content' => 'featured', 
                                    'alias' => $localization->alias,
                                    'files' => $mueble->images_featured_preview
                                ])
                            
                                <p> Selección múltiple </p>
                            
                                @include('admin.components.upload', [
                                    'entity' => 'muebles',
                                    'type' => 'images', 
                                    'content' => 'grid', 
                                    'alias' => $localization->alias,
                                    'files' => $mueble->images_grid_preview
                                ])
                                   
                            </div> 

                        @endforeach
                        
                    @endcomponent
                
                </div>
                
                <div class="panel" data-tab="seo">

                    @component('admin.components.locale', ['tab' => 'seo'])

                        @foreach ($localizations as $localization)
                                
                            <div class="subpanel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="seo" data-localetab="{{$localization->alias}}">
                                
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="keywords" class="label-highlight">
                                            Keywords
                                        </label>
                                    </div>
        
                                    <div class="form-input">
                                        <input type="text" name="seo[keywords.{{$localization->alias}}]" value="{{isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : ''}}" class="input-highlight"> 
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="description" class="label-highlight">
                                            Descripcion
                                        </label>
                                    </div>
        
                                    <div class="form-input">
                                        <textarea class="textarea input-highlight" name="seo[description.{{$localization->alias}}]">{{isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : ''}}</textarea>
                                    </div>
                                </div>
                                   
                            </div> 

                        @endforeach
                        
                    @endcomponent

                </div>

                <div class="panel" data-tab="product">
                    <div class="form-group">
                        <div class="form-label">
                            <label for="baseprice" class="label-highlight"> Precio base </label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="product[baseprice]" class="input-highlight" value="{{isset($product->base_price) ? $product->base_price : ''}}">  
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label">
                            <label for="iva" class="label-highlight"> IVA </label>
                        </div>
                        <div class="form-input">
                            <select name="product[iva]" class="input-highlight">
                            @foreach ($ivas as $iva)
                                <option value="{{$iva->id}}" {{$iva->tipo == $iva->id ? "selected" : ""}}>{{$iva->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label">
                            <label for="totalprice" class="label-highlight"> Precio total </label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="product[totalprice]" class="input-highlight" value="{{isset($product->total_price) ? $product->total_price : ''}}">  
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label">
                            <label for="offerprice" class="label-highlight"> Precio en oferta </label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="product[offerprice]" class="input-highlight" value="{{isset($product->offer_price) ? $product->offer_price : ''}}"> 
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
       
    @endisset

   

@endsection






    


