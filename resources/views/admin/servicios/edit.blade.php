@extends('admin.layout')

@section('content')

@include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.servicios.index')}}" > <i class="fal fa-arrow-left"></i> Servicios</a></li>
    <li class="breadcrumb-item">Configuración</li>
    <li class="breadcrumb-item">Servicio</li>
    <li class="breadcrumb-item active">Editar</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol> 

<div class="row"> 
    <div class="col-xl-12 ">
        <div class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos del <span class="fw-300"><i>servicio y precio</i></span>
                </h2> 
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.servicios.update',$servicio)}}" method="POST">
                        @csrf  {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Nombre  del servicio</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                        </div>
                                    <input type="text" class="form-control" placeholder="Nombre completo" aria-label="Nombre completo" aria-describedby="addon-wrapping-left" name="name" value="{{ old('name', $servicio->name)}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="selectCategoria">Selecciona categoría</label>
                                    <select class="form-control" name="category_id">
                                        @forelse ($categorias as $categoria)
                                            <option value="{{$categoria->id}}"
                                                    {{ old('category_id',$servicio->category_id ) == $categoria->id ? 'selected': '' }}> {{$categoria->name}} </option>
                                        @empty
                                            <option value="">Sin datos</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="selectPeriodo">Selecciona periodo de días</label>
                                    <select class="form-control" name="days_periods_id">
                                        @forelse ($periodos as $numDia)
                                            <option value="{{$numDia->id}}"
                                                    {{ old('days_periods_id',$servicio->days_periods_id ) == $numDia->id ? 'selected': '' }}> {{$numDia->days_number}} Días</option>
                                        @empty
                                            <option value="">Sin datos</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="descripcion">Descripción</label>
                                    <textarea class="form-control" name="description" id="descripcion" rows="3">{{ old('description', $servicio->description)}}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Precio" aria-label="Precio" aria-describedby="addon-wrapping-left" id="precio" name="price" value="{{ old('price', $servicio->price)}}" onchange="calculoPrecioFinal()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Comisión</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Comision"  aria-label="Comision" aria-describedby="addon-wrapping-left" id="comision" name="commission" value="{{ old('commission', $servicio->commission)}}" onchange="calculoPrecioFinal()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Seguro</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Comision"  aria-label="Comision" aria-describedby="addon-wrapping-left" id="seguro" name="assurance" value="{{ old('assurance', $servicio->assurance)}}" onchange="calculoPrecioFinal()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio Final</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control validarDecimal" placeholder="Precio final" aria-label="Precio final" aria-describedby="addon-wrapping-left" id="precioFinal" name="final_price" value="{{ old('final_price', $servicio->final_price)}}" readonly>
                                    </div>
                                </div>
                                <button class="mt-3 btn btn-primary btn-block"> Actualizar servicio</button>
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
    @include('admin.servicios.js.create') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush