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
            @can('view', [new App\Cliente])
                <li class=" {{setCollapseShow(['admin.clientes.*'])}}" >
                    <a href="#" title="Clientes" data-filter-tags="clientes">
                        <i class="fal fa-users"></i>
                        <span class="nav-link-text" data-i18n="nav.clientes">Clientes</span>
                    </a>
                    <ul>
                        @can('view', new App\Cliente)
                        <li class="{{ setActiveRoute('admin.clientes.*') }}">
                            <a href="{{route('admin.clientes.index')}}" title="Clientes" data-filter-tags="clientes ">
                                <span class="nav-link-text" data-i18n="nav.clientes">Clientes</span>
                                <span class="dl-ref label bg-primary-400 ml-2">9 KB</span>
                            </a>
                        </li>
                        @endcan                    
                    </ul>
                </li>
            @endcan            
            @can('view', [new App\Television, new App\Internet])
                <li class=" {{setCollapseShow(['admin.television.*','admin.internet.*'])}}">
                    <a href="#" title="Servicios" data-filter-tags="servicios service">
                        <i class="fal fa-table"></i>
                        <span class="nav-link-text" data-i18n="nav.servicios">Servicios</span>
                    </a>
                    <ul>
                        @can('view', new App\Television)
                            <li class="{{ setActiveRoute('admin.television.*') }}">
                                <a href="{{route('admin.television.index')}}" title="Television" data-filter-tags="television service tv">
                                    <span class="nav-link-text" data-i18n="nav.television_tv">Television</span>
                                </a>
                            </li> 
                        @endcan                   
                        @can('view', new App\Internet)
                            <li class="{{ setActiveRoute('admin.internet.*') }}">
                                <a href="{{route('admin.internet.index')}}" title="Internet" data-filter-tags="internet service int">
                                    <span class="nav-link-text" data-i18n="nav.internet_int">Internet</span>
                                </a>
                            </li>
                        @endcan                
                    </ul>
                </li>
            @endcan
            
            <li class="nav-title">Configuración</li>
            @can('view', [new App\User, new \Spatie\Permission\Models\Role, new \Spatie\Permission\Models\Permission])
                <li class="{{setCollapseShow(['admin.users.*','admin.roles.*','admin.permissions.*'])}}">
                    <a href="#" title="Configuracion" data-filter-tags="configuracion conf">
                        <i class="fal fa-key"></i>
                        <span class="nav-link-text" data-i18n="nav.configuracion">Usuarios</span>
                    </a>
                    <ul>
                        @can('view', new App\User)
                            <li class="{{ setActiveRoute(['admin.users.*']) }}">
                                <a href="{{route('admin.users.index')}}" title="Usuarios" data-filter-tags="configuracion users">
                                    <span class="nav-link-text" data-i18n="nav.configuracion_users">Usuarios</span>
                                </a>
                            </li>
                        @else
                            <li class="{{ setActiveRoute(['admin.users.*']) }}">
                                <a href="{{route('admin.users.show',auth()->user())}}" title="Usuarios" data-filter-tags="configuracion perfil">
                                    <span class="nav-link-text" data-i18n="nav.configuracion_perfil">Perfil</span>
                                </a>
                            </li>
                        @endcan
                        
                        @can('view', new \Spatie\Permission\Models\Role)
                            <li class="{{ setActiveRoute(['admin.roles.*']) }}">
                                <a href="{{route('admin.roles.index')}}" title="Roles" data-filter-tags="configuracion roles">
                                    <span class="nav-link-text" data-i18n="nav.configuracion_roles">Roles</span>
                                </a>
                            </li>
                        @endcan
                        @can('view', new \Spatie\Permission\Models\Permission)
                            <li class="{{ setActiveRoute(['admin.permissions.*']) }}">
                                <a  href="{{route('admin.permissions.index')}}" title="Permisos" data-filter-tags="configuracion permisos">
                                    <span class="nav-link-text" data-i18n="nav.configuracion_permisos">Permisos</span>
                                </a>
                            </li> 
                        @endcan
                        
                    </ul>
                </li>
            @endcan
            
            @can('view', [new App\Category, new App\DaysPeriod, new App\Printer])
                <li class="{{setCollapseShow(['admin.periododias.*','admin.printers.*','admin.categories.*'])}}">
                    <a href="#" title="Catalogos" data-filter-tags="configuracion comisiones">
                        <i class="fal fa-print"></i>
                        <span class="nav-link-text" data-i18n="nav.configuracion">Catálogos</span>
                    </a>
                    <ul>
                        @can('view', new App\Category)
                            <li class="{{ setActiveRoute(['admin.categories.*']) }}">
                                <a href="{{route('admin.categories.index')}}"  title="categorías" data-filter-tags="configuracion categorias">
                                    <span class="nav-link-text" data-i18n="nav.configuracion_categorias">Categorías</span>
                                </a>
                            </li>                        
                        @endcan 
                        @can('view', new App\DaysPeriod)
                            <li class="{{ setActiveRoute(['admin.periododias.*']) }}">
                                <a href="{{route('admin.periododias.index')}}"  title="Comisiones" data-filter-tags="configuracion periododias">
                                    <span class="nav-link-text" data-i18n="nav.configuracion_comisiones">Periodo de días</span>
                                </a>
                            </li>
                        @endcan                    
                        @can('view', new App\Printer)
                            <li class="{{ setActiveRoute(['admin.printers.*']) }}">
                                <a href="{{route('admin.printers.index')}}"  title="Impresoras" data-filter-tags="configuracion impresoras">
                                    <span class="nav-link-text" data-i18n="nav.configuracion_impresoras">Impresoras</span>
                                </a>
                            </li>                        
                        @endcan 
                                     
                    </ul>                
                </li>
            @endcan            
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