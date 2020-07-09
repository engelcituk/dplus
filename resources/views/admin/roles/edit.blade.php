@extends('admin.layout')

@section('content')
    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}" > <i class="fal fa-arrow-left"></i> Roles</a></li>
        <li class="breadcrumb-item">Configuración</li>
        <li class="breadcrumb-item">Roles</li>
        <li class="breadcrumb-item active">Editar</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> 

<div class="row">    
    <div class="col-md-6 ">
            
        <div id="panel-2" class="panel">
            <div class="panel-hdr">
                <h2>
                    Datos del <span class="fw-300"><i>rol</i></span>
                </h2> 

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
                    <form action="{{route('admin.roles.update',$role)}}" method="POST">
                        @csrf  {{ method_field('PUT') }}
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Identificador:</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" placeholder="Nombre completo del rol" aria-label="Nombre completo del rol" aria-describedby="addon-wrapping-left" value="{{$role->name}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="addon-wrapping-left">Nombre del rol</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                </div>
                            <input type="text" class="form-control" placeholder="Nombre del rol" aria-label="Nombre  del rol" aria-describedby="addon-wrapping-left" name="display_name" value="{{ old('display_name',$role->display_name)}}">
                            </div>
                        </div>
                     
                        <div class="row">
                            @foreach ($permissions as $id => $name)
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="permiso{{$id}}" 
                                            value="{{$name}}"
        
                                            {{ $role->permissions->contains($id) || collect(old('permissions'))->contains($name) ? 'checked':''}} 
                                            name="permissions[]"
                                        >
                                        <label class="custom-control-label" for="permiso{{$id}}">{{$name}}</label>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        <button class="mt-3 btn btn-primary btn-block"> Actualizar rol</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
          
    </div>    
</div>
@endsection

