<div class="panel-container show">
        <div class="panel-content">
        @include('admin.shared.error-messages') {{-- incluyo el bloque para mensajes flash --}}  
            <form action="{{route('admin.clientes.update',$cliente)}}" method="POST">
                @csrf  {{ method_field('PUT') }}
                <div class="form-group">
                    <label class="form-label" for="addon-wrapping-left">Nombre completo del cliente</label>
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                        </div>
                    <input type="text" class="form-control" placeholder="Nombre completo" aria-label="Nombre completo" aria-describedby="addon-wrapping-left" name="name" value="{{ old('name', $cliente->name)}}">
                    </div>
                </div>
                <button class="mt-3 btn btn-primary btn-block"> Actualizar cliente</button>

            </form>
        </div>
    </div>