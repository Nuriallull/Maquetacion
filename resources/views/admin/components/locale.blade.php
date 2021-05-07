@if(isset($tab))

    <div class="submenu-form">
        <ul>
            <li class="subpanel-button" data-tab="{{$tab}}" data-localetab="es"> Español </li>
            <li class="subpanel-button" data-tab="{{$tab}}" data-localetab="en"> Inglés </li>
        </ul>
    </div>


    {{ $slot }}

@endif