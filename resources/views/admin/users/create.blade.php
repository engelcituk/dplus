@extends('admin.layout')

@section('content')


    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}" > <i class="fal fa-arrow-left"></i> Usuarios</a></li>
        <li class="breadcrumb-item">Administracion</li>
        <li class="breadcrumb-item">Usuarios</li>
        <li class="breadcrumb-item active">Crear</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> 

<div class="row">    
    <div class="col-md-6 ">
            
        <div id="panel-2" class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos del <span class="fw-300"><i>Usuario</i></span>
                </h2> 

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.users.store')}}" method="POST">
                        @csrf 
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Nombre completo del usuario</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" placeholder="Nombre completo" aria-label="Nombre completo" aria-describedby="addon-wrapping-left" name="name" value="{{ old('name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="form-label" for="addon-wrapping-left">Correo del usuario</label>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-envelope fs-xl"></i></span>
                                    </div> 
                                <input type="text" class="form-control" placeholder="" data-inputmask="'alias': 'email'"  aria-label="email" aria-describedby="addon-wrapping-left" name="email" value="{{ old('email')}}">
                                </div>
                            </div>
                        <button class="mt-3 btn btn-primary btn-block"> Crear usuario</button>

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
    <script src="{{ asset('smartadmin/js/formplugins/inputmask/inputmask.bundle.js') }}" ></script>  
    @include('admin.users.js.edit') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush