<script>
const csrf_token = $('meta[name="csrf-token"]').attr('content');    
const auth_user_id = $('meta[name="user_id"]').attr('content');     


function buscarClientes(){
  const datosCliente= $('#clienteReferencia').val();
  if (datosCliente != '' && datosCliente.length > 1) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
    $.ajax({
      url: "{{ url('admin/ventas/clienteservicios') }}" ,
      type: "GET",
      data: {
          'datosCliente': datosCliente
      },
      success: function(respuesta) {
          const ok= respuesta.ok;
          if(ok){
            clientes = respuesta.clientes;
            listaClientes = `
            <table class="table table-bordered m-2">
                <thead>
                    <tr>
                        <th>Nombre Cliente</th>
                        <th>Código</th>
                        <th>Referencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
              <tbody>`
              for(i = 0; i < clientes.length; i++){
                let idCliente = clientes[i].idCliente
                let idTV = clientes[i].idTelevision
                let code = clientes[i].code
                let nombreCliente = clientes[i].name
                let referencia = clientes[i].referencia
                listaClientes += `
                <tr>
                  <td>${nombreCliente}</td>
                  <td>${code}</td>
                  <td> <span id="ref${idCliente}">${referencia}</span></td>
                  <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="getDataCliente(${idCliente})"><i class="fal fa-edit"></i></button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="copiar(${idCliente})"><i class="fal fa-copy"></i></button>
                    <button type="button" class="btn btn-info btn-sm" onclick="getDataServicioTVCliente(${idCliente}, ${idTV},'${code}','${nombreCliente}','${referencia}')">
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
    //console.log("campos vacios o caracteres muy limitados");
    $("#listaClientes").html('');
  }
}
function buscarProductos(event){
  let datosProducto = $('#nameBarcodeProducto').val();
  const isNumber = esNumero(datosProducto);
  const codigoClave = event.keyCode;
  const ticketActivo = getTicketActivo();
  const listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
    
 if (datosProducto != '' && datosProducto.length > 1) {
   $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
    $.ajax({
      url: "{{ url('admin/ventas/listaproductos') }}" ,
      type: "GET",
      data: {
          'datosProducto': datosProducto
      },
      success: function(respuesta) {
          const ok= respuesta.ok;
          if(ok){
            productos = respuesta.productos;
            longitud = productos.length;            
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
                  const idProducto = productos[i].id
                  const code = productos[i].code
                  const nombreProducto = productos[i].description
                  const precio = productos[i].sale_price
                  const precioMayoreo = productos[i].wholesale_price
                  const unidades = productos[i].units
    
                  listaProductos += `
                  <tr>
                    <td><button type="button" class="btn btn-info btn-sm"><i class="fal fa-image"></i></button></td>                
                    <td>${code}</td>
                    <td>${nombreProducto}</td>
                    <td>${unidades}</td>
                    <td>${precio}</td>
                    <td><button type="button" class="btn btn-info btn-sm" onclick="addProducto(${idProducto},'${code}','${nombreProducto}','${precio}','${precioMayoreo}',${unidades})"><i class="fal fa-plus-circle"></i></button></td>
                  </tr>`;
                }
                listaProductos += `</tbody></table>`
                $("#listaProductos").html(listaProductos);
                if(codigoClave == '13' && longitud==1){            
                    if(localStorage.getItem(ticketActivo.ticket)){
                      const idProducto = productos[0].id
                      const code = productos[0].code
                      const nombreProducto = productos[0].description
                      const precio = productos[0].sale_price
                      const precioMayoreo = productos[0].wholesale_price
                      const unidades = productos[0].units
                      addProducto(idProducto,code,nombreProducto,precio,precioMayoreo,unidades);
                      $('#nameBarcodeProducto').val('')
                      $("#listaProductos").html('');
                    } 
                }         
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
    //console.log("campos vacios o caracteres muy limitados");
    $("#listaProductos").html('');
  }
}
function esNumero(cadena) {
  if (!isNaN(cadena)) {
    return true;
  } else {
    return false;
  }
}
</script>