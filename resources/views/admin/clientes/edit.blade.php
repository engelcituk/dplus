@extends('admin.layout')

@section('content')
    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.clientes.index')}}" > <i class="fal fa-arrow-left"></i> Clientes</a></li>
        <li class="breadcrumb-item">Administracion</li>
        <li class="breadcrumb-item">Clientes</li>
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
                    <form action="{{route('admin.clientes.update',$cliente)}}" method="POST">
                        @csrf  {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="form-label" for="addon-wrapping-left">Nombre completo del cliente</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                        </div>
                                    <input type="text" class="form-control" placeholder="Nombre completo" aria-label="Nombre completo" aria-describedby="addon-wrapping-left" name="name" value="{{ old('name', $cliente->name)}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="form-label" for="selectPeriodo">Selecciona servicio de TV</label>
                                    <select class="form-control" name="televisions[]">
                                        <option value="">Selecciona</option>
                                        @forelse ($tvServicios as $stv)
                                            <option {{collect(old('televisions',$cliente->televisions->pluck('id')))->contains($stv->id) ? 'selected': '' }} value="{{$stv->id}}"> {{$stv->name}} </option>
                                        @empty
                                            <option value="">Sin datos</option>
                                        @endforelse
                                    </select>
                                </div>
                                
                            </div>
                            <button class="mt-3 btn btn-primary btn-block"> Actualizar Cliente</button>
                        </div>        
                    </form>
                </div>                
            </div>
        </div>
    </div>   
</div>
@endsection

