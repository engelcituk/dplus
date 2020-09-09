<div class="modal fade" id="updateClienteInternet" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Internet del cliente 
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
                            <input type="text" class="form-control" id="idClienteModalInternet" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Cliente</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                        </div> 
                                    <input type="text" class="form-control" id="nombreClienteModalInternet" aria-describedby="addon-wrapping-left" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="selectInternet">Selecciona servicio de Internet</label>
                                    <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-wifi fs-xl"></i></span>
                                        </div>
                                        <select class="form-control" id="internetsSelectModalInternet">
                                            @forelse ($internetServicios as $wifi)
                                                <option value="{{$wifi->id}}"> {{$wifi->name}} </option>
                                            @empty
                                                <option value="">Sin datos</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="addon-wrapping-left">Ip de la antena</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-wifi fs-xl"></i></span>
                                            </div> 
                                        <input type="text" class="form-control" data-inputmask="'alias': 'ip'"  aria-label="antenna ip" aria-describedby="addon-wrapping-left" id="ipAntenaModalInternet">
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="addon-wrapping-left">Ip del cliente</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-wifi fs-xl"></i></span>
                                            </div> 
                                        <input type="text" class="form-control" data-inputmask="'alias': 'ip'" aria-label="antenna ip" aria-describedby="addon-wrapping-left" id="ipClienteModalInternet">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="addon-wrapping-left">Contraseña de la antena</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-unlock-alt fs-xl"></i></span>
                                            </div> 
                                        <input type="text" class="form-control" aria-label="antenna pass" aria-describedby="addon-wrapping-left" id="passwordAntenaModalInternet">
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="addon-wrapping-left">Contraseña del router</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-unlock-alt fs-xl"></i></span>
                                            </div> 
                                        <input type="text" class="form-control" aria-label="router pass" aria-describedby="addon-wrapping-left" id="passwordRouterModalInternet" >
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="addon-wrapping-left">Fecha de pago</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-calendar fs-xl"></i></span>
                                            </div> 
                                            <input type="text" class="form-control" id="fechaInicioModalInternet">
                                        </div>
                                        
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="addon-wrapping-left">Fecha fin</label>
                                        <div class="input-group flex-nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-calendar fs-xl"></i></span>
                                            </div> 
                                            <input type="text" class="form-control" id="fechaExpiracionModalInternet">           
                                        </div>
                                    </div> 
                                </div>
                            </div>
                    </form>
                </div>                            
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="fal fa-window-close fs-xl"></i></button>
                <button type="button" class="btn btn-primary" onclick="updateClienteInternet()"><i class="fal fa-plus-square fs-xl"></i> Actualizar</button> 
            </div>
        </div>
    </div>
</div>