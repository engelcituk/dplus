<div class="modal fade" id="updateClienteTV" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Datos del cliente 
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="">  
                        <div class="form-group d-none">
                            <label class="form-label" for="addon-wrapping-left">id cliente</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" id="idClienteModalEdit" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Nombre del cliente</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" id="nombreClienteModalEdit" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="selectTV">Selecciona servicio de TV</label>
                            <div class="input-group flex-nowrap selectTvOption">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-tv fs-xl"></i></span>
                                </div>
                                <select class="form-control" name="televisions" id="televisionsSelectIdEdit">
                                    @forelse ($tvServicios as $stv)
                                        <option value="{{$stv->id}}"> {{$stv->name}} </option>
                                    @empty
                                        <option value="">Sin datos</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Referencia del cliente</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-key fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" id="referenciaClienteModalEdit">
                            </div>
                        </div>
                            
                    </form>
                </div>                            
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="fal fa-window-close fs-xl"></i></button>
                <button type="button" class="btn btn-primary" onclick="updateClienteTV()"><i class="fal fa-plus-square fs-xl"></i> Actualizar</button> 
            </div>
        </div>
    </div>
</div>