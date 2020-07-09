@extends('admin.layout')

@section('content')


    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.periododias.index')}}" > <i class="fal fa-arrow-left"></i> Categorías</a></li>
        <li class="breadcrumb-item">Configuración</li>
        <li class="breadcrumb-item">Periodo de días</li>
        <li class="breadcrumb-item active">Crear</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> 

<div class="row">    
    <div class="col-md-6 ">
            
        <div id="panel-2" class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos del periodo de <span class="fw-300"><i>días</i></span>
                </h2> 

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.periododias.store')}}" method="POST">
                        @csrf 
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Cantidad de días del periodo</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-sort-numeric-up fs-xl"></i></span>
                                </div>
                            <input type="number" class="form-control validarEntero" placeholder="Cantidad de días del periodo" aria-label="Cantidad de días del periodo" aria-describedby="addon-wrapping-left" name="days_number" value="{{ old('days_number')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="descripción">Descripción</label>
                            <textarea class="form-control" name="description" id="descripción" rows="3">{{ old('description')}}</textarea>
                        </div>
                        <button class="mt-3 btn btn-primary btn-block"> Crear Periodo de días</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
          
    </div>    
</div>
@endsection

@push('scriptsJs')   
    @include('admin.periododias.js.create') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush