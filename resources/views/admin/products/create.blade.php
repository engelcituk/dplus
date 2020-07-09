@extends('admin.layout')

@section('content')

@include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}" > <i class="fal fa-arrow-left"></i> Servicios</a></li>
    <li class="breadcrumb-item">Configuración</li>
    <li class="breadcrumb-item">Servicios</li>
    <li class="breadcrumb-item">Productos</li>
    <li class="breadcrumb-item active">Crear</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol> 

<div class="row"> 
    <div class="col-md-12 ">
        <div class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos del <span class="fw-300"><i>producto</i></span>
                </h2> 
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.products.store')}}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Código de barras</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-barcode fs-xl"></i></span>
                                        </div>
                                    <input type="text" class="form-control" placeholder="Código de barras" aria-label="código de barras" aria-describedby="addon-wrapping-left" name="code" value="{{ old('code')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="form-label" for="selectPeriodo">Selecciona categoría</label>
                                        <select class="form-control" name="category_id">
                                            @forelse ($categorias as $categoria)
                                                <option value="{{$categoria->id}}"
                                                        {{ old('category_id') == $categoria->id ? 'selected' : ''}}
                                                        >{{$categoria->name}}</option>
                                            @empty
                                                <option value="">Sin datos</option>
                                            @endforelse
                                        </select>
                                    </div>
                                
                                <div class="form-group">
                                    <label class="form-label" for="descripción">Descripción</label>
                                    <textarea class="form-control" name="description" id="descripción" rows="1">{{ old('description')}}</textarea>
                                </div>
                                
                                <div class="frame-wrap">
                                    
                                    <label class="form-label" for="descripción">Tiene inventario</label><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="radioSi" name="has_inventory" value="1" required>
                                        <label class="custom-control-label" for="radioSi">Sí</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="radioNo" name="has_inventory" value="0" required>
                                        <label class="custom-control-label" for="radioNo">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio Costo</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Precio costo" aria-label="Precio costo" aria-describedby="addon-wrapping-left" id="precioCosto" name="price_cost" value="{{ old('price_cost')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio venta</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Precio" aria-label="Precio" aria-describedby="addon-wrapping-left" id="precioVenta" name="sale_price" value="{{ old('sale_price')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio mayoreo</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Precio" aria-label="Precio" aria-describedby="addon-wrapping-left" id="precioMayoreo" name="wholesale_price" value="{{ old('wholesale_price')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Unidades</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" class="form-control" placeholder="Unidades"  aria-label="Unidades" aria-describedby="addon-wrapping-left" id="unidades" name="units" value="{{ old('units')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Mínimo</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" class="form-control" placeholder="Minimo" aria-label="Minimo" aria-describedby="addon-wrapping-left" id="precioFinal" name="minimum" value="{{ old('minimum')}}">
                                    </div>
                                </div>
                                <button class="mt-3 btn btn-primary btn-block"> Crear producto</button>
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
    @include('admin.products.js.create') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush