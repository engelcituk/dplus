@extends('admin.layout')

@section('content')

@include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.recargas.index')}}" > <i class="fal fa-arrow-left"></i> recargas</a></li>
    <li class="breadcrumb-item">Configuración</li>
    <li class="breadcrumb-item">Servicios</li>
    <li class="breadcrumb-item">recargas</li>
    <li class="breadcrumb-item active">Editar</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol> 

<div class="row"> 
    <div class="col-md-12 ">
        <div class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos del <span class="fw-300"><i>recarga</i></span>
                </h2> 
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.recargas.update',$recarga)}}" method="POST">
                    @csrf
                    @csrf  {{ method_field('PUT') }}                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Código de barras</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-barcode fs-xl"></i></span>
                                        </div>
                                    <input type="text" class="form-control" placeholder="Código de barras" aria-label="código de barras" aria-describedby="addon-wrapping-left" name="code" value="{{ old('code',$recarga->code)}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="selectPeriodo">Selecciona categoría</label>
                                    <select class="form-control" name="category_id">
                                        @forelse ($categorias as $categoria)
                                            <option value="{{$categoria->id}}"
                                                    {{ old('category_id',$recarga->category_id ) == $categoria->id ? 'selected': '' }}> {{$categoria->name}} </option>
                                        @empty
                                            <option value="">Sin datos</option>
                                        @endforelse
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label" for="descripción">Descripción</label>
                                    <textarea class="form-control" name="description" id="descripción" rows="1">{{ old('description',$recarga->description)}}</textarea>
                                </div>
                                
                                
                                <div class="frame-wrap">
                                    <label class="form-label" for="descripción">IVA 16%</label><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="radioSiIva" name="iva" value="1" {{ old('iva',$recarga->iva == 1) ? 'checked':''}} required>
                                        <label class="custom-control-label" for="radioSiIva">Sí</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="radioNoIva" name="iva" value="0" {{ old('iva',$recarga->iva == 0) ? 'checked':''}} required>
                                        <label class="custom-control-label" for="radioNoIva">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Precio" aria-label="Precio" aria-describedby="addon-wrapping-left" id="precio" name="price" value="{{ old('price',$recarga->price)}}" onkeyup="calculoPrecioFinal()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Comisión</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Comision" aria-label="Comision" aria-describedby="addon-wrapping-left" id="comision" name="commission" value="{{ old('commission',$recarga->commission)}}" onkeyup="calculoPrecioFinal()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio final</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Precio" aria-label="Precio" aria-describedby="addon-wrapping-left" id="precioFinal" name="final_price" value="{{ old('final_price',$recarga->final_price)}}" readonly>
                                    </div>
                                </div>
                                
                                <button class="mt-3 btn btn-primary btn-block"> Actualizar recargao</button>
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
    <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
@endpush

@push('scriptsJs')  
    <script src="{{ asset('smartadmin/js/notifications/sweetalert2/sweetalert2.bundle.js') }}" ></script>   
    @include('admin.recargas.js.edit') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush