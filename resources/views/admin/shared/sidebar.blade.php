<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{ asset('smartadmin/img/logo.png')}}" alt="SmartAdmin WebApp" aria-roledescription="logo">
            <span class="page-logo-text mr-1">DPlus App</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION  -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="{{ asset('smartadmin/img/demo/avatars/avatar-admin.png')}}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        {{ Auth::user()->name }} 
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">Señor, Q.Roo</span>
            </div>
            <img src="{{ asset('smartadmin/img/card-backgrounds/cover-2-lg.png')}}" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <ul id="js-nav-menu" class="nav-menu">
            
            
            <li class="nav-title">Principales</li>
            <li class=" {{setCollapseShow(['admin.ventas.index','dashboard'])}} ">
                <a href="#" title="UI Ventas" data-filter-tags="ui ventas">
                    <i class="fal fa-window"></i>
                    <span class="nav-link-text" data-i18n="nav.ui_ventas">Ventas</span>
                </a>
                <ul>
                    <li class="{{ setActiveRoute('admin.ventas.index') }}">
                        <a href="{{route('admin.ventas.index')}}" title="Alerts" data-filter-tags="ui ventas alerts">
                            <span class="nav-link-text" data-i18n="nav.ui_ventas_alerts">Pagar servicio</span>
                        </a>
                    </li>
                    <li class="{{ setActiveRoute('dashboard') }}">
                        <a href="{{route('dashboard')}}"  title="Accordions" data-filter-tags="ui ventas accordions">
                            <span class="nav-link-text" data-i18n="nav.ui_ventas_accordions">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-title">Administración</li>
            <li class=" {{setCollapseShow(['admin.clientes.index','admin.clientes.create'])}} ">
                <a href="#" title="Clientes" data-filter-tags="clientes">
                    <i class="fal fa-users"></i>
                    <span class="nav-link-text" data-i18n="nav.clientes">Clientes</span>
                </a>
                <ul>
                    <li class="{{ setActiveRoute('admin.clientes.index') }}">
                        <a href="{{route('admin.clientes.index')}}" title="Clientes" data-filter-tags="clientes ">
                            <span class="nav-link-text" data-i18n="nav.clientes">Clientes</span>
                            <span class="dl-ref label bg-primary-400 ml-2">9 KB</span>
                        </a>
                    </li>
                    <li class="{{ setActiveRoute('admin.clientes.create') }}">
                        <a href="{{route('admin.clientes.create')}}" title="Recargas" data-filter-tags="clientes nuevo">
                            <span class="nav-link-text" data-i18n="nav.clientes_nuevo">Nuevo</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" title="Servicios" data-filter-tags="servicios service">
                    <i class="fal fa-table"></i>
                    <span class="nav-link-text" data-i18n="nav.servicios">Servicios</span>
                </a>
                <ul>
                    <li>
                        <a href="servicios_basic.html" title="Internet" data-filter-tags="servicios service internet">
                            <span class="nav-link-text" data-i18n="nav.servicios_internet">Internet</span>
                        </a>
                    </li>
                    <li>
                        <a href="servicios_basic.html" title="Basic" data-filter-tags="servicios service recarga">
                            <span class="nav-link-text" data-i18n="nav.servicios_recarga">Recargas</span>
                        </a>
                    </li>
                    <li>
                        <a href="servicios_autofill.html" title="Sky" data-filter-tags="servicios service sky">
                            <span class="nav-link-text" data-i18n="nav.servicios_sky">Sky</span>
                        </a>
                    </li>
                    <li>
                        <a href="servicios_autofill.html" title="Dish" data-filter-tags="servicios service dish">
                            <span class="nav-link-text" data-i18n="nav.servicios_dish">Dish</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-title">Configuración</li>
            <li>
                <a href="#" title="Configuracion" data-filter-tags="configuracion conf">
                    <i class="fal fa-key"></i>
                    <span class="nav-link-text" data-i18n="nav.configuracion">Roles-Permisos</span>
                </a>
                <ul>
                    <li>
                        <a href="configuracion_basic.html" title="Roles" data-filter-tags="configuracion roles">
                            <span class="nav-link-text" data-i18n="nav.configuracion_roles">Roles</span>
                        </a>
                    </li>
                    <li>
                        <a href="configuracion_autofill.html" title="Permisos" data-filter-tags="configuracion permisos">
                            <span class="nav-link-text" data-i18n="nav.configuracion_permisos">Permisos</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class=" {{setCollapseShow(['admin.categorias.index'])}} ">
                <a href="#" title="Catalogos" data-filter-tags="configuracion comisiones">
                    <i class="fal fa-print"></i>
                    <span class="nav-link-text" data-i18n="nav.configuracion">Catálogos</span>
                </a>
                <ul>
                    <li class="{{ setActiveRoute(['admin.categorias.index','admin.categorias.create']) }}">
                        <a href="{{route('admin.categorias.index')}}"  title="Comisiones" data-filter-tags="configuracion categorias">
                            <span class="nav-link-text" data-i18n="nav.configuracion_comisiones">Categorias</span>
                        </a>
                    </li>
                    <li>
                        <a href="configuracion_basic.html" title="Comisiones" data-filter-tags="configuracion comisiones">
                            <span class="nav-link-text" data-i18n="nav.configuracion_comisiones">Comisiones</span>
                        </a>
                    </li>
                    <li>
                        <a href="configuracion_basic.html" title="Estados" data-filter-tags="configuracion estados">
                            <span class="nav-link-text" data-i18n="nav.configuracion_estados">Estados</span>
                        </a>
                    </li>
                    <li>
                        <a href="configuracion_basic.html" title="Impresoras" data-filter-tags="configuracion impresoras">
                            <span class="nav-link-text" data-i18n="nav.configuracion_impresoras">Impresoras</span>
                        </a>
                    </li>
                </ul>
                
            </li>
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <ul class="list-table m-auto nav-footer-buttons">
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                    <i class="fal fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
        </ul>
    </div> <!-- END NAV FOOTER -->
</aside>