@php
    $route = 'faqs';
    $filters = ['category' => $faqs_categories, 'search' => true, 'created_at' => true]; 
    $order  = ['Nombre' => 'name', 'Fecha' => 't_faqs.created_at', 'Categoria' => 't_faqs_categories.name'];
@endphp

@extends('admin.layout.table_form')


@section('table')   

    @isset($faqs)
        @if($agent->isMobile())

            <div class="titulo-lang">
                <h1>
                    @lang('admin/faqs.parent_section')
                </h1>
            </div>

            <div id="table-container" class="table">   

                @foreach($faqs as $faq_element)
                    <div class="table-row swipe-element">
                        <div class="table-field-container swipe-front">
                            <div class="table-field"> <p><span>Título:</span>  {{$faq_element->name}} </p></div> 
                            <div class="table-field"> <p><span>Categoría:</span> {{$faq_element->category->name}} </p></div> 
                            <div class="table-field"> <p><span>Creado en:</span> {{ Carbon\Carbon::parse($faq_element->created_at)->format('d-m-Y') }} </p></div>
                        </div>
                        <div class="table-icons-container swipe-back">
                            <div class="table-icons edit-button right-swipe" data-url="{{route('faqs_edit', ['faq' => $faq_element->id])}}">
                                <svg viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                            </div> 
                            
                            <div class="table-icons delete-button left-swipe" data-url="{{route('faqs_destroy', ['faq' => $faq_element->id])}}">
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
                    @lang('admin/faqs.parent_section')
                    </h1>
                </div>        
                <tr>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Fecha de creación</th>
                    <th></th>
                </tr>

                @foreach($faqs as $faq_element)
                    <tr>
                        <td>{{$faq_element->name}}</td>
                        <td>{{$faq_element->category->name}}</td>
                        <td>{{ Carbon\Carbon::parse($faq_element->created_at)->format('d-m-Y') }}</td>
                        <td class="table-icons-container">
                            <div class="table-icons edit-button" data-url="{{route('faqs_edit', ['faq' => $faq_element->id])}}">
                                <svg viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                            </div> 
                        
                            <div class="table-icons delete-button" data-url="{{route('faqs_destroy', ['faq' => $faq_element->id])}}">
                                <svg class="table-icons" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                </svg>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            

            @include('admin.components.table_pagination', ['items' => $faqs])   
            

        @endif
        
    @endif

@endsection

@section('form')

    @isset($faq)
        
        <div class="form-container">

            <form class="admin-form" id="faqs-form" action="{{route("faqs_store")}}" autocomplete="off">
                {{ csrf_field() }}

                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <input type="hidden" name="id" value="{{isset($faq->id) ? $faq->id : ''}}">
            
                <div class="form-header">
                    <div class="form-update">
                            <button id="update-button" class="update" data-url="{{route('faqs_create')}}"> 
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
                    </ul>
                
                </div>


                <div class="panel tab-active" data-tab="contenido">
                            
                    <div class="form-group">
                        <div class="form-label">
                            <label for="category_id" class="label-highlight">
                                Categoría 
                            </label>
                        </div>
                        <div class="form-input">
                            <select name="category_id" data-placeholder="Seleccione una categoría" class="input-highlight">
                                <option></option>
                                @foreach($faqs_categories as $faq_category)
                                    <option value="{{$faq_category->id}}" {{$faq->category_id == $faq_category->id ? 'selected':''}} class="category_id">{{ $faq_category->name }}</option>
                                @endforeach
                            </select>  
                        </div>                 
                    </div>
                
                    <div class="form-group">
                        <div class="form-label">
                            <label for="title" class="label-highlight">Nombre</label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="name" value="{{isset($faq->name) ? $faq->name : ''}}"  class="input-highlight"  />
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
                                    'entity' => 'faqs',
                                    'type' => 'image', 
                                    'content' => 'featured', 
                                    'alias' => $localization->alias,
                                    'files' => $faq->images_featured_preview
                                ])
                            
                                <p> Selección múltiple </p>
                            
                                @include('admin.components.upload', [
                                    'entity' => 'faqs',
                                    'type' => 'images', 
                                    'content' => 'grid', 
                                    'alias' => $localization->alias,
                                    'files' => $faq->images_grid_preview
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
            </form>
        </div>
        
        <div class="form-footer">        
            <div class="form-submit">
                <button id="send-button">Enviar</button>
            </div>
        </div>
    @endif

@endsection






    


