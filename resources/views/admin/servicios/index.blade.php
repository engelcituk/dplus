@extends('admin.layout')

@section('content')
@include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" >DPlus</a></li>
    <li class="breadcrumb-item">Administracion</li>
    <li class="breadcrumb-item">Servicios</li>
    <li class="breadcrumb-item active">Lista</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
    
<div class="row">
    <div class="col-xl-12">
        <a href="{{route('admin.servicios.create')}}" class="btn btn-primary" > <i class="fal fa-pen"></i> Registrar servicio</a> 
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Lista de  <span class="fw-300"><i>servicios</i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                    <table id="tablaServicios" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Recurrencia</th>
                                <th>Precio</th>
                                <th>Comisión</th>
                                <th>Precio final</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($servicios as $servicio)
                                <tr>
                                    <td>{{$servicio->id}}</td>
                                    <td>{{$servicio->name}}</td>
                                    <td>{{$servicio->category->name}}</td>
                                    <td>{{$servicio->periodo->days_number}} días</td>                                    
                                    <td>{{$servicio->price}}</td>
                                    <td>{{$servicio->commission}}</td>
                                    <td>{{$servicio->final_price}}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="{{route('admin.servicios.show', $servicio)}}"><i class="fal fa-eye"></i> </a> 
                                        <a class="btn btn-primary btn-sm" href="{{route('admin.servicios.edit', $servicio)}}"><i class="fal fa-edit"></i> </a>
                                        <button class="btn btn-danger btn-sm" onclick="borrarServicio({{$servicio->id}})"><i class="fal fa-trash"></i>
                                        </button>
                                    </td> 
                                </tr>
                                @empty
                                <tr>
                                    <td>Sin servicio registrado</td>
                                    <td>Sin servicio registrado</td>
                                    <td>:(</td>

                                </tr>
                            @endforelse
                        </tbody>  
                    </table>
                    <!-- datatable end -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('stylesCss')
    <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
@endpush
@push('scriptsJs') 
    <script src="{{ asset('smartadmin/js/datagrid/datatables/datatables.bundle.js') }}" ></script>  
    <script src="{{ asset('smartadmin/js/notifications/sweetalert2/sweetalert2.bundle.js') }}" ></script>   
    @include('admin.servicios.js.index') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush
