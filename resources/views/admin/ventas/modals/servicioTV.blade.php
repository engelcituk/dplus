<div class="modal fade" id="servicioTV" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Datos del servicio Tv del cliente 
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="">
                    <div class="row">
                        <div class="col-xs-6 m-auto d-none">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">idCliente</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-key fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control"  id="idClienteInputTVService" readonly>
                                </div>
                            </div>
                        </div>  
                        <div class="col-xs-6 m-auto d-none">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">idTvServicio</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-key fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control"  id="idTvServicio" readonly>
                                </div>
                            </div>
                        </div> 
                        <div class="col-xs-6 m-auto">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Código</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-barcode fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control" id="codeTvService" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 m-auto">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Nombre del cliente</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                    </div>
                                    <input type="text" class="form-control"  id="nombreClienteInputTVService" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 m-auto">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Referencia del cliente</label>
                                <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" id="referenciaClienteInputTVService" readonly>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-info btn-sm" onclick="copiarDesdeInput()"><i class="fal fa-copy"></i></button>                  
                                    </div>
                                </div>
                            </div>
                        </div>                    
                        <div class="col-xs-6 m-auto">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Servicio</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-tv fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control"  id="nombreInputTVService" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 m-auto">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Precio del servicio</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                    </div>
                                <input type="number" class="form-control" step="0.01" id="precioInputTVService" onchange=" calculoPrecioFinal()">
                                </div>
                            </div>
                        </div>                    
                        <div class="col-xs-6 m-auto">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Comisión</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-money-bill fs-xl"></i></span>
                                    </div>
                                <input type="number" class="form-control"  step="0.01" id="comisionInputTVService" onchange=" calculoPrecioFinal()">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 m-auto">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Número de pago proveedor</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-sort-numeric-up fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control" id="numPago">
                                </div>
                            </div>
                        </div>                    
                        <div class="col-xs-6 m-auto"> 
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">No. de autorización proveedor</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-sort-numeric-up fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control"  id="numAutorizacion">
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <br>
                    <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Precio final</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control"  id="precioFinalInputTVService" readonly>
                            </div>
                        </div>
                    <span class="badge badge-info" id="referenciaModalSpan"></span>
                </div>                            
            </div> 
        </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="fal fa-window-close fs-xl"></i></button>
                <div id="lstTicketsTvServicios" class="form-group">

                </div>
            </div>
        </div>
    </div>
</div>