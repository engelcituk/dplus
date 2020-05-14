@extends('admin.layout')

@section('content')
@include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" >DPlus</a></li>
    <li class="breadcrumb-item">Administracion</li>
    <li class="breadcrumb-item">Servicios</li>
    <li class="breadcrumb-item">Internet</li>
    <li class="breadcrumb-item active">Lista</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
    
<div class="row">
    <div class="col-xl-12">
        @can('create', $serviciosInternet->first())
            <a href="{{route('admin.internet.create')}}" class="btn btn-primary" > <i class="fal fa-pen"></i> Registrar servicio internet</a> 
        @endcan
        
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Lista de  <span class="fw-300"><i>internet</i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                    <table id="tablaInternet" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Recurrencia</th>
                                <th>Precio</th>
                                <th>Seguro</th>
                                <th>Precio final</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($serviciosInternet as $internet)
                                <tr>
                                    <td>{{$internet->id}}</td>
                                    <td>{{$internet->name}}</td>
                                    <td>{{$internet->periodo->days_number}} días</td>                                    
                                    <td>{{$internet->price}}</td>
                                    <td>{{$internet->assurance}}</td>
                                    <td>{{$internet->final_price}}</td>
                                    <td>
                                        @can('view', $internet)
                                            <a class="btn btn-info btn-sm" href="{{route('admin.internet.show', $internet)}}"><i class="fal fa-eye"></i> </a> 
                                        @endcan                                        
                                        @can('update', $internet)
                                            <a class="btn btn-primary btn-sm" href="{{route('admin.internet.edit', $internet)}}"><i class="fal fa-edit"></i> </a>
                                        @endcan
                                        @can('delete', Model::class)
                                            <button class="btn btn-danger btn-sm" onclick="borrarServicioInternet({{$internet->id}})"><i class="fal fa-trash"></i>
                                        </button>
                                        @endcan
                                       
                                    </td> 
                                </tr>
                                @empty
                                <tr>
                                    <td>:(</td>
                                    <td>:(</td>
                                    <td>:(</td>
                                    <td>:(</td>
                                    <td>:(</td>
                                    <td>:(</td>
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
    @include('admin.internet.js.index') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush
