@extends('admin.layout')

@section('content')
    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}" > <i class="fal fa-arrow-left"></i> Categorías</a></li>
        <li class="breadcrumb-item">Configuración</li>
        <li class="breadcrumb-item">Categorías</li>
        <li class="breadcrumb-item active">Editar</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> 

<div class="row">    
    <div class="col-xl-6 ">

        <div id="panel-2" class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos del <span class="fw-300"><i>categoría</i></span>
                </h2> 

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.categories.update',$category)}}" method="POST">
                        @csrf  {{ method_field('PUT') }}
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Nombre de la categoría</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" placeholder="Nombre de la categoría" aria-label="Nombre completo" aria-describedby="addon-wrapping-left" name="name" value="{{ old('name', $category->name)}}">
                            </div>
                        </div>
                        <button class="mt-3 btn btn-primary btn-block"> Actualizar categoría</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">

    </div>    
</div>
@endsection