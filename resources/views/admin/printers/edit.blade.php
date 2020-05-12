@extends('admin.layout')

@section('content')


    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.printers.index')}}" > <i class="fal fa-arrow-left"></i>impresoras T</a></li>
        <li class="breadcrumb-item">Administracion</li>
        <li class="breadcrumb-item">Impresora</li>
        <li class="breadcrumb-item active">editar</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> 

<div class="row">    
    <div class="col-xl-6 ">
            
        <div id="panel-2" class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos de la <span class="fw-300"><i>impresora de tickets</i></span>
                </h2> 

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.printers.update',$printer)}}" method="POST">
                        @csrf  {{ method_field('PUT') }}                        
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Nombre completo de la impresora de tickets</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-wifi fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" placeholder="Nombre completo" aria-label="Nombre completo" aria-describedby="addon-wrapping-left" name="name" value="{{ old('name',$printer->name)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Nombre de la impresora compartida</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-wifi fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" placeholder="nombre del compartido"  aria-label="dirección ip" aria-describedby="addon-wrapping-left" name="shared_name" value="{{ old('shared_name',$printer->shared_name)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Ip de la impresora de tickets</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-wifi fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" placeholder="" data-inputmask="'alias': 'ip'"  aria-label="dirección ip" aria-describedby="addon-wrapping-left" name="ip" value="{{ old('ip',$printer->ip)}}">
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="addon-wrapping-left">Estado de la impresora</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="disponible{{$printer->id}}" 
                                        value="1"
                                        {{ old('available',$printer->available) ? 'checked':''}} 
                                        name="available"
                                    >
                                    <label class="custom-control-label" for="disponible{{$printer->id}}">Disponible</label>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <label class="form-label" for="addon-wrapping-left">¿Es la impresora predeterminada?</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="predeterminada{{$printer->id}}" 
                                        value="1"
                                        {{ old('default',$printer->default) ? 'checked':''}} 
                                        name="default"
                                    >
                                    <label class="custom-control-label" for="predeterminada{{$printer->id}}">Sí</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="selectPeriodo">Selecciona modo de uso de la impresora ticket</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-wifi fs-xl"></i></span>
                                </div>
                                <select class="form-control" name="use_mode" required>
                                    <option value="compartido" {{old('use_mode', $printer->use_mode) == 'compartido' ? 'selected': '' }}>Por impresora compartida</option>
                                    <option value="ip" {{old('use_mode', $printer->use_mode) == 'ip' ? 'selected': '' }}>Por ip</option>
                                    
                                </select>
                            </div>
                        </div>

                        <button class="mt-6 btn btn-primary btn-block">Actualizar impresora de tickets</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
          
    </div>    
</div>
@endsection
@push('scriptsJs')
    <script src="{{ asset('smartadmin/js/formplugins/inputmask/inputmask.bundle.js') }}" ></script>  
    @include('admin.printers.js.edit') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush
