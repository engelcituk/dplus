<script>
const csrf_token = $('meta[name="csrf-token"]').attr('content');    
const auth_user_id = $('meta[name="user_id"]').attr('content');     


function buscarClientesTV(){
  const datosCliente= $('#clienteReferencia').val();
  if (datosCliente != '' && datosCliente.length > 1) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
    $.ajax({
      url: "{{ url('admin/ventas/clientestv') }}" ,
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
                let iva = clientes[i].iva
                let referencia = clientes[i].referencia
                listaClientes += `
                <tr>
                  <td>${nombreCliente}</td>
                  <td>${code}</td>
                  <td> <span id="ref${idCliente}">${referencia}</span></td>
                  <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="getDataClienteTV(${idCliente})"><i class="fal fa-edit"></i></button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="copiar(${idCliente})"><i class="fal fa-copy"></i></button>
                    <button type="button" class="btn btn-info btn-sm" onclick="getDataServicioTVCliente(${idCliente}, ${idTV},'${nombreCliente}','${referencia}')">
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
  //const isNumber = esNumero(datosProducto);
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
                  const iva = productos[i].iva
                  const precioMayoreo = productos[i].wholesale_price
                  const unidades = productos[i].units
    
                  listaProductos += `
                  <tr>
                    <td><button type="button" class="btn btn-info btn-sm"><i class="fal fa-image"></i></button></td>                
                    <td>${code}</td>
                    <td>${nombreProducto}</td>
                    <td>${unidades}</td>
                    <td>${precio}</td>
                    <td><button type="button" class="btn btn-info btn-sm" onclick="addProducto(${idProducto},'${code}','${nombreProducto}','${precio}','${precioMayoreo}',${unidades},${iva})"><i class="fal fa-plus-circle"></i></button></td>
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

function buscarClientesInternet(){
  const datosCliente= $('#nameClienteInternet').val();
  if (datosCliente != '' && datosCliente.length > 1) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
    $.ajax({
      url: "{{ url('admin/ventas/clientesinternet') }}" ,
      type: "GET",
      data: {
          'datosCliente': datosCliente
      },
      success: function(respuesta) {
          const ok= respuesta.ok;
          if(ok){
            clientes = respuesta.clientes;
            console.log(clientes);
            listaClientes = `
            <table class="table table-bordered m-2">
                <thead>
                    <tr>
                        <th>Nombre Cliente</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
              <tbody>`
              for(i = 0; i < clientes.length; i++){
                let idCliente = clientes[i].idCliente
                let idInternet = clientes[i].idInternet
                let code = clientes[i].code
                let nombreCliente = clientes[i].name
                let nombreServicio = clientes[i].nameServicio
                let description = clientes[i].description
                let precio = clientes[i].precio
                let seguro = clientes[i].seguro
                let precioFinal = clientes[i].precioFinal
                let iva = clientes[i].iva
                let dateExpiration = clientes[i].date_expiration

                listaClientes += `
                <tr>
                  <td>${nombreCliente}</td>
                  <td> <span id="ref${idCliente}">${description}</span></td>
                  <td>  
                    <button type="button" class="btn btn-primary btn-sm" onclick="getDataClienteInternet(${idCliente})"><i class="fal fa-edit"></i></button>
                    <button type="button" class="btn btn-info btn-sm" onclick="showModalServicioInternet(${idCliente},${idInternet},'${code}','${nombreServicio}','${nombreCliente}','${iva}','${description}','${precio}','${seguro}','${precioFinal}','${dateExpiration}')">
                      <i class="fal fa-plus-circle"></i>
                    </button
                  </td>
              </tr>`;
              }
            listaClientes += `</tbody></table>`;
            $("#listaClientesInternet").html(listaClientes);
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
    $("#listaClientesInternet").html('');
  }
}

function buscarRecargas(){
  const datosRecarga= $('#nameRecarga').val();
  if (datosRecarga != '' && datosRecarga.length > 1) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
    $.ajax({
      url: "{{ url('admin/ventas/recargas') }}" ,
      type: "GET",
      data: {
          'datosRecarga': datosRecarga
      },
      success: function(respuesta) {
          const ok = respuesta.ok;
          if(ok){
            recargas = respuesta.recargas;
            
            listaRecargas = `
            <table class="table table-bordered m-2">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Precio/Com.</th>
                        <th></th>
                    </tr>
                </thead>
              <tbody>`
              for(i = 0; i < recargas.length; i++){
                let idRecarga = recargas[i].id
                let code = recargas[i].code
                let description = recargas[i].description
                let price = recargas[i].price
                let commission = recargas[i].commission
                let finalPrice = recargas[i].final_price
                let iva = recargas[i].iva
                
                listaRecargas += `
                <tr>
                  <td>${code}</td>
                  <td>${description}</td>
                  <td>${price}+${commission}=${finalPrice}</td>  
                  <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="showModalServicioRecarga(${idRecarga},'${code}','${description}','${price}','${commission}','${finalPrice}','${iva}')">
                      <i class="fal fa-plus-circle"></i>
                    </button
                  </td>      
              </tr>`;
              }
            listaRecargas += `</tbody></table>`;
            $("#listaRecargas").html(listaRecargas);
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
    $("#listaRecargas").html('');
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