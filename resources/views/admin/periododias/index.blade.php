@extends('admin.layout')

@section('content')
    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" >DPlus</a></li>
    <li class="breadcrumb-item">Configuración</li>
    <li class="breadcrumb-item">Periodo de días</li>
    <li class="breadcrumb-item active">Lista</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
    
<div class="row">
    <div class="col-md-12">
        @can('create', $periodoDias->first())
            <a href="{{route('admin.periododias.create')}}" class="btn btn-primary" > <i class="fal fa-pen"></i> Registrar periodo</a>
        @endcan         
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Lista de  <span class="fw-300"><i>periodo de días</i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                    <table id="tablaPeriodoDias" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Num. de Días</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($periodoDias as $pd)
                                <tr>
                                    <td>{{$pd->id}}</td>
                                    <td>{{$pd->days_number}}</td>
                                    <td>{{$pd->description}}</td>
                                <td>
                                    @can('view', $pd)
                                        <a class="btn btn-info btn-sm" href="{{route('admin.periododias.show', $pd)}}"><i class="fal fa-eye"></i> </a> 
                                    @endcan
                                    @can('update', $pd)
                                        <a class="btn btn-primary btn-sm" href="{{route('admin.periododias.edit', $pd)}}"><i class="fal fa-edit"></i> </a>
                                    @endcan
                                    @can('delete', $pd)
                                        <button class="btn btn-danger btn-sm" onclick="borrarPeriodoDia({{$pd->id}})"><i class="fal fa-trash"></i>
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
    @include('admin.periododias.js.index') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush
