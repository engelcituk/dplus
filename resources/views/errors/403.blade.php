@extends('admin.layout')

@section('content')
    @include('admin.shared.flash-messages') {{-- incluyo el bloque para mensajes flash --}}  
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{url()->previous()}}" > <i class="fal fa-arrow-left"></i> Home</a></li>
        <li class="breadcrumb-item">Error</li>
        <li class="breadcrumb-item">403</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol> 

    <div class="h-alt-hf d-flex flex-column align-items-center justify-content-center text-center">
        <h1 class="page-error color-fusion-500">
            ERROR <span class="text-gradient">403</span>
            <small class="fw-500">
                No tienes autorización <u>para la</u> acción!
            </small>
        </h1>
        <h3 class="fw-500 mb-5">
          <span style="color:red">{{$exception->getMessage()}}</span>  
        </h3>
        <h4>
            <a href="{{url()->previous()}}"><i class="fal fa-arrow-left"></i></a> Regresar a la página anterior 
        </h4>
    </div>
@endsection

