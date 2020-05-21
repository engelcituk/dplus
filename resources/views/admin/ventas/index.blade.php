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
                            Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic.
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
    <div class="col-xl-6 col-md-6">
        <!--Alert outline-->
        <div class="panel">
            <div class="panel-hdr">
                <h2>
                    Compras <span class="fw-300"><i></i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="demo-v-spacing">
                        
                        <span id="resultado"></span>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scriptsJs')   
    <script src="{{ asset('smartadmin/js/notifications/sweetalert2/sweetalert2.bundle.js') }}" ></script>   
    @include('admin.ventas.js.index') 
@endpush