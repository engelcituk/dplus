<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <img src="smartadmin/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
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
            <img src="smartadmin/img/demo/avatars/avatar-admin.png" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        {{ Auth::user()->name }} 
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">Toronto, Canada</span>
            </div>
            <img src="smartadmin/img/card-backgrounds/cover-2-lg.png" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <ul id="js-nav-menu" class="nav-menu">
            
            
            <li class="nav-title">Principales</li>
            <li>
                <a href="#" title="UI Components" data-filter-tags="ui components">
                    <i class="fal fa-window"></i>
                    <span class="nav-link-text" data-i18n="nav.ui_components">UI Components</span>
                </a>
                <ul>
                    <li>
                        <a href="ui_alerts.html" title="Alerts" data-filter-tags="ui components alerts">
                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">Alerts</span>
                        </a>
                    </li>
                    <li>
                        <a href="ui_accordion.html" title="Accordions" data-filter-tags="ui components accordions">
                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions">Accordions</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" title="Utilities" data-filter-tags="utilities">
                    <i class="fal fa-bolt"></i>
                    <span class="nav-link-text" data-i18n="nav.utilities">Utilities</span>
                </a>
                <ul>
                    <li>
                        <a href="utilities_borders.html" title="Borders" data-filter-tags="utilities borders">
                            <span class="nav-link-text" data-i18n="nav.utilities_borders">Borders</span>
                        </a>
                    </li>
                    <li>
                        <a href="utilities_clearfix.html" title="Clearfix" data-filter-tags="utilities clearfix">
                            <span class="nav-link-text" data-i18n="nav.utilities_clearfix">Clearfix</span>
                        </a>
                    </li>
                    
                    
                </ul>
            </li>
            
           
            <li class="nav-title">Administración</li>
            <li>
                <a href="#" title="Plugins" data-filter-tags="plugins">
                    <i class="fal fa-shield-alt"></i>
                    <span class="nav-link-text" data-i18n="nav.plugins">Core Plugins</span>
                </a>
                <ul>
                    <li>
                        <a href="plugin_faq.html" title="Plugins FAQ" data-filter-tags="plugins plugins faq">
                            <span class="nav-link-text" data-i18n="nav.plugins_plugins_faq">Plugins FAQ</span>
                        </a>
                    </li>
                    <li>
                        <a href="plugin_waves.html" title="Waves" data-filter-tags="plugins waves">
                            <span class="nav-link-text" data-i18n="nav.plugins_waves">Waves</span>
                            <span class="dl-ref label bg-primary-400 ml-2">9 KB</span>
                        </a>
                    </li>
                  
                </ul>
            </li>
            <li>
                <a href="#" title="Datatables" data-filter-tags="datatables datagrid">
                    <i class="fal fa-table"></i>
                    <span class="nav-link-text" data-i18n="nav.datatables">Datatables</span>
                    <span class="dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top">235 KB</span>
                </a>
                <ul>
                    <li>
                        <a href="datatables_basic.html" title="Basic" data-filter-tags="datatables datagrid basic">
                            <span class="nav-link-text" data-i18n="nav.datatables_basic">Basic</span>
                        </a>
                    </li>
                    <li>
                        <a href="datatables_autofill.html" title="Autofill" data-filter-tags="datatables datagrid autofill">
                            <span class="nav-link-text" data-i18n="nav.datatables_autofill">Autofill</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-title">Configuración</li>
            <li>
                    <a href="#" title="Datatables" data-filter-tags="configuracion conf">
                        <i class="fal fa-cog"></i>
                        <span class="nav-link-text" data-i18n="nav.configuracion">Configuración</span>
                    </a>
                    <ul>
                        <li>
                            <a href="configuracion_basic.html" title="Basic" data-filter-tags="configuracion conf basic">
                                <span class="nav-link-text" data-i18n="nav.configuracion_basic">Basic</span>
                            </a>
                        </li>
                        <li>
                            <a href="configuracion_autofill.html" title="Autofill" data-filter-tags="configuracion conf autofill">
                                <span class="nav-link-text" data-i18n="nav.configuracion_autofill">Autofill</span>
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