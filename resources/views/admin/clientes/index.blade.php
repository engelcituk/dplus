@extends('admin.layout')

@section('content')
    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" >DPlus</a></li>
    <li class="breadcrumb-item">Administracion</li>
    <li class="breadcrumb-item">Clientes</li>
    <li class="breadcrumb-item active">Lista</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
    
<div class="row">
    <div class="col-md-12">
        @can('create', $clientes->first())
            <a href="{{route('admin.clientes.create')}}" class="btn btn-primary" > <i class="fal fa-pen"></i> Registrar cliente</a>
        @endcan
         
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Lista de  <span class="fw-300"><i>clientes</i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                    <table id="tablaClientes" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clientes as $cliente)
                                <tr>
                                <td>{{$cliente->id}}</td>

                                <td>{{$cliente->name}}</td>
                                <td>
                                    @can('view', $cliente)
                                        <a class="btn btn-info btn-sm" href="{{route('admin.clientes.show', $cliente)}}"><i class="fal fa-eye"></i> </a>
                                    @endcan
                                     
                                    @can('update', $cliente)
                                        <a class="btn btn-primary btn-sm" href="{{route('admin.clientes.edit', $cliente)}}"><i class="fal fa-edit"></i> </a>
                                    @endcan
                                    
                                    @can('delete', $cliente)
                                        <button class="btn btn-danger btn-sm" onclick="borrarCliente({{$cliente->id}})"><i class="fal fa-trash"></i>
                                    </button>
                                    @endcan
                                    
                                </td> 
                                </tr>
                                @empty
                                <tr>
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
    @include('admin.clientes.js.index') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush
