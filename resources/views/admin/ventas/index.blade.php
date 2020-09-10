@extends('admin.layout')

@section('content')
<div class="row">
    <div class="col-xl-6 col-md-6">
        <!--Basic alerts-->
        <div class="panel">
            <div class="panel-hdr">
                <h2>
                    Dplus <span class="fw-300"><i>ventas</i></span>
                </h2>
                <div class="panel-toolbar">
                    <button type="button" class="btn btn-success btn-sm" onclick="nuevoTicket()"><i class="fal fa-ticket-alt"></i> Nuevo ticket</button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabVentas-1" role="tab">TV</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabVentas-2" role="tab">Productos</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabVentas-3" role="tab">Internet</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabVentas-4" role="tab">Recargas</a></li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane fade show active" id="tabVentas-1" role="tabpanel">
                            <div class="form-group">
                                <button class="btn btn-info btn-sm float-right mb-3" data-toggle="modal"  data-target="#registrarClienteTV"> <i class="fal fa-pen"></i> Registrar cliente</button>    
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Indique el nombre del cliente o su referencia" aria-label="cliente o referencia" aria-describedby="btnBuscarCliente" id="clienteReferencia" onkeyup="buscarClientesTV()">
                                    {{-- <div class="input-group-append">
                                        <button class="btn btn-primary waves-effect waves-themed" type="button" id="btnBuscarCliente"><i class="fal fa-search"></i></button>
                                    </div> --}}
                                </div>
                                <div id="listaClientes">

                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabVentas-2" role="tabpanel">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Indique el nombre del producto o su código de barras" aria-label="producto o barcode" aria-describedby="btnBuscarProducto" id="nameBarcodeProducto" onkeyup="buscarProductos(event)">
                                </div>
                            </div>
                            <div id="listaProductos">

                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabVentas-3" role="tabpanel">
                            <div class="form-group">
                                <button class="btn btn-info btn-sm float-right mb-3" data-toggle="modal"  data-target="#registrarClienteInternet"> <i class="fal fa-pen"></i> Registrar cliente</button> 
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Indique el nombre del cliente" aria-label="cliente" aria-describedby="btnBuscarClienteInt" id="nameClienteInternet" onkeyup="buscarClientesInternet()">
                                </div>
                            </div>
                            <div id="listaClientesInternet">
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabVentas-4" role="tabpanel">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Indique la recarga"  id="nameRecarga" onkeyup="buscarRecargas()">
                                    </div>
                                </div>
                                <div id="listaRecargas">
                                    
                                </div>
                            </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="panel">
            <div class="panel-container">
                <div class="panel-content">
                    <div id="btnTickets">

                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div id="lsTickets">

        </div>
    </div>
</div>
@include('admin.ventas.modals.servicioTV') 
@include('admin.ventas.modals.servicioInternet') 
@include('admin.ventas.modals.servicioRecarga') 
@include('admin.ventas.modals.registrarClienteTV') 
@include('admin.ventas.modals.registrarClienteInternet') 
@include('admin.ventas.modals.updateClienteTV') 
@include('admin.ventas.modals.updateClienteInternet') 
@include('admin.ventas.modals.notaItem') 
@include('admin.ventas.modals.cobrarVenta') 

@endsection
@push('stylesCss')
    <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endpush
@push('scriptsJs')   
    <script src="{{ asset('smartadmin/js/notifications/sweetalert2/sweetalert2.bundle.js') }}" ></script>   
    <script src="{{ asset('smartadmin/js/notifications/notify/bootstrap-notify.js') }}" ></script>
    <script src="{{ asset('smartadmin/js/formplugins/inputmask/inputmask.bundle.js') }}" ></script> 
    <script src="{{ asset('smartadmin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}" ></script>  
     
    @include('admin.ventas.js.datepicker') 
    @include('admin.ventas.js.index') 
    @include('admin.ventas.js.coreVentas') 
@endpush 