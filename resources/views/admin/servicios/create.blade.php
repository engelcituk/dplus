@extends('admin.layout')

@section('content')

@include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.servicios.index')}}" > <i class="fal fa-arrow-left"></i> Servicios</a></li>
    <li class="breadcrumb-item">Configuración</li>
    <li class="breadcrumb-item">Servicios</li>
    <li class="breadcrumb-item active">Crear</li>
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
                    <form action="{{route('admin.servicios.store')}}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Nombre  del servicio</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                        </div>
                                    <input type="text" class="form-control" placeholder="Nombre completo" aria-label="Nombre completo" aria-describedby="addon-wrapping-left" name="name" value="{{ old('name')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="selectCategoria">Selecciona categoría</label>
                                    <select class="form-control" name="category_id">
                                        @forelse ($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                                        @empty
                                            <option value="">Sin datos</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="descripción">Descripción</label>
                                    <textarea class="form-control" name="description" id="descripción" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control" placeholder="Precio" aria-label="Precio" aria-describedby="addon-wrapping-left" name="price" value="{{ old('name')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Comisión</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control" placeholder="Comision" aria-label="Comision" aria-describedby="addon-wrapping-left" name="commission" value="{{ old('commission')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Precio Final</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-dollar-sign fs-xl"></i></span>
                                        </div>
                                    <input type="number" step="0.01" class="form-control" placeholder="Precio final" aria-label="Precio final" aria-describedby="addon-wrapping-left" name="final_price" value="{{ old('final_price')}}" readonly>
                                    </div>
                                </div>
                                <button class="mt-3 btn btn-primary btn-block"> Crear servicio</button>
                            </div>
                        </div>        
                    </form>
                </div>                
            </div>
        </div>
    </div>   
</div>
@endsection

