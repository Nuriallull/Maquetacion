

@extends('admin.layout.table_form')

@section('table')

    @isset($seos)

        <div class="titulo-lang">
            <h1>
                @lang('admin/seo.parent_section')
            </h1>
        </div>
        
        <table>    
            
            <tr>
                <th>Key</th>
                <th> </th>
            
            </tr>

            @foreach($seos as $seo_element)
                <tr>
                    <td> {{$seo_element->key}}</td>
            
                    <td class="table-icons-container">
                        <div class="table-icons edit-button" id="edit-tag" data-url="{{route('seo_edit', ['key' => $seo_element->key])}}">
                            <svg viewBox="0 0 24 24">
                                <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                            </svg>
                        </div> 
                    </td>
                </tr>
            @endforeach
        </table>
        
        @include('admin.components.table_pagination', ['items' => $seos])  

    @endisset

@endsection

@section('form')
   
    @isset($seo)

        <div class="form-container">

            <form class="admin-form" id="seo-form" action="{{route("seo_store")}}" autocomplete="off">
                
                {{ csrf_field() }}


                <input autocomplete="false" name="hidden" type="text" style="display:none;">

                
                        @component('admin.components.locale', ['tab' => 'content'])

                            @foreach ($localizations as $localization)

                            <input type="hidden" name="seo[key.{{$localization->alias}}]" value="{{$seo["key.$localization->alias"]}}">
                            <input type="hidden" name="seo[group.{{$localization->alias}}]" value="{{$seo["group.$localization->alias"]}}">
                            <input type="hidden" name="seo[old_url.{{$localization->alias}}]" value="{{isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : ''}}" class="input-highlight block-parameters" > 

                                <div class="subpanel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="content" data-localetab="{{$localization->alias}}">

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="seo[url.{{$localization->alias}}]" class="label-seo">Url</label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="seo[url.{{$localization->alias}}]" value="{{isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : ''}}" class="input-highlight block-parameters">
                                        </div>
                                    </div>

                                    <div class="one-column">
                                        <div class="form-group">
                                            <div class="form-label">
                                                <label for="seo[title.{{$localization->alias}}]" class="label-highlight">Título</label>
                                            </div>
                                            <div class="form-input">
                                                <input type="text" name="seo[title.{{$localization->alias}}]" value="{{isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : ''}}" class="input-highlight">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="seo[description.{{$localization->alias}}]" class="label-highlight">Descripción</label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="seo[description.{{$localization->alias}}]" value="{{isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : ''}}" class="input-highlight">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="name" class="label-highlight">Keywords</label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="seo[keywords.{{$localization->alias}}]" value="{{isset($seo["keywords.$localization->alias"]) ? $seo["keywords.$localization->alias"] : ''}}" class="input-highlight">
                                        </div>
                                    </div>

                                        
                                </div>
                            @endforeach
                        
                        @endcomponent
                
                
            </form>
        </div>

        <div class="form-footer">        
            <div class="form-save">
                <button id="send-button" data-url="{{route('traductions_store')}}"> 
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                    </svg>
                </button> 
            </div>
        

        </div>

    @else 

        <div class="form-container">
            <div class="tabs-container">
                <div class="tabs-container-menu">
                    <ul>
                        <li class="tab-item tab-active" data-tab="content">
                            
                        </li>      
                    </ul>
                </div>
            </div>

            <div class="tab-panel tab-active" data-tab="content">
                <div class="one-column">
                    <div class="form-group">
                        <div class="form-label">
                            <label>
                                Pulse <button id="import-seo" data-url="{{route('seo_import')}}">aquí </button> para importar todos los enlaces.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="one-column">
                    <div class="form-group">
                        <div class="form-label">
                            <label>
                                Pulse <button id="ping-google" data-url="{{route('ping_google')}}">aquí</button> para llamar al robot de Google.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="one-column">
                    <div class="form-group">
                        <div class="form-label">
                            <label>
                                Pulse <button id="create-sitemap" data-url="{{route('create_sitemap')}}">aquí</button> para generar el sitemap.
                            </label>
                            <div class="form-input">
                                <textarea id="sitemap" class="simple"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endisset

@endsection





    


