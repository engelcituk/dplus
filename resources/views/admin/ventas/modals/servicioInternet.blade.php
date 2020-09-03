<div class="modal fade" id="servicioInternet" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Datos del servicio Internet
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
                                <input type="text" class="form-control"  id="idClienteInputServicioInternet" readonly>
                                </div>
                            </div>
                        </div>  
                        <div class="col-xs-6 m-auto d-none">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">idServicioInternet</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-key fs-xl"></i></span>
                                    </div>
                                <input type="text" class="form-control"  id="idServicioInternet" readonly>
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
                                <input type="text" class="form-control"  id="ivaServicioInternet" readonly>
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
                                <input type="text" class="form-control" id="descripcionServicioInternet" readonly>
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
                                    <input type="text" class="form-control"  id="nombreClienteServicioInternet" readonly>
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
                                <input type="number" class="form-control" step="0.01" id="precioServicioInternet" onchange="calculoPrecioFinalInternet()">
                                </div>
                            </div>
                        </div>   

                        <div class="col-xs-6 m-auto">
                            <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Seguro</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-money-bill fs-xl"></i></span>
                                    </div>
                                <input type="number" class="form-control"  step="0.01" id="seguroServicioInternet" onchange="calculoPrecioFinalInternet()">
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
                                <input type="text" class="form-control" step="0.01" id="codigoServicioInternet" readonly>
                                </div>
                            </div>
                        </div> 
                        <div class="col-xs-6 m-auto">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Fecha Límite</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-calendar fs-xl"></i></span>
                                        </div>
                                    <input type="text" class="form-control" id="dateExpiration" readonly>
                                    </div>
                                </div>
                            </div>          
                    </div>
                    <br>
                 
                    <div class="form-group">
                        <label class="form-label" for="addon-wrapping-left">Aplicar el seguro</label>
                        <div class="input-group flex-nowrap">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="aplyAssurance" onclick="addRemoveAssurance();">
                                <label class="custom-control-label" for="aplyAssurance">Aplicar</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="addon-wrapping-left">Precio final</label>
                        <div class="input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                            </div>
                        <input type="text" class="form-control"  id="precioFinalServicioInternet" readonly>
                        </div>
                    </div>
                    <span class="badge badge-info" id="referenciaModalSpan"></span>
                </div>                            
            </div> 
        </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="fal fa-window-close fs-xl"></i></button>
                <div id="lstTicketsServicioInternets" class="form-group">

                </div>
            </div>
        </div>
    </div>
</div>