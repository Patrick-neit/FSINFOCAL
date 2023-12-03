<aside
    class="{{$configData['sidenavMain']}} @if(!empty($configData['activeMenuType'])) {{$configData['activeMenuType']}} @else {{$configData['activeMenuTypeClass']}}@endif @if(($configData['isMenuDark']) === true) {{'sidenav-dark'}} @elseif(($configData['isMenuDark']) === false){{'sidenav-light'}}  @else {{$configData['sidenavMainColor']}}@endif">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper">
            <a class="brand-logo darken-1" href="{{asset('/')}}">
                @if(!empty($configData['mainLayoutType']) && isset($configData['mainLayoutType']))
                @if($configData['mainLayoutType']=== 'vertical-modern-menu')
                <img class="hide-on-med-and-down" src="{{asset($configData['largeScreenLogo'])}}"
                    alt="materialize logo" />
                <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset($configData['smallScreenLogo'])}}"
                    alt="materialize logo" />

                @elseif($configData['mainLayoutType']=== 'vertical-menu-nav-dark')
                <img src="{{asset($configData['smallScreenLogo'])}}" alt="materialize logo" />

                @elseif($configData['mainLayoutType']=== 'vertical-gradient-menu')
                <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset($configData['largeScreenLogo'])}}"
                    alt="materialize logo" />
                <img class="hide-on-med-and-down" src="{{asset($configData['smallScreenLogo'])}}"
                    alt="materialize logo" />

                @elseif($configData['mainLayoutType']=== 'vertical-dark-menu')
                <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset($configData['largeScreenLogo'])}}"
                    alt="materialize logo" />
                <img class="hide-on-med-and-down" src="{{asset($configData['smallScreenLogo'])}}"
                    alt="materialize logo" />
                @endif
                @endif
                <span class="logo-text hide-on-med-and-down">
                    @if(!empty ($configData['templateTitle']) && isset($configData['templateTitle']))
                    {{$configData['templateTitle']}}
                    @else
                    INFOCAL S.A
                    @endif
                </span>
            </a>
            <a class="navbar-toggler" href="javascript:void(0)"><i class="material-icons">radio_button_checked</i></a>
        </h1>
    </div>
    @php
    $dataconvertido = array(
    "menu" => array(
    array(
    "url" => "javascript:void(0)",
    "i18n" => "Dashboard",
    "name" => "Dashboard",
    "slug" => "dashboard",
    "icon" => "dashboard",
    "class"=> "collapsible-header waves-effect waves-cyan",
    "tag"=> "3",
    "tagcustom"=> "badge pill orange float-right mr-10",
    "submenu" => array(
    array(
    "url" => "ejemplo",
    "i18n" => "Modern",
    "name" => "Ejemplo 1",
    "slug" => "modern"
    ),
    array(
    "url" => "ecommerce",
    "i18n" => "eCommerce",
    "name" => "Ejemplo 2",
    "slug" => "ecommerce"
    ),
    )
    ),
    array(
    "navheader"=> "Modulo Alumnos",
    "icon"=> "more_horiz"
    ),
    array(
    "url" => "javascript:void(0)",
    "i18n" => "Alumnos",
    "name" => "Alumnos",
    "icon" => "person_pin",
    "slug" => "Alumnos",
    "class"=> "collapsible-header waves-effect waves-cyan",
    "submenu" => array(
    array(
    "url" =>trim( parse_url(route('alumnos.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Alumnos Registrados",
    "name" => "Alumnos Registrados",
    "slug" => "alumnos"
    ),
    array(
    "url" => "alumnos.create",
    "i18n" => "Cards Advance",
    "name" => "Alumnos Matriculados",
    "slug" => "cards-advance"
    ),
    array(
    "url" => "alumnos.create",
    "i18n" => "Cards Extended",
    "name" => "Alumnos Inactivos",
    "slug" => "cards-extended"
    )
    )
    ),
    array(
    "navheader"=> "Modulo Docentes",
    "icon"=> "more_horiz"
    ),
    array(
    "url" => "javascript:void(0)",
    "i18n" => "Docentes",
    "name" => "Docentes",
    "icon" => "collections_bookmark",
    "slug" => "Docentes",
    "class"=> "collapsible-header waves-effect waves-cyan",
    "submenu" => array(
    array(
    "url" =>trim( parse_url(route('docentes.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Docentes Registrados",
    "name" => "Docentes Registrados",
    "slug" => "docentes"
    ),
    array(
    "url" => "alumnos.create",
    "i18n" => "Cards Advance",
    "name" => "Alumnos Matriculados",
    "slug" => "cards-advance"
    ),
    array(
    "url" => "alumnos.create",
    "i18n" => "Cards Extended",
    "name" => "Alumnos Inactivos",
    "slug" => "cards-extended"
    )
    )
    ),
    array(
    "navheader"=> "Modulo Ventas",
    "icon"=> "more_horiz"
    ),
    array(
    "url" => "javascript:void(0)",
    "i18n" => "Ventas",
    "name" => "Ventas",
    "icon" => "add_shopping_cart",
    "slug" => "Ventas",
    "class"=> "collapsible-header waves-effect waves-cyan",
    "submenu" => array(
    array(
    "url" =>trim( parse_url(route('alumnos.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Alumnos Registrados",
    "name" => "Alumnos Registrados",
    "slug" => "alumnos"
    ),
    array(
    "url" =>trim( parse_url(route('ventas.registrar_alumnos'), PHP_URL_PATH) ,'/'),
    "i18n" => "Registrar Ventas",
    "name" => "Registrar Ventas",
    "slug" => "ventas"
    ),
    array(
    "url" => "alumnos.create",
    "i18n" => "Cards Advance",
    "name" => "Alumnos Matriculados",
    "slug" => "cards-advance"
    ),
    array(
    "url" => "alumnos.create",
    "i18n" => "Cards Extended",
    "name" => "Alumnos Inactivos",
    "slug" => "cards-extended"
    )
    )
    ),
    array(
    "navheader"=> "Modulo Configuraciones",
    "icon"=> "more_horiz"
    ),
    array(
    "url" => "javascript:void(0)",
    "i18n" => "Configuraciones",
    "name" => "Configuraciones",
    "icon" => "storage",
    "slug" => "Configuraciones",
    "class"=> "collapsible-header waves-effect waves-cyan",
    "submenu" => array(
    array(
    "url" =>trim( parse_url(route('users.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Usuarios Sistema",
    "name" => "Usuarios Sistema",
    "slug" => "usuarios"
    ),

    array(
    "url" =>trim( parse_url(route('configuraciones_impuestos.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Configuracion impuesto",
    "name" => "Configuracion impuesto",
    "slug" => "configuraciones"
    ),

    )
    ),
    //
    array(
    "navheader"=> "Sinc. de Catalogos",
    "icon"=> "more_horiz"
    ),
    array(
    "url" => "javascript:void(0)",
    "i18n" => "Catalogos",
    "name" => "Catalogos",
    "icon" => "cached",
    "slug" => "Catalogos",
    "class"=> "collapsible-header waves-effect waves-cyan",
    "submenu" => array(
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_fecha_hora'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Fecha y Hora",
    "name" => "Sinc. Fecha y Hora",
    "slug" => "Sinc. Fecha y Hora"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_motivo_anulaciones'), PHP_URL_PATH)
    ,'/'),
    "i18n" => "Sinc. Motivo Anulaciones",
    "name" => "Sinc. Motivo Anulaciones",
    "slug" => "Sinc. Motivo Anulaciones"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_tipo_habitacion'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Tipo Habitacion",
    "name" => "Sinc. Tipo Habitacion",
    "slug" => "Sinc. Tipo Habitacion"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_paises_origen'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Origen Paises",
    "name" => "Sinc. Origen Paises",
    "slug" => "Sinc. Origen Paises"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_tipo_documento_sector'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Tipo Doc Sector",
    "name" => "Sinc. Tipo Doc Sector",
    "slug" => "Sinc. Tipo Doc Sector"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_documento_sector'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Doc Sector",
    "name" => "Sinc. Doc Sector",
    "slug" => "Sinc. Doc Sector"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_mensajes_servicios'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Mensajes Servicios",
    "name" => "Sinc. Mensajes Servicios",
    "slug" => "Sinc. Mensajes Servicios"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_eventos_significativos'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Eventos Sig.",
    "name" => "Sinc. Eventos Sig.",
    "slug" => "Sinc. Eventos Sig."
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_productos_servicios'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Prod. Serv.",
    "name" => "Sinc. Prod. Serv.",
    "slug" => "Sinc. Prod. Serv."
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_unidades_medida'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Unidades Medida",
    "name" => "Sinc. Unidades Medida",
    "slug" => "Sinc. Unidades Medida"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_leyendas_factura'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Leyendas",
    "name" => "Sinc. Leyendas",
    "slug" => "Sinc. Leyendas"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_actividades'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Actividades",
    "name" => "Sinc. Actividades",
    "slug" => "Sinc. Actividades"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_metodos_pago'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Tipos Metodos Pago",
    "name" => "Sinc. Tipos Metodos Pago",
    "slug" => "Sinc. Tipos Metodos Pago"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_tipos_factura'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Tipos Facturas",
    "name" => "Sinc. Tipos Facturas",
    "slug" => "Sinc. Tipos Facturas"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_tipo_puntoventa'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Tipos PV",
    "name" => "Sinc. Tipos PV",
    "slug" => "Sinc. Tipos PV"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_tipo_moneda'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Tipo Monedas",
    "name" => "Sinc. Tipo Monedas",
    "slug" => "Sinc. Tipo Monedas"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_tipo_emision'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Tipo Emision",
    "name" => "Sinc. Tipo Emision",
    "slug" => "Sinc. Tipo Emision"
    ),
    array(
    "url" =>trim( parse_url(route('catalogos.index', 'sincronizacion_tipo_documento_identidad'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sinc. Tipo Documento I.",
    "name" => "Sinc. Tipo Documento I.",
    "slug" => "Sinc. Tipo Documento I."
    ),

    )
    ),
    //
    array(
    "navheader"=> "Modulo Empresa",
    "icon"=> "more_horiz"
    ),
    array(
    "url" => "javascript:void(0)",
    "i18n" => "Empresas",
    "name" => "Empresas",
    "icon" => "business_center",
    "slug" => "Empresas",
    "class"=> "collapsible-header waves-effect waves-cyan",
    "submenu" => array(
    array(
    "url" =>trim(parse_url(route('empresas.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Empresas ",
    "name" => "Empresas ",
    "slug" => "empresas"
    ),

    array(
    "url" =>trim( parse_url(route('sucursales.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sucursales ",
    "name" => "Sucursales ",
    "slug" => "sucursales"
    ),
    array(
    "url" =>trim( parse_url(route('puntos_ventas.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Puntos Ventas ",
    "name" => "Puntos Ventas ",
    "slug" => "Puntos Ventas"
    ),
    )
    ),
    //
    array(
    "navheader"=> "Modulo Productos",
    "icon"=> "more_horiz"
    ),
    array(
    "url" => "javascript:void(0)",
    "i18n" => "Productos",
    "name" => "Productos",
    "icon" => "filter_none",
    "slug" => "Productos",
    "class"=> "collapsible-header waves-effect waves-cyan",
    "submenu" => array(
    array(
    "url" =>trim(parse_url(route('marca.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Marca",
    "name" => "Marca",
    "slug" => "marcas"
    ),
    array(
    "url" =>trim(parse_url(route('familia.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Familia",
    "name" => "Familia",
    "slug" => "Familias"
    ),
    array(
    "url" =>trim(parse_url(route('sub_familia.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Sub Familia",
    "name" => "Sub Familia",
    "slug" => "Sub Familias"
    ),

    )
    ),
    array(
    "navheader"=> "Modulo Reportes",
    "icon"=> "more_horiz"
    ),
    array(
    "url" => "javascript:void(0)",
    "i18n" => "Reportes",
    "name" => "Reportes",
    "icon" => "markunread_mailbox",
    "slug" => "Reportes",
    "class"=> "collapsible-header waves-effect waves-cyan",
    "submenu" => array(
    array(
    "url" =>trim( parse_url(route('alumnos.index'), PHP_URL_PATH) ,'/'),
    "i18n" => "Alumnos Registrados",
    "name" => "Alumnos Registrados",
    "slug" => "alumnos"
    ),
    array(
    "url" => "alumnos.create",
    "i18n" => "Cards Advance",
    "name" => "Alumnos Matriculados",
    "slug" => "cards-advance"
    ),
    array(
    "url" => "alumnos.create",
    "i18n" => "Cards Extended",
    "name" => "Alumnos Inactivos",
    "slug" => "cards-extended"
    )
    )
    ),
    /* array(
    "url" => "javascript:void(0)",
    "i18n" => "Cards",
    "name" => "Cards",
    "icon" => "cast",
    "slug" => "cards",
    "class"=> "collapsible-header waves-effect waves-cyan",
    "submenu" => array(
    array(
    "url" => "cards-basic",
    "i18n" => "Cards",
    "name" => "Cards",
    "slug" => "cards-basic"
    ),
    array(
    "url" => "cards-advance",
    "i18n" => "Cards Advance",
    "name" => "Cards Advance",
    "slug" => "cards-advance"
    ),
    array(
    "url" => "cards-extended",
    "i18n" => "Cards Extended",
    "name" => "Cards Extended",
    "slug" => "cards-extended"
    )
    )
    ), */
    )
    );


    $menuDataP =$dataconvertido;
    @endphp
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">
        {{-- Foreach menu item starts --}}
        {{-- {{ dump(view()->getVars()) }} --}}

        @if(!empty($menuDataP['menu']) && isset($menuDataP['menu']))

        @foreach ($menuDataP['menu'] as $menu)

        @if(isset($menu['navheader']))
        <li class="navigation-header">
            <a class="navigation-header-text">{{ $menu['navheader'] }}</a>
            <i class="navigation-header-icon material-icons">{{$menu['icon'] }}</i>
        </li>
        @else
        @php
        $custom_classes="";
        if(isset($menu['class']))
        {
        $custom_classes = $menu['class'];
        }
        @endphp
        @php

        @endphp
        <li class="bold {{(request()->is($menu['url'].'*')) ? 'active' : '' }}">
            <a class="{{$custom_classes}} {{ (request()->is($menu['url'].'*')) ? 'active '.$configData['activeMenuColor'] : ''}}"
                @if(!empty($configData['activeMenuColor'])) {{'style=background:none;box-shadow:none;'}} @endif
                href="@if(($menu['url'])==='javascript:void(0)'){{$menu['url']}} @else{{url($menu['url'])}} @endif"
                {{isset($menu['newTab']) ? 'target="_blank"' :''}}>
                <i class="material-icons">{{$menu['icon']}}</i>
                <span class="menu-title">{{ __(''.$menu['name'] )}}</span>
                @if(isset($menu['tag']))
                <span class="{{$menu['tagcustom']}}">{{$menu['tag']}}</span>
                @endif
            </a>

            @if(isset($menu['submenu']))
            @include('panels.submenu', ['menu' => $menu['submenu']])
            @endif
        </li>

        @endif
        @endforeach
        @endif
    </ul>
    <div class="navigation-background"></div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>