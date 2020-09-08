@extends('admin.layout')

@section('content')
@include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" >DPlus</a></li>
    <li class="breadcrumb-item">Administracion</li>
    <li class="breadcrumb-item">Servicios</li>
    <li class="breadcrumb-item">Recarga</li>
    <li class="breadcrumb-item active">Lista</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
    
<div class="row">
    <div class="col-md-12">
        @can('create', $recargas->first())
            <a href="{{route('admin.recargas.create')}}" class="btn btn-primary" > <i class="fal fa-pen"></i> Registrar recarga</a> 
        @endcan        
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Lista de  <span class="fw-300"><i>recargas</i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                    <table id="tblRecargas" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Comisión </th>
                                <th>Iva</th>
                                <th>Precio final</th>   
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recargas as $recarga)
                                <tr>
                                    <td>{{$recarga->code}}</td>
                                    <td>{{$recarga->category->name}}</td>
                                    <td>{{$recarga->description}}</td>                                    
                                    <td>{{$recarga->price}}</td>
                                    <td>{{$recarga->commission}}</td>
                                    <td>{!! setSiNo($recarga->iva) !!}</td>
                                    <td>{{$recarga->final_price}}</td>
                                    
                                    <td>
                                        @can('view', $recarga)
                                            <a class="btn btn-info btn-sm" href="{{route('admin.recargas.show', $recarga)}}"><i class="fal fa-eye"></i> </a> 
                                        @endcan
                                        @can('update', $recarga)
                                            <a class="btn btn-primary btn-sm" href="{{route('admin.recargas.edit', $recarga)}}"><i class="fal fa-edit"></i> </a>
                                        @endcan
                                        @can('delete', $recarga)
                                            <button class="btn btn-danger btn-sm" onclick="borrarRecarga({{$recarga->id}})"><i class="fal fa-trash"></i>
                                        @endcan
                                        </button>
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
    @include('admin.recargas.js.index') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush
