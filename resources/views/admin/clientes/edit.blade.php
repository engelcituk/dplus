@extends('admin.layout')

@section('content')
    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.clientes.index')}}" > <i class="fal fa-arrow-left"></i> Clientes</a></li>
        <li class="breadcrumb-item">Administracion</li>
        <li class="breadcrumb-item">Clientes</li>
        <li class="breadcrumb-item active">Editar</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> 

<div class="row"> 
    <div class="col-md-12 ">
        <div class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos del <span class="fw-300"><i>cliente y sus servicios</i></span>
                </h2> 
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.clientes.update',$cliente)}}" method="POST">
                        @csrf  {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Nombre completo del cliente</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                        </div>
                                    <input type="text" class="form-control" placeholder="Nombre completo" aria-label="Nombre completo" aria-describedby="addon-wrapping-left" name="name" value="{{ old('name', $cliente->name)}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="selectPeriodo">Selecciona servicio de TV</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-tv fs-xl"></i></span>
                                        </div>
                                        <select class="form-control" name="televisions">
                                            <option value="">Selecciona</option>
                                            @forelse ($tvServicios as $stv)
                                                {{-- <option {{collect(old('televisions',$cliente->televisions->pluck('id')))->contains($stv->id) ? 'selected': '' }} value="{{$stv->id}}"> {{$stv->name}} </option> --}}
                                                <option value="{{$stv->id}}"
                                                    {{ old('televisions', $clienteTV ? $clienteTV->pivot->television_id : '') == $stv->id ? 'selected': '' }}> {{$stv->name}} </option>
                                            @empty
                                                <option value="">Sin datos</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Rerencia del cliente</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-key fs-xl"></i></span>
                                        </div>
                                    <input type="text" class="form-control" placeholder="referencia" aria-label="referencia" aria-describedby="addon-wrapping-left" name="referencia" value="{{ $clienteTV ? $clienteTV->pivot->referencia : ''}}">
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
                                            <select class="form-control" name="internets">
                                                <option value="">Selecciona</option>
                                                @forelse ($wifiServicios as $wifi)
                                                    <option value="{{$wifi->id}}"
                                                        {{ old('internets', $clienteWifi ? $clienteWifi->pivot->internet_id : '') == $wifi->id ? 'selected': '' }}> {{$wifi->name}} </option>
                                                @empty
                                                    <option value="">Sin datos</option>
                                                @endforelse
                                            </select>
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
                                                <input type="text" class="form-control" placeholder="" data-inputmask="'alias': 'ip'"  aria-label="antenna ip" aria-describedby="addon-wrapping-left" name="antenna_ip" value="{{$clienteWifi ? $clienteWifi->pivot->antenna_ip : ''}}">
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
                                                <input type="text" class="form-control" placeholder="" data-inputmask="'alias': 'ip'" aria-label="antenna ip" aria-describedby="addon-wrapping-left" name="client_ip" value="{{$clienteWifi ? $clienteWifi->pivot->client_ip : ''}}">
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
                                                <input type="text" class="form-control" placeholder="Contraseña de la antena" aria-label="antenna pass" aria-describedby="addon-wrapping-left" name="antenna_password" value="{{$clienteWifi ? $clienteWifi->pivot->antenna_password : ''}}">
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
                                                <input type="text" class="form-control" placeholder="Contraseña del router" aria-label="router pass" aria-describedby="addon-wrapping-left" name="router_password" value="{{$clienteWifi ? $clienteWifi->pivot->router_password : ''}}">
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
                                                        <input type="text" class="form-control" id="datepicker-1" name="date_start" placeholder="Fechad de pago" value="{{$clienteWifi ? Carbon\Carbon::parse($clienteWifi->pivot->date_start)->format('Y/ m/d') : ''}}">
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
                                                        <input type="text" class="form-control" id="datepicker-2" name="date_expiration" placeholder="Fecha vence" value="{{$clienteWifi ?  Carbon\Carbon::parse($clienteWifi->pivot->date_expiration)->format('Y/ m/d'): ''}}">           
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    
                                    
                                    <button class="mt-3 btn btn-primary btn-block"> Actualizar Cliente</button>
                                </div>
                            
                        </div>        
                    </form>
                </div>                
            </div>
        </div>
    </div>   
</div>
@endsection

@push('stylesCss')
    <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">

@endpush
@push('scriptsJs') 
    <script src="{{ asset('smartadmin/js/datagrid/datatables/datatables.bundle.js') }}" ></script>  
    <script src="{{ asset('smartadmin/js/notifications/sweetalert2/sweetalert2.bundle.js') }}" ></script> 
    <script src="{{ asset('smartadmin/js/formplugins/inputmask/inputmask.bundle.js') }}" ></script> 
    <script src="{{ asset('smartadmin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}" ></script>  


    @include('admin.clientes.js.edit') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush