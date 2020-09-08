@extends('admin.layout')

@section('content')

@include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.recargas.index')}}" > <i class="fal fa-arrow-left"></i> Servicios</a></li>
    <li class="breadcrumb-item">Configuración</li>
    <li class="breadcrumb-item">Servicios</li>
    <li class="breadcrumb-item">Recargas</li>
    <li class="breadcrumb-item active">Crear</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol> 

<div class="row"> 
    <div class="col-md-12 ">
        <div class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos de la <span class="fw-300"><i>recarga</i></span>
                </h2> 
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.recargas.store')}}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Código</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-barcode fs-xl"></i></span>
                                        </div>
                                    <input type="text" class="form-control" placeholder="Código único" aria-label="código" aria-describedby="addon-wrapping-left" name="code" value="{{ old('code')}}">
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
                                        <label class="form-label" for="descripción">IVA 16%</label><br>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="radioSiIva" name="iva" value="1" {{(old('iva') == '1') ? 'checked' : ''}} required>
                                            <label class="custom-control-label" for="radioSiIva">Sí</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="radioNoIva" name="iva" value="0"  {{(old('iva') == '0') ? 'checked' : ''}} required>
                                            <label class="custom-control-label" for="radioNoIva">No</label>
                                        </div>
                                    </div>
                                
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio </label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Precio" id="precio" name="price" value="{{ old('price')}}" onkeyup="calculoPrecioFinal()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Comisión</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="comision" aria-label="comision" aria-describedby="addon-wrapping-left" id="comision" name="commission" value="{{ old('commission')}}" onkeyup="calculoPrecioFinal()">
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio final</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Precio final" aria-label="Precio" aria-describedby="addon-wrapping-left" id="precioFinal" name="final_price" value="{{ old('final_price')}}" readonly>
                                    </div>
                                </div>
                            
                                <button class="mt-3 btn btn-primary btn-block"> Crear recarga</button>
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
    @include('admin.recargas.js.create') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush