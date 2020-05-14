@extends('admin.layout')

@section('content')
    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}" > <i class="fal fa-arrow-left"></i> Usuarios</a></li>
        <li class="breadcrumb-item">Configuración</li>
        <li class="breadcrumb-item">Usuario</li>
        <li class="breadcrumb-item active">Editar</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> 

    <div class="row">
        <div class="col-xl-12 ">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Datos del <span class="fw-300"><i>cliente y sus servicios</i></span>
                    </h2> 
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}} 
                            <div class="row">
                                <div class="col-xl-6">
                                    <form action="{{route('admin.users.update',$user)}}" method="POST">  
                                        @csrf  {{ method_field('PUT') }} 
                                        <div class="form-group">
                                                <label class="form-label" for="addon-wrapping-left">Nombre del usuario</label>
                                                <div class="input-group flex-nowrap">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                                    </div> 
                                                <input type="text" class="form-control" placeholder="nombre" aria-label="nombre" aria-describedby="addon-wrapping-left" name="name" value="{{ old('name', $user->name)}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="addon-wrapping-left">Email del usuario</label>
                                                <div class="input-group flex-nowrap">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fal fa-envelope fs-xl"></i></span>
                                                    </div> 
                                                <input type="text" class="form-control"  placeholder="" data-inputmask="'alias': 'email'"  aria-label="Número" aria-describedby="addon-wrapping-left" name="email" value="{{ old('email', $user->email)}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="addon-wrapping-left">Contraseña</label>
                                                <div class="input-group flex-nowrap">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fal fa-lock fs-xl"></i></span>
                                                    </div> 
                                                <input type="password" class="form-control"  placeholder="Contraseña"  aria-label="password" aria-describedby="addon-wrapping-left" name="password"> 
                                                </div>
                                                <span class="help-block">Dejar en blanco si no quieres cambiar la contraseña</span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                                                <div class="input-group flex-nowrap">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fal fa-lock fs-xl"></i></span>
                                                    </div> 
                                                <input type="password" class="form-control"  placeholder="Repite la contraseña"   aria-label="pass" aria-describedby="password_confirmation" name="password_confirmation">
                                                </div>
                                            </div>
                                            <button class="mt-3 btn btn-primary btn-block"> Actualizar datos del usuario</button> 
                                    </form>
                                </div>
                                <div class="col-xl-6">

                                    @role('Admin')
                                        <form action="{{route('admin.users.roles.update',$user)}}" method="POST">  
                                            @csrf  {{ method_field('PUT') }} 
                                            <label class="form-label" for="roles">Roles del usuario</label>
    
                                            @foreach ($roles as $role)
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="role{{$role->id}}" 
                                                        value="{{$role->name}}"
                                                        {{$user->roles->contains($role->id) ? 'checked':''}}
                                                        name="roles[]"
                                                    >
                                                    <label class="custom-control-label" for="role{{$role->id}}">{{$role->display_name}}</label>
                                                    <br>
                                                    <small class="text-muted">{{$role->permissions->pluck('display_name')->implode(', ')}}</small>
                                                </div>
                                            @endforeach
    
                                            <button class="mt-3 btn btn-primary btn-block"> Actualizar Roles del usuario</button> 
                                        </form>
                                    @else
                                        <label class="form-label" for="roles">Roles del usuario</label>
                                        <ul class="list-group">
                                            @forelse ($user->roles as $role)
                                                <li class="list-group-item">{{$role->display_name}}</li>
                                            @empty
                                                <li class="list-group-item">No tiene roles</li> 
                                            @endforelse
                                        </ul>
                                    @endrole

                                    @role('Admin')
                                        <form action="{{route('admin.users.permissions.update',$user)}}" method="POST">  
                                            @csrf  {{ method_field('PUT') }} 
                                            <label class="form-label" for="permisos">Permisos del usuario</label>
                                            <div class="row">
                                                @foreach ($permissions as $id => $name)
                                                    <div class="col-md-3">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="permiso{{$id}}" 
                                                                value="{{$name}}"
                                                                {{$user->permissions->contains($id) ? 'checked':''}}
                                                                name="permissions[]"
                                                            >
                                                            <label class="custom-control-label" for="permiso{{$id}}">{{$name}}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                                                                       
    
                                            <button class="mt-3 btn btn-primary btn-block"> Actualizar permisos del usuario</button> 
                                        </form>
                                    @else
                                        <label class="form-label" for="permisos">Permisos del usuario</label>
                                        <ul class="list-group">
                                            @forelse ($user->permissions as $permission)
                                                <li class="list-group-item">{{$permission->display_name}}</li>
                                            @empty
                                            <li class="list-group-item">Sin ningún permiso del usuario</li>                                            
                                            @endforelse
                                        </ul>
                                    @endrole
                                    
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scriptsJs')    
    <script src="{{ asset('smartadmin/js/formplugins/inputmask/inputmask.bundle.js') }}" ></script>  
    @include('admin.users.js.edit') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush