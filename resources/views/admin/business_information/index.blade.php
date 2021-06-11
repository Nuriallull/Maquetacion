@php
    $route = 'business_information';
@endphp

@extends('admin.layout.table_form')


<div class="titulo-lang">
    <h1>
        @lang('admin/information.parent_section')
    </h1>
</div>


@section('form')

    <div class="form-container">

        <form class="admin-form" id="business-information-form" action="{{route("business_information_store")}}" autocomplete="off">
            
            {{ csrf_field() }}

            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input type="hidden" name="group" value="front/information">

            
            <div class="menu-form">
                <ul>
                    <li class="menu-button" data-tab="contact"> Contacto </li>
                    <li class="menu-button" data-tab="logo"> Logo </li>
                    <li class="menu-button" data-tab="presentation"> Presentación </li>
                    <li class="menu-button" data-tab="social"> Redes Sociales </li>
                </ul>
            </div>

            
            <div class="panel tab-active" data-tab="contact">

                @component('admin.components.locale', ['tab' => 'contact'])

                    @foreach ($localizations as $localization)

                        <div class="subpanel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="contact" data-localetab="{{$localization->alias}}">

                            <div class="first-column">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Teléfono 
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[telephone.{{$localization->alias}}]" value="{{isset($business["telephone.$localization->alias"]) ? $business["telephone.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                    </div>
                                </div>
                    
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Email 
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[email.{{$localization->alias}}]" value="{{isset($business["email.$localization->alias"]) ? $business["email.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                    </div>
                                </div>
                            
                            

                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Provincia 
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[province.{{$localization->alias}}]" value="{{isset($business["province.$localization->alias"]) ? $business["province.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Población 
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[poblation.{{$localization->alias}}]" value="{{isset($business["poblation.$localization->alias"]) ? $business["poblation.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                    </div>
                                </div>
                            </div>
            
                            <div class="second-column">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Código Postal 
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[postalcode.{{$localization->alias}}]" value="{{isset($business["postalcode.$localization->alias"]) ? $business["postalcode.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Dirección 
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[adress.{{$localization->alias}}]" value="{{isset($business["adress.$localization->alias"]) ? $business["adress.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">Horario</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[schedule.{{$localization->alias}}]" value="{{isset($business["schedule.$localization->alias"]) ? $business["schedule.$localization->alias"] : ''}}" class="input-highlight">
                                    </div>
                                </div>
                            </div>

                        </div>

                    @endforeach
            
                @endcomponent

            </div>

            <div class="panel tab" data-tab="logo">

                @component('admin.components.locale', ['tab' => 'logo'])

                    @foreach ($localizations as $localization)

                        <div class="subpanel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="logo" data-localetab="{{$localization->alias}}">
       
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="name" class="label-highlight">Logo</label>
                                    </div>
                                    
                                    <div class="form-input">
                                        @include('admin.components.upload', [
                                            'entity' => 'business_information',
                                            'type' => 'image', 
                                            'content' => 'logo', 
                                            'alias' => $localization->alias,
                                            'files' => $business->images_logo_preview
                                        ])
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="name" class="label-highlight">Logo Negativo</label>
                                    </div>
                                    <div class="form-input">
                                        @include('admin.components.upload', [
                                            'entity' => 'business_information',
                                            'type' => 'image', 
                                            'content' => 'logolight', 
                                            'alias' => $localization->alias,
                                            'files' => $business->images_logolight_preview
                                        ])
                                    </div>
                                </div>


                        </div>

                    @endforeach
            
                @endcomponent

            </div>

            <div class="panel tab" data-tab="social">

                @component('admin.components.locale', ['tab' => 'social'])

                    @foreach ($localizations as $localization)

                        <div class="subpanel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="social" data-localetab="{{$localization->alias}}">

                            <div class="four-columns">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Instagram
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[instagram.{{$localization->alias}}]" value="{{isset($business["instagram.$localization->alias"]) ? $business["instagram.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Facebook 
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[facebook.{{$localization->alias}}]" value="{{isset($business["facebook.$localization->alias"]) ? $business["facebook.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Twitter 
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[twitter.{{$localization->alias}}]" value="{{isset($business["twitter.$localization->alias"]) ? $business["twitter.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Whatsapp
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[whatsapp.{{$localization->alias}}]" value="{{isset($business["whatsapp.$localization->alias"]) ? $business["whatsapp.$localization->alias"] : ''}}"  class="input-highlight"  />              
                                    </div>
                                </div>
                            </div>

                        </div>

                    @endforeach
            
                @endcomponent

            </div>

            <div class="panel tab" data-tab="presentation">

                @component('admin.components.locale', ['tab' => 'presentation'])

                    @foreach ($localizations as $localization)

                        <div class="subpanel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="presentation" data-localetab="{{$localization->alias}}">
                            
                            <div class="one-column">
                                <div class="form-group">
                                    <div class="form-input" id="ourbusiness">
                                        @include('admin.components.upload', [
                                            'entity' => 'business_information',
                                            'type' => 'image', 
                                            'content' => 'ourbusiness', 
                                            'alias' => $localization->alias,
                                            'files' => $business->images_our_business_preview
                                        ])
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">Eslogan</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" name="business[slogan.{{$localization->alias}}]" value="{{isset($business["slogan.$localization->alias"]) ? $business["slogan.$localization->alias"] : ''}}" class="input-highlight">
                                    </div>
                                </div>
                            

                            
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="business" class="label-highlight">
                                            Nuestra compañía
                                        </label>
                                    </div>
                                    <div class="form-input">
                                        <textarea class="ckeditor input-highlight" name="business[ourbusiness.{{$localization->alias}}]">{{isset($business["ourbusiness.$localization->alias"]) ? $business["ourbusiness.$localization->alias"] : ''}}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                    @endforeach
            
                @endcomponent

            </div>


        </form>

    </div>

    <div class="form-footer">        
        <div class="form-save">
            <button id="send-button" data-url="{{route('business_information_store')}}"> 
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                </svg>
             </button> 
        </div>

@endsection


