<div class="modal fade" id="registrarClienteInternet" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Registrar cliente internet
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="">  
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Nombre del cliente</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                        </div> 
                                    <input type="text" class="form-control" id="nombreClienteInternetR" aria-describedby="addon-wrapping-left">
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
                                        <select class="form-control" id="internetsSelectInternetR">
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
                                        <input type="text" class="form-control" data-inputmask="'alias': 'ip'"  aria-label="antenna ip" aria-describedby="addon-wrapping-left" id="ipAntenaInternetR">
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
                                        <input type="text" class="form-control" data-inputmask="'alias': 'ip'" aria-label="antenna ip" aria-describedby="addon-wrapping-left" id="ipClienteInternetR">
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
                                        <input type="text" class="form-control" aria-label="antenna pass" aria-describedby="addon-wrapping-left" id="passwordAntenaInternetR">
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
                                        <input type="text" class="form-control" aria-label="router pass" aria-describedby="addon-wrapping-left" id="passwordRouterInternetR" >
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
                                            <input type="text" class="form-control" id="fechaInicioInternetR">
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
                                            <input type="text" class="form-control" id="fechaExpiracionInternetR">           
                                        </div>
                                    </div> 
                                </div>
                            </div>
                    </form>
                </div>                            
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="fal fa-window-close fs-xl"></i></button>
                <button type="button" class="btn btn-primary" onclick="saveClienteInternet()"><i class="fal fa-plus-square fs-xl"></i> Guardar</button> 
            </div>
        </div>
    </div>
</div>