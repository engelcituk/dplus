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
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabVentas-1" role="tab">Servicios</a></li>
                        
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabVentas-3" role="tab">Productos</a></li>
                        
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane fade show active" id="tabVentas-1" role="tabpanel">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Indique el nombre del cliente o su referencia" aria-label="cliente o referencia" aria-describedby="btnBuscarCliente" id="clienteReferencia" onkeyup="buscarClientes()">
                                    {{-- <div class="input-group-append">
                                        <button class="btn btn-primary waves-effect waves-themed" type="button" id="btnBuscarCliente"><i class="fal fa-search"></i></button>
                                    </div> --}}
                                </div>
                                <div id="listaClientes">

                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabVentas-3" role="tabpanel">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Indique el nombre del producto o su código de barras" aria-label="producto o barcode" aria-describedby="btnBuscarProducto" id="nameBarcodeProducto" onkeyup="buscarProductos()">
                                </div>
                            </div>
                            <div id="listaProductos">

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
@include('admin.ventas.modals.notaItem') 
@endsection
@push('stylesCss')
    <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
@endpush
@push('scriptsJs')   
    <script src="{{ asset('smartadmin/js/notifications/sweetalert2/sweetalert2.bundle.js') }}" ></script>   
    <script src="{{ asset('smartadmin/js/notifications/notify/bootstrap-notify.js') }}" ></script>   
    @include('admin.ventas.js.index') 
    @include('admin.ventas.js.coreVentas') 
@endpush 