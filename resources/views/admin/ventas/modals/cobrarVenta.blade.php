<div class="modal fade" id="cobrarVenta" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Cobro de servicios y venta de productos 
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="">  
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Importe:</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-dollar-sign"></i></span>
                                </div>
                            <input type="text" class="form-control" id="importeItems" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Paga con:</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign"></i></span>
                                        </div>
                                    <input type="text" class="form-control" id="pagaCon">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Su cambio:</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign"></i></span>
                                        </div>
                                    <input type="text" class="form-control" id="cambioDiferencia">
                                    </div>
                                </div>
                            </div>
                        </div>     
                    </form>
                </div>                            
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="fal fa-window-close fs-xl"></i> Cancelar</button>
                <button type="button" class="btn btn-info mr-auto" onclick="cobrar(true)><i class="fal fa-sticky-note"></i> Cobrar + ticket</button>
                <button type="button" class="btn btn-success" onclick="cobrar(false)"><i class="fal fa-dollar-sign"></i> Solo Cobrar</button> 
            </div>
        </div>
    </div>
</div>