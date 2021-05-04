@if(isset($tab))

    <div class="submenu-form">
        <ul>
            <li class="subpanel-button" data-tab="español" data-localetab="español"> Español </li>
            <li class="subpanel-button" data-tab="ingles" data-localetab="ingles"> Inglés </li>
        </ul>
    </div>


    {{ $slot }}

@endif