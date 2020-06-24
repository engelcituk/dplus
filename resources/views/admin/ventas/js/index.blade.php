<script>
let csrf_token = $('meta[name="csrf-token"]').attr('content');     

function buscarClientes(){
  let datosCliente= $('#clienteReferencia').val();
  
  if (datosCliente != '' && datosCliente.length > 1) {
    $.ajax({
      url: "{{ url('admin/ventas/clienteservicios') }}" ,
      type: "GET",
      data: {
          '_method': 'GET',
          '_token': csrf_token,
          'datosCliente': datosCliente
      },
      success: function(respuesta) {
          var ok= respuesta.ok;
          if(ok){
            clientes = respuesta.clientes;
            console.log(clientes);
            listaClientes = `
            <table class="table table-bordered m-2">
                <thead>
                    <tr>
                        <th>Nombre Cliente</th>
                        <th>Referencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
              <tbody>`
              for(i = 0; i < clientes.length; i++){
                let idCliente = clientes[i].idCliente
                let idTV = clientes[i].idTelevision
                let nombreCliente = clientes[i].name
                let referencia = clientes[i].referencia
                listaClientes += `
                <tr>
                  <td>${nombreCliente}</td>
                  <td> <span id="ref${idCliente}">${referencia}</span></td>
                  <td>
                    <button type="button" class="btn btn-primary xs" onclick="copiar(${idCliente})"><i class="fal fa-copy"></i></button>
                    <button type="button" class="btn btn-info xs" onclick="getDataServicioTVCliente(${idCliente}, ${idTV}, '${nombreCliente}',${referencia})">
                      <i class="fal fa-plus-circle"></i>
                    </button
                  </td>
              </tr>`;
              }
            listaClientes += `</tbody></table>`;
            $("#listaClientes").html(listaClientes);
          }else {
            console.log(respuesta.mensaje)
        } 
      },
      error: function(respuesta) {
          swal({
              title: 'Oops...',
              text: '¡Algo salió mal!'+respuesta,
              type: 'error',
              timer: '1500'
          })
      }
    });
  }else {
    console.log("campos vacios o caracteres muy limitados");
    $("#listaClientes").html('');
  }
}
function buscarProductos(){
  let datosProducto = $('#nameBarcodeProducto').val();
  
 if (datosProducto != '' && datosProducto.length > 1) {
    $.ajax({
      url: "{{ url('admin/ventas/listaproductos') }}" ,
      type: "GET",
      data: {
          '_method': 'GET',
          '_token': csrf_token,
          'datosProducto': datosProducto
      },
      success: function(respuesta) {
          var ok= respuesta.ok;
          if(ok){
            productos = respuesta.productos;
            listaProductos = `
              <table class="table table-bordered m-2">
                <thead>
                    <tr>
                        <th>IMG</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Existencia</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
              <tbody>`

            for(i = 0; i < productos.length; i++){
              let idProducto = productos[i].id
              let code = productos[i].code
              let nombreProducto = productos[i].description
              let precio = productos[i].sale_price
              let unidades = productos[i].units
 
              listaProductos += `
              <tr>
                <td><button type="button" class="btn btn-info xs"><i class="fal fa-image"></i></button></td>                
                <td>${code}</td>
                <td>${nombreProducto}</td>
                <td>${unidades}</td>
                <td>${precio}</td>
                <td><button type="button" class="btn btn-info xs" onclick="addProducto(${idProducto},'${code}','${nombreProducto}','${precio}',${unidades})"><i class="fal fa-plus-circle"></i></button></td>
              </tr>`;
            }
          listaProductos += `</tbody></table>`
        
        $("#listaProductos").html(listaProductos);

        } else {
            console.log(respuesta.mensaje)
        } 
      },
      error: function(respuesta) {
          swal({
              title: 'Oops...',
              text: '¡Algo salió mal!'+respuesta,
              type: 'error',
              timer: '1500'
          })
      }
    });
  }else {
    console.log("campos vacios o caracteres muy limitados");
    $("#listaProductos").html('');
  }
}
</script>