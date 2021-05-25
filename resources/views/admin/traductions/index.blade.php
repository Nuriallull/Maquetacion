@php
    $route = 'traductions';
    $filters = ['parent' => $groups]; 
    $order = ['grupo' => 'group' , 'clave' => 'key'];
@endphp


@extends('admin.layout.table_form')

@section('table')

    @isset($tags)

        <div class="titulo-lang">
            <h1>
                @lang('admin/tags.parent_section')
            </h1>
        </div>
        
        <table>    
            
            <tr>
                <th>Key</th>
                <th>Group</th>
        
                <th></th>
            </tr>

            @foreach($tags as $tag_element)
                <tr>
                    <td>{{$tag_element->key}}</td>
                    <td>{{$tag_element->group}}</td>
            
                    <td class="table-icons-container">
                        <div class="table-icons edit-button" id="edit-tag" data-url="{{route('traductions_edit', ['group' => str_replace('/', '-' , $tag_element->group) , 'key' => $tag_element->key])}}">
                            <svg viewBox="0 0 24 24">
                                <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                            </svg>
                        </div> 
                    </td>
                </tr>
            @endforeach
        </table>
        
        @include('admin.components.table_pagination', ['items' => $tags])  
    @endisset
@endsection

@section('form')
   
@isset($tag)

    <div class="form-container">

        <form class="admin-form" id="tags-form" action="{{route("traductions_store")}}" autocomplete="off">
            
            {{ csrf_field() }}

            <input type="hidden" name="group" value="{{$tag->group}}">
            <input type="hidden" name="key" value="{{$tag->key}}">

            <input autocomplete="false" name="hidden" type="text" style="display:none;">

            
                    @component('admin.components.locale', ['tab' => 'content'])

                        @foreach ($localizations as $localization)

                            <div class="subpanel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="content" data-localetab="{{$localization->alias}}">

                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="name" class="label-highlight">Traducción para la clave {{$tag->key}} del grupo {{$tag->group}}</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="tag[value.{{$localization->alias}}]" value="{{isset($tag["value.$localization->alias"]) ? $tag["value.$localization->alias"] : ''}}" class="input-highlight">
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
    

            
        <div class="form-submit">
            <button id="import-tags" data-url="{{route('traductions_import')}}"> Importar </button> 
        </div>
    </div>
@endif

@endsection





    


