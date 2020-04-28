@extends('admin.layout')

@section('content')
    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.periododias.index')}}" > <i class="fal fa-arrow-left"></i> Periodo de días</a></li>
        <li class="breadcrumb-item">Configuración</li>
        <li class="breadcrumb-item">Periodo día</li>
        <li class="breadcrumb-item active">Editar</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> 

<div class="row">    
    <div class="col-xl-6 ">
            
        <div id="panel-2" class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos del periodo de <span class="fw-300"><i>días</i></span>
                </h2> 

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.periododias.update', $periododia)}}" method="POST">
                        @csrf  {{ method_field('PUT') }}
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Número del periodo de días</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" placeholder="Número" aria-label="Número" aria-describedby="addon-wrapping-left" name="days_number" value="{{ old('days_number', $periododia->days_number)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="descripción">Descripción</label>
                            <textarea class="form-control" name="description"  rows="3">{{ old('description',$periododia->description)}}</textarea>
                        </div>
                        <button class="mt-3 btn btn-primary btn-block"> Actualizar periodo de días</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
          
    </div>    
</div>
@endsection

