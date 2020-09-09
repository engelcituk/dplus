<div class="modal fade" id="servicioRecarga" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Datos de la recarga
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
                                <label class="form-label" for="addon-wrapping-left">idServicioRecarga</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-key fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control"  id="idServicioRecarga" readonly>
                                </div>
                            </div>
                        </div> 
                        <div class="col-xs-6 m-auto d-none">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Con iva</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-key fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control"  id="ivaServicioRecarga" readonly>
                                </div>
                            </div>
                        </div> 

                        <div class="col-xs-6 m-auto">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Código del servicio</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-barcode fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control" step="0.01" id="codigoServicioRecarga" readonly>
                                </div>
                            </div>
                        </div> 

                        <div class="col-xs-6 m-auto">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Nombre servicio</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-edit fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control" id="descripcionServicioRecarga" readonly>
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
                                <input type="number" class="form-control" step="0.01" id="precioServicioRecarga" onchange="calculoPrecioFinalRecarga()">
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
                                <input type="number" class="form-control"  step="0.01" id="comisionServicioRecarga" onchange="calculoPrecioFinalRecarga()">
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
                                <input type="text" class="form-control" id="numPagoRecarga">
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
                                <input type="text" class="form-control"  id="numAutorizacionRecarga">
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
                        <input type="text" class="form-control"  id="precioFinalServicioRecarga" readonly>
                        </div>
                    </div>
                </div>                            
            </div> 
        </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="fal fa-window-close fs-xl"></i></button>
                <div id="lstTicketsServicioRecargas" class="form-group">

                </div>
            </div>
        </div>
    </div>
</div>