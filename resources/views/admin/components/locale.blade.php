@if(isset($tab))

    <div class="submenu-form">
        <ul>
            @foreach ($localizations as $localization)
                <li class="subpanel-button {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="{{$tab}}" data-localetab="{{$localization->alias}}"> 
                    {{$localization->name}}
                </li>
            @endforeach
        </ul>
    </div>


    {{ $slot }}

@endif