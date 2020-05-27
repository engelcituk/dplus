@extends('admin.layout')

@section('content')
@include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" >DPlus</a></li>
    <li class="breadcrumb-item">Administracion</li>
    <li class="breadcrumb-item">Servicios</li>
    <li class="breadcrumb-item">TV</li>
    <li class="breadcrumb-item active">Lista</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
    
<div class="row">
    <div class="col-xl-12">
        @can('create', $products->first())
            <a href="{{route('admin.products.create')}}" class="btn btn-primary" > <i class="fal fa-pen"></i> Registrar producto</a> 
        @endcan        
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Lista de  <span class="fw-300"><i>productos</i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                    <table id="tblProductos" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                
                                <th>Categoría</th>
                                <th>Código de barras</th>
                                <th>Descripción</th>
                                <th>Precio costo</th>
                                <th>Precio venta</th>
                                <th>Precio mayoreo</th>
                                <th>Tiene inventario</th>
                                <th>Unidades</th>
                               
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->barcode}}</td>
                                    <td>{{$product->description}}</td>                                    
                                    <td>{{$product->price_cost}}</td>
                                    <td>{{$product->sale_price}}</td>
                                    <td>{{$product->wholesale_price}}</td>
                                    <td>{!! setSiNo($product->has_inventory) !!}</td>
                                    <td>{{$product->units}}</td>

                                    <td>
                                        @can('view', $product)
                                            <a class="btn btn-info btn-sm" href="{{route('admin.products.show', $product)}}"><i class="fal fa-eye"></i> </a> 
                                        @endcan
                                        @can('update', $product)
                                            <a class="btn btn-primary btn-sm" href="{{route('admin.products.edit', $product)}}"><i class="fal fa-edit"></i> </a>
                                        @endcan
                                        @can('delete', $product)
                                            <button class="btn btn-danger btn-sm" onclick="borrarProducto({{$product->id}})"><i class="fal fa-trash"></i>
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
    @include('admin.products.js.index') {{-- include con un file blade porque un archivo js no me permitía --}}
@endpush
