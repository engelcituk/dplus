@extends('admin.layout')

@section('content')
    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.permissions.index')}}" > <i class="fal fa-arrow-left"></i> Permisos</a></li>
        <li class="breadcrumb-item">Configuración</li>
        <li class="breadcrumb-item">Permisos</li>
        <li class="breadcrumb-item active">Editar</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> 

<div class="row">    
    <div class="col-md-6 ">
            
        <div id="panel-2" class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos del <span class="fw-300"><i>permiso</i></span>
                </h2> 

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.permissions.update',$permission)}}" method="POST">
                        @csrf  {{ method_field('PUT') }}
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Identificador:</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" placeholder="Nombre completo del permiso" aria-label="Nombre completo del permiso" aria-describedby="addon-wrapping-left" value="{{$permission->name}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Nombre del permiso</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" placeholder="Nombre del permiso" aria-label="Nombre  del permiso" aria-describedby="addon-wrapping-left" name="display_name" value="{{ old('display_name',$permission->display_name)}}">
                            </div>
                        </div>
                        <button class="mt-3 btn btn-primary btn-block"> Actualizar permiso</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
          
    </div>    
</div>
@endsection

