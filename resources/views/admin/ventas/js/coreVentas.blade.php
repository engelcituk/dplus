<script>
let listaTicketVentas = [];
let listaItems = [];

//copia en el portapapeles desde el listado de la busqueda
function copiar(idCliente){
  //var resultado = document.getElementById('resultado');
  var texto = document.querySelector('#ref'+idCliente);
  var rango = document.createRange();
  rango.selectNode(texto);
  window.getSelection().removeAllRanges();
  window.getSelection().addRange(rango);

  try {
    var successful = document.execCommand('copy');
    var mensaje = successful ? 'Referencia Copiada' : 'No se pudo copiar :c';
    showMessageNotify("Se ha copiado referencia en el portapapeles", "info", 3000)
    window.getSelection().removeAllRanges();
  } catch (e) {
    console.log(mensaje)    
  }
}

//copia a portapapeles desde un campo input en el modal
function copiarDesdeInput(){
  var resultado = document.getElementById('referenciaModalSpan');
  var texto = document.querySelector('#referenciaClienteInputTVService');
  var rango = document.createRange();
  rango.selectNode(texto);
  window.getSelection().removeAllRanges();
  window.getSelection().addRange(rango);
  try {
    var successful = document.execCommand('copy');
    var mensaje = successful ? 'Referencia Copiada' : 'No se pudo copiar :c';
    resultado.innerHTML = mensaje;
    window.getSelection().removeAllRanges();
  } catch (e) {
    console.log(mensaje)
  }
}

//para obtener los datos del servicio de tv del cliente
function getDataServicioTVCliente(idCliente, idTV, nombreCliente, referencia){
  $.ajax({
      url: "{{ url('admin/ventas/datostvservicio') }}" ,
      type: "GET",
      data: {
          '_method': 'GET',
          '_token': csrf_token,
          'idTvServicio': idTV
      },
      success: function(respuesta) {
          ok= respuesta.ok;
          if(ok){
            servicio = respuesta.servicioTV;
            showModalServicioTV(servicio, idCliente, idTV, nombreCliente, referencia);          
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
  })
}
//para obtener los datos del servicio de tv del cliente
function getDataServicioInternetCliente(idCliente, idInternet,nombreCliente, iva){
  $.ajax({
      url: "{{ url('admin/ventas/datostvservicio') }}" ,
      type: "GET",
      data: {
          '_method': 'GET',
          '_token': csrf_token,
          'idInternetServicio': idInternet
      },
      success: function(respuesta) {
          ok= respuesta.ok;
          if(ok){
            servicio = respuesta.servicioTV;
            showModalServicioTV(servicio, idCliente, idTV, nombreCliente, referencia);          
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
  })
}

// para mostrar el modal donde se pintan los datos de cliente y su servicio de internet
function showModalServicioInternet(idCliente, idInternet, code, nombreServicio, nombreCliente, iva, description, precio, seguro, precioFinal, dateExpiration){
  //le pinto los valores en los campos
  $('#idClienteServicioInternet').val(idCliente);
  $('#idServicioInternet').val(idInternet);
  $('#descripcionServicioInternet').val(nombreServicio);
  $('#ivaServicioInternet').val(iva);
  $('#nombreClienteServicioInternet').val(nombreCliente);
  $('#precioServicioInternet').val(precio);
  $('#seguroServicioInternet').val(seguro);
  $('#precioFinalServicioInternet').val(precioFinal);
  $('#codigoServicioInternet').val(code);
  $('#dateExpiration').val(dateExpiration.slice(0, -8));

  document.getElementById("aplyAssurance").checked = true;
  showTicketActivoEnModal();
  $('#servicioInternet').modal({backdrop: 'static', keyboard: false})
}

// para mostrar el modal donde se pintan los datos de la recarga
function showModalServicioRecarga(idRecarga, code, description, price, commission, finalPrice, iva){
  //le pinto los valores en los campos
  $('#idServicioRecarga').val(idRecarga);
  $('#codigoServicioRecarga').val(code);
  $('#descripcionServicioRecarga').val(description);
  $('#precioServicioRecarga').val(price);
  $('#comisionServicioRecarga').val(commission);
  $('#precioFinalServicioRecarga').val(finalPrice);
  $('#ivaServicioRecarga').val(iva);

  showTicketActivoEnModal();
  $('#servicioRecarga').modal({backdrop: 'static', keyboard: false})
}

// para cambiar el valor del precio final al considarar seguro
function addRemoveAssurance(){
  const precio = parseFloat($('#precioServicioInternet').val());
  const seguro = parseFloat ($('#seguroServicioInternet').val());
  
  precioFinal = precio + seguro;

  if (document.getElementById('aplyAssurance').checked){
    document.getElementById('precioFinalServicioInternet').value = (Math.round( precioFinal * 100) / 100).toFixed(2);
  } else {
    document.getElementById('precioFinalServicioInternet').value =  (Math.round(precio * 100) / 100).toFixed(2);
  }

}

// para mostrar el modal donde se pintan los datos de cliente y su servicio de tv
function showModalServicioTV(servicio, idCliente, idTV, nombreCliente, referencia){
  //le pinto los valores en los campos
  $('#idClienteInputTVService').val(idCliente);
  $('#idTvServicio').val(idTV);
  $('#codeTvService').val(servicio.code);
  $('#ivaTVServicio').val(servicio.iva);


  $('#nombreClienteInputTVService').val(nombreCliente);
  $('#referenciaClienteInputTVService').val(referencia);
 // document.getElementById('referenciaClienteInputTVService').onclick = copiar(idCliente);
  $("#referenciaClienteInputTVService").val(referencia);
  $('#nombreInputTVService').val(servicio.name);
  $('#precioInputTVService').val(servicio.price);
  $('#comisionInputTVService').val(servicio.commission);
  $('#precioFinalInputTVService').val(servicio.final_price);
  showTicketActivoEnModal();
  $('#servicioTV').modal({backdrop: 'static', keyboard: false})
}



function showTicketActivoEnModal(){
  if(localStorage.getItem('ticketsVentas')){
    listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
    const ticketActivo = getTicketActivo();
    button=`<button type="button" class="btn btn-primary" onclick="addServicioTVCliente()"><i class="fal fa-plus-square fs-xl"></i> ${ticketActivo.ticket}</button>`
    button2=`<button type="button" class="btn btn-primary" onclick="addServicioInternetCliente()"><i class="fal fa-plus-square fs-xl"></i> ${ticketActivo.ticket}</button>`
    button3=`<button type="button" class="btn btn-primary" onclick="addServicioRecarga()"><i class="fal fa-plus-square fs-xl"></i> ${ticketActivo.ticket}</button>`
    $("#lstTicketsTvServicios").html(button); 
    $("#lstTicketsServicioInternets").html(button2);  
    $("#lstTicketsServicioRecargas").html(button3);  


  }
}
/*=======================================================================
--- reseteo el contenido de los modales al cerrarlo
========================================================================*/
$('#servicioTV').on('hidden.bs.modal', function () {
    texto = document.getElementById('referenciaModalSpan');
    $('#servicioTV form')[0].reset();
    texto.innerHTML = '';
});

$('#servicioInternet').on('hidden.bs.modal', function () {
    $('#servicioInternet form')[0].reset();
});

$('#servicioRecarga').on('hidden.bs.modal', function () {
    $('#servicioRecarga form')[0].reset();
});

$('#modalNotaItem').on('hidden.bs.modal', function () {
    texto = document.getElementById('positionItemModalNote');
    $('#modalNotaItem form')[0].reset();
    texto.innerHTML = '';
});

$('#registrarClienteTV').on('hidden.bs.modal', function () {
    $('#registrarClienteTV form')[0].reset();
});

$('#cobrarVenta').on('hidden.bs.modal', function () {
    $('.btn-cobrar').prop('disabled', true);
    $('#cobrarVenta form')[0].reset();
});
/*=======================================================================
--- fin de reseteo el contenido de los modales al cerrarlo
========================================================================*/

// calculo el precio final con base al precio inicial + la comision
function calculoPrecioFinalTV(){
    
    let precio = document.getElementById("precioInputTVService").value;
    let comision = document.getElementById("comisionInputTVService").value;
    
    if( precio == ''){
        document.getElementById("precioInputTVService").value = 0.00;
        precio = 0.00;
    }
    if( comision == ''){
        document.getElementById("comisionInputTVService").value = 0.00;
        comision = 0.00;
    }
    
    precioFinal = parseFloat(precio) + parseFloat(comision);
    document.getElementById("precioFinalInputTVService").value = (Math.round(precioFinal * 100) / 100).toFixed(2);
}
//calcular el precio final del servicio de internet para el cliente
function calculoPrecioFinalInternet(){
  let precio = document.getElementById("precioServicioInternet").value;
  let seguro = document.getElementById("seguroServicioInternet").value;
    if( precio == ''){
        document.getElementById("precioServicioInternet").value = 0.00;
        precio = 0.00;
    }
    if( seguro == ''){
        document.getElementById("seguroServicioInternet").value = 0.00;
        seguro = 0.00;
    }

    precioFinal = parseFloat(precio) + parseFloat(seguro);

    if (document.getElementById('aplyAssurance').checked){
      document.getElementById('precioFinalServicioInternet').value = (Math.round( precioFinal * 100) / 100).toFixed(2);
    } else {
      document.getElementById('precioFinalServicioInternet').value =  (Math.round(precio * 100) / 100).toFixed(2);
    }

}

//calcular el precio final del servicio de recarga
function calculoPrecioFinalRecarga(){

  let precio = document.getElementById("precioServicioRecarga").value;
  let comision = document.getElementById("comisionServicioRecarga").value;

    if( precio == ''){
        document.getElementById("precioServicioRecarga").value = 0.00;
        precio = 0.00;
    }
    if( comision == ''){
        document.getElementById("comisionServicioRecarga").value = 0.00;
        comision = 0.00;
    }
    precioFinal = parseFloat(precio) + parseFloat(comision);
    document.getElementById('precioFinalServicioRecarga').value = (Math.round( precioFinal * 100) / 100).toFixed(2);
}

getTickets();
leerItemsTicket(); //leo el contenido de los tickets
showButtonsTickets()// muestro los botones de los tickets
function getTickets(){
  if(localStorage.getItem('ticketsVentas')){
    showDivTableTicket();
  }else {
    let ticket = Math.random().toString(36).substr(2, 9);
    let valor = [];
    //objeto ticket
    let datosTicket = {
      'ticket' : ticket,
      'estado':'activo',
      'totalesIVA':'0.00',
      'totalSinIVA':'0.00',
      'total':'0.00',
      'nota':''
    }
    listaTicketVentas.push(datosTicket);// se añade al array
    localStorage.setItem('ticketsVentas',JSON.stringify(listaTicketVentas));
    localStorage.setItem(ticket, JSON.stringify(valor));
    showDivTableTicket();
  }
}

/*=======================================================================
--- funciones para obtener primer ticket activo, desactivado, y por folio
--- posicion del ticket activo y del primer ticket desactivado
-- si se repite un elemento en el ticket activo
========================================================================*/
function getTicketActivo(){
  let listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  if (localStorage.getItem('ticketsVentas')) {
    const ticketActivo = listadoTickets.find( ticket => ticket.estado == 'activo' );
    return ticketActivo;
  }
}
function getPrimerTicketDesactivado(){
  let listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  if (localStorage.getItem('ticketsVentas')) {
    const ticketDesactivado = listadoTickets.find( ticket => ticket.estado == 'desactivado' );
    return ticketDesactivado;
  }
}
function getTicketByFolio(folio) {
  let listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  if (localStorage.getItem('ticketsVentas')) {
    const resultadoTicket = listadoTickets.find( ticket => ticket.ticket == folio );
    return resultadoTicket;
  }
}
function getPositionTicketActivo(){
  let listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  const ticketActivo = getTicketActivo();
  if (localStorage.getItem('ticketsVentas')) {
    const positionTicket = listadoTickets.findIndex(x => x.ticket == ticketActivo.ticket)
    return positionTicket;
  }
}
function getPositionPrimerTicketDesactivado(){
  let listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  const primerTicketDesactivado = getPrimerTicketDesactivado();
  if (localStorage.getItem('ticketsVentas')) {
    const positionTicket = listadoTickets.findIndex(x => x.ticket == primerTicketDesactivado.ticket)
    return positionTicket;
  }
}
function seRepiteItem(code) {
  const ticketActivo = getTicketActivo();
  let listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket)); //convierto a json
  if(localStorage.getItem(ticketActivo.ticket)){
    const item = listaItems.find( item => item.codigo == code );
    const positionItem = listaItems.findIndex(item => item.codigo == code)
    if(item){
      return {'repetido': true, 'posicion': positionItem};
    }else {
      return {'repetido': false, 'posicion': positionItem};      
    }
  }
}
/*==============================================================================
--- fin de funciones para obtener primer ticket activo, desactivado, y por folio
--- posicion del ticket activo y del primer ticket desactivado
-- si se repite un elemento en el ticket activo
=========================================== ==================================== */

// para el botón de nuevo ticket
function nuevoTicket() {
  let listaTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
   if(localStorage.getItem('ticketsVentas')){
    let ticket = Math.random().toString(36).substr(2, 9);
    let valor = [];
    let datosTicket = {
      'ticket' : ticket,
      'estado':'desactivado',
      'totalesIVA':'0.00',
      'totalSinIVA':'0.00',
      'total': '0.00',
      'nota':''
    }
    const tickets = listaTickets.concat(datosTicket);// fusiono el array de localstorage con el nuevo
    localStorage.setItem('ticketsVentas',JSON.stringify(tickets));
    localStorage.setItem(ticket, JSON.stringify(valor));
    showButtonsTickets()// muestro los botones de tickets
    showButtonDeleteTicket();// muestro u oculto boton de borrado de ticket
   }
 }
 //para mostrar la lista de botones de tickets
function showButtonsTickets(){
  const listaTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  $("#btnTickets").html('');
  if(localStorage.getItem('ticketsVentas')){
    let botonesTickets=``;
    for (let i = 0; i < listaTickets.length; i++) {
      let ticket = listaTickets[i]['ticket'];
      let estado = listaTickets[i]['estado'];
      let btnActive = estado == 'activo' ? 'btn-success' : ''; 

      botonesTickets+=`<button type="button" class="btn ${btnActive} btn-sm mr-2 mb-2 buttonTickets" onclick="activarTicket(this,'${ticket}')"  ><i class="fal fa-ticket-alt"></i> ${ticket} </button>`;
    }
    botonesTickets+=``;
    $("#btnTickets").html(botonesTickets);
  }
}
function showButtonDeleteTicket(){
  const listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); 
  const longitud = listadoTickets.length;
  if(localStorage.getItem('ticketsVentas')){
    const buttonDelete = `<button class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Borrar ticket" onclick="borrarTicket()"> <i class="fal fa-trash-alt"></i> </button>`;
    const btnDeleteTicket = longitud < 2 ? '' : buttonDelete;
    $('#btnDeleteTicket').html(btnDeleteTicket)
    return btnDeleteTicket;
  }

}
 //para mostrar el area donde va la tabla de items de productos, servicios
function showDivTableTicket(){
  const listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  $("#lsTickets").html('');
  if(localStorage.getItem('ticketsVentas')){
    const ticketActivo = getTicketActivo();
    const btnDeleteTicket = showButtonDeleteTicket();

    if (localStorage.getItem(ticketActivo.ticket)) {
      panel = `
      <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        folio&nbsp;&nbsp;<span class="badge badge-success" id="spanFolio">${ticketActivo.ticket}</span> <span class="fw-300"><i></i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed mr-2" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Colapsar"></button>
                        <div id="btnDeleteTicket">
                          ${btnDeleteTicket}
                        </div>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div id="tabla_items">
                          <table class="table table-sm m-0" id="tabla_items_tr">
                              <thead class="bg-primary-500">
                                  <tr>      
                                      <th>PM</th>
                                      <th>Descripción</th>
                                      <th>P. Venta</th>                                      
                                      <th>Cant.</th>                                      
                                      <th>Ex.</th>
                                      <th>Total</th>
                                      <th>Acciones</th>
                                  </tr>
                              </thead>
                              <tbody>                                                       
                              </tbody>
                              <tfoot>                                                        
                              </tfoot>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
            `;
      $("#lsTickets").append(panel);
    }
  }
}

function addServicioTVCliente() {
  const listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json

  const idCliente = document.getElementById("idClienteInputTVService").value;
  const idTV = document.getElementById("idTvServicio").value;
  const IVA = document.getElementById("ivaTVServicio").value;

  const code = document.getElementById("codeTvService").value;
  const nombreCliente = document.getElementById("nombreClienteInputTVService").value;
  const referencia = document.getElementById("referenciaClienteInputTVService").value;
  const descripcion = document.getElementById("nombreInputTVService").value;
  const precio = document.getElementById("precioInputTVService").value;
  const comision = document.getElementById("comisionInputTVService").value;
  const numPago = document.getElementById("numPago").value;
  const numAutorizacion = document.getElementById("numAutorizacion").value;
  const precioFinal = document.getElementById("precioFinalInputTVService").value;

  const ticketActivo = getTicketActivo();
  
  const datosItem = JSON.stringify({
    'folio' : ticketActivo.ticket,
    'idCliente' : parseInt(idCliente),
    'idUsuario' : parseInt(auth_user_id),
    'transactionable_type':'App\\Television',
    'transactionable_id':parseInt(idTV),
    'nombreCliente' : nombreCliente,
    'referencia' : referencia,
    'descripcion' :  descripcion,
    'tipo' : 'servicio',
    'codigo' : code,
    'cantidad' : 1,
    'existencia' : 'Ilim',
    'tieneMayoreo': false,
    'mayoreoAplicado':false,
    'iva':parseInt(IVA),
    'precio' : precioFinal,
    'precioMayoreo':precioFinal,
    'comision' : comision,
    'numPagoProveedor' : numPago,
    'numAutorizacionProveedor' : numAutorizacion,
    'nota':''
  });

  if(precio !='' && comision !='' && numPago != '' && numAutorizacion !=''){
    addToTicket(datosItem);
    leerItemsTicket(); //leo el contenido del ticket
    $('#servicioTV').modal('hide');// oculto el modal servicio
  }else{
    showMessageNotify("Algún campo está vacío", "danger", 3000)
  }
 }

 function addProducto(idProducto,code,descripcion,precio,precioMayoreo, existencia, iva) {
  const listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  const ticketActivo = getTicketActivo();

  const datosItem = JSON.stringify({
    'folio': ticketActivo.ticket,    
    'idCliente': '',
    'idUsuario': parseInt(auth_user_id),
    'transactionable_type':'App\\Producto',
    'transactionable_id':idProducto,
    'nombreCliente': '',
    'referencia': '',
    'descripcion': descripcion,
    'tipo': 'producto',
    'codigo': code,
    'cantidad': 1,
    'existencia': existencia,
    'tieneMayoreo': true,
    'mayoreoAplicado':false,
    'iva':parseInt(iva),
    'precio': precio,
    'precioMayoreo':precioMayoreo,
    'comision': 0,
    'numPagoProveedor': '',
    'numAutorizacionProveedor': '',
    'nota':''
  });
  //añado al ticket y leo listado
  addToTicket(datosItem);
  leerItemsTicket();

 }

 function addServicioInternetCliente(){

  const listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json

  const idCliente = document.getElementById("idClienteServicioInternet").value;
  const idInternet = document.getElementById("idServicioInternet").value;
  const IVA = document.getElementById("ivaServicioInternet").value;

  const code = document.getElementById("codigoServicioInternet").value;
  const nombreCliente = document.getElementById("nombreClienteServicioInternet").value;
  const descripcion = document.getElementById("descripcionServicioInternet").value;
  const precio = document.getElementById("precioServicioInternet").value;
  const seguro = document.getElementById("seguroServicioInternet").value;
  const precioFinal = document.getElementById("precioFinalServicioInternet").value;

  const ticketActivo = getTicketActivo();
  
  const datosItem = JSON.stringify({
    'folio': ticketActivo.ticket,
    'idCliente': parseInt(idCliente),
    'idUsuario': parseInt(auth_user_id),
    'transactionable_type':'App\\Internet',
    'transactionable_id':parseInt(idInternet),
    'nombreCliente': nombreCliente,
    'referencia': '',
    'descripcion':  descripcion,
    'tipo': 'servicio',
    'codigo': code,
    'cantidad': 1,
    'existencia': 'Ilim',
    'tieneMayoreo': false,
    'mayoreoAplicado':false,
    'iva':parseInt(IVA),
    'precio': precioFinal,
    'precioMayoreo':precioFinal,
    'comision': seguro,
    'numPagoProveedor': '',
    'numAutorizacionProveedor': '',
    'nota':''
  });

  if( precio != '' && seguro != ''){
    addToTicket(datosItem);
    leerItemsTicket(); //leo el contenido del ticket
    $('#servicioInternet').modal('hide');// oculto el modal servicio de interent
  }else{
    showMessageNotify("Precio o seguro está vacío", "danger", 3000)
  }
 }

// para añadir al ticket la recarga
 function addServicioRecarga() {
 
  const listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json

  const idRecarga = document.getElementById("idServicioRecarga").value;
  const iva = document.getElementById("ivaServicioRecarga").value;
  const code = document.getElementById("codigoServicioRecarga").value;
  const descripcion = document.getElementById("descripcionServicioRecarga").value;
  const precio = document.getElementById("precioServicioRecarga").value;
  const comision = document.getElementById("comisionServicioRecarga").value;
  const precioFinal = document.getElementById("precioFinalServicioRecarga").value;

  const ticketActivo = getTicketActivo();

  const datosItem = JSON.stringify({
    'folio': ticketActivo.ticket,    
    'idCliente': '',
    'idUsuario': parseInt(auth_user_id),
    'transactionable_type':'App\\Recarga',
    'transactionable_id':idRecarga,
    'nombreCliente': '',
    'referencia': '',
    'descripcion': descripcion,
    'tipo': 'servicio',
    'codigo': code,
    'cantidad': 1,
    'existencia': 'Ilim',
    'tieneMayoreo': false,
    'mayoreoAplicado':false,
    'iva':parseInt(iva),
    'precio': precioFinal,
    'precioMayoreo': precioFinal,
    'comision': comision,
    'numPagoProveedor': '',
    'numAutorizacionProveedor': '',
    'nota':''
  });
  
  if( precio > 0){
    addToTicket(datosItem);
    leerItemsTicket(); //leo el contenido del ticket
    $('#servicioRecarga').modal('hide');// oculto el modal servicio de interent
  }else{
    showMessageNotify("Debe tener un valor  mayor a cero para la recarga", "danger", 3000)
  }
 }

 // funcion exclusiva para mostrar mensajes como notificaciones
 function showMessageNotify(mensaje, tipo, duracion) {
  $.notify({							
    message: `<i class="fal fa-sun"></i><strong> ${mensaje}</strong>`
    },{								
        type: tipo,
        delay: duracion,
        z_index: 3000,
    });
 } 

 function addToTicket(datosItem) {
  const ticketActivo = getTicketActivo();
  let listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  let listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
  if(localStorage.getItem('ticketsVentas')){
    if (localStorage.getItem(ticketActivo.ticket)) {
      datos = JSON.parse(datosItem);
      seRepite = seRepiteItem(datos.codigo);
      if (seRepite.repetido && datos.tipo == 'producto') {
        existencia = parseInt(listaItems[seRepite.posicion]["existencia"]);
        cantidadPrevia = parseInt(listaItems[seRepite.posicion]["cantidad"]);
        nuevaCantidad = cantidadPrevia + 1;
        if(nuevaCantidad <= existencia){
          listaItems[seRepite.posicion]["cantidad"] = nuevaCantidad;        
        }else {
          showMessageNotify(`La cantidad ${nuevaCantidad} supera la existencia ${existencia} disponible`,'danger', 3000);
          listaItems[seRepite.posicion]["cantidad"] = cantidadPrevia;        
        }
      } else {
        listaItems.push(datos);
      }
      localStorage.setItem(ticketActivo.ticket,JSON.stringify(listaItems));
    }
  }
 }
 
function activarTicket(elemento,folio){
  let botones = document.getElementsByClassName('buttonTickets'); 
  let listaTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  let ticketActivo = getTicketActivo();
  let ticketActivar = getTicketByFolio(folio);

  for (i = 0; i < botones.length; i++) {   
    botones[i].classList.remove('btn-success')
  }    
  elemento.classList.add('btn-success');

  if (localStorage.getItem('ticketsVentas')) {
    for (let i = 0; i < listaTickets.length; i++) {
      if(listaTickets[i]["ticket"] == ticketActivo.ticket ){
        listaTickets[i]["estado"] = 'desactivado';
      }
      if(listaTickets[i]["ticket"] == ticketActivar.ticket ){
        listaTickets[i]["estado"] = 'activo';
      }
      localStorage.setItem('ticketsVentas',JSON.stringify(listaTickets));
    }
  }
  leerItemsTicket()// leo tabla de items de productos, servicios
} 

function leerItemsTicket() {
  showButtonDeleteTicket();// muestro u oculto boton de borrado del ticket
  const listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  const ticketActivo = getTicketActivo();
  $("#tabla_items_tr tbody").empty();//limpio tbody de tabla
  $("#tabla_items_tr tfoot").empty();// limpio el pie
  $("#spanFolio").text(ticketActivo.ticket);
  if(localStorage.getItem('ticketsVentas')){
    if (localStorage.getItem(ticketActivo.ticket)) {
      listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
      if(listaItems.length > 0 ){
        for (let i = 0; i < listaItems.length; i++) {
          const folio = listaItems[i]['folio'];
          const descripcion = listaItems[i]['descripcion'];
          const precio = parseFloat(listaItems[i]['precio']);
          const iva = listaItems[i]['iva'];
          const precioSinIva = iva == 1 ? precio/1.16 : precio;
          const tipo = listaItems[i]['tipo'];
          const cantidad = parseInt(listaItems[i]['cantidad']);
          const existencia = listaItems[i]['existencia'];
          const tieneMayoreo = listaItems[i]['tieneMayoreo'];
          const mayoreoAplicado = listaItems[i]['mayoreoAplicado'];
          const total = precioSinIva * cantidad;
          //ternarios
          const disabledButtonDisminuir = cantidad == 1 ? 'disabled' : '';
          const cssNotAllowedCantidad = cantidad == 1 ? 'cursor:not-allowed' : 'cursor:pointer'; 
          const disabledButtonAumentar = (tipo == 'servicio' || cantidad == existencia  )? 'disabled' : '';
          const cssNotAllowed = tipo == 'servicio' ? 'cursor:not-allowed' : 'cursor:pointer'; 
          const cantidadEditable = tipo == 'servicio' ? false : true;
          const buttonConMayoreo = `<button type="button" class="btn btn-info btn-sm" style='cursor:pointer' onclick="aplicarMayoreo(${i})"><i class="fal fa-money-bill"></i></button>`;
          const buttonSinMayoreo = `<button type="button" class="btn btn-warning btn-sm" disabled style='cursor:not-allowed'><i class="fal fa-money-bill"></i></button>`;
          const buttonTieneMayoreo = tieneMayoreo == true ? buttonConMayoreo : buttonSinMayoreo;
          
          const trItem =`<tr>
              <th>${buttonTieneMayoreo}</th>
              <th>${descripcion}</th>
              <td>${(Math.round(precioSinIva * 100) / 100).toFixed(2)}</td>
              <td contenteditable=${cantidadEditable} id='cantidadItemTr${i}' onBlur="modificarCantidadItem(${i})">${cantidad}</td>
              <td>${existencia}</td>
              <td>${(Math.round(total * 100) / 100).toFixed(2)}</td>
              <td>
                <button type="button" class="btn btn-warning btn-sm" ${disabledButtonDisminuir} style=${cssNotAllowedCantidad} onclick="aumentarDisminuir(${i},${false})">
                  <i class="fal fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" ${disabledButtonAumentar} style=${cssNotAllowed} onclick="aumentarDisminuir(${i},${true})">
                  <i class="fal fa-plus-circle"></i>
                </button>
                <button type="button" class="btn btn-info btn-sm" onclick="verNotaDelItem(${i})"><i class="fal fa-sticky-note"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeItemFromTicket(${i})"><i class="fal fa-trash-alt"></i></button>
              </td>
          </tr>`;
          $("#tabla_items_tr tbody").append(trItem);
        }
      }else{
        const trItem =`<tr><td colspan="7" style='text-align:center;vertical-align:middle'>Aún no hay elementos en la lista</td></tr>`;
        $("#tabla_items_tr tbody").append(trItem);
      }
      showTotals();// muestro los totales del ticket
    }
  }
 }
function showTotals(){
  const listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  const ticketActivo = getTicketActivo();
  const positionTicketActivo = getPositionTicketActivo();
  
  if(localStorage.getItem('ticketsVentas')){
    if (localStorage.getItem(ticketActivo.ticket)){
      listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
      if (listaItems.length > 0 ) {
        totalSinIva=0;
        total = 0;
        ivaSuma=0;
        for (let i = 0; i < listaItems.length; i++) {
          const precio = parseFloat(listaItems[i]['precio']);
          const cantidad = parseInt(listaItems[i]['cantidad']);
          const iva = listaItems[i]['iva'];
          const IvaDescontado = iva == 1 ? ((precio)-(precio/1.16))*cantidad : 0.00;
          const subtoTotal = precio * cantidad;
          total = total + subtoTotal;
          ivaSuma = ivaSuma + IvaDescontado;
          totalSinIVA = total-ivaSuma;  

        }
        const trItem =`
          <tr >
            <td colspan="1" style='text-align:center;vertical-align:middle'>IVA</td>
            <td colspan="1" style='text-align:center;vertical-align:middle'>${(Math.round(ivaSuma * 100) / 100).toFixed(2)}</td>
            <td colspan="1" style='text-align:center;vertical-align:middle'>subTotal</td>
            <td colspan="1" style='text-align:center;vertical-align:middle'>${(Math.round(totalSinIVA * 100) / 100).toFixed(2)}</td>
            <td colspan="2" style='text-align:center;vertical-align:middle'>Total</td>
            <td colspan="1" style='text-align:center;vertical-align:middle'>${(Math.round(total * 100) / 100).toFixed(2)}</td>
          </tr>
          <tr>
            <td colspan="7" style='text-align:center;vertical-align:middle'>
              <button type="button" class="btn btn-info btn-block" onclick='openCobrar()'><i class="fal fa-money-bill"></i> Cobrar</button>
            </td>
          </tr>
        `;
        $("#tabla_items_tr tfoot").append(trItem);
        listadoTickets[positionTicketActivo]["total"] = (Math.round(total * 100) / 100).toFixed(2);
        listadoTickets[positionTicketActivo]["totalSinIVA"] = (Math.round(totalSinIVA * 100) / 100).toFixed(2);
        listadoTickets[positionTicketActivo]["totalesIVA"] = (Math.round(ivaSuma * 100) / 100).toFixed(2);

        localStorage.setItem('ticketsVentas',JSON.stringify(listadoTickets));

      }else{
        const trItem =`<tr class="bg-primary-500">
            <td colspan="4" style='text-align:center;vertical-align:middle'>Total</td>
            <td colspan="3" style='text-align:center;vertical-align:middle'>${(Math.round(0 * 100) / 100).toFixed(2)}</td>
          </tr>`;
        $("#tabla_items_tr tfoot").append(trItem);
        listadoTickets[positionTicketActivo]["total"] = (Math.round(0 * 100) / 100).toFixed(2);
        listadoTickets[positionTicketActivo]["totalSinIVA"] = (Math.round(0 * 100) / 100).toFixed(2);
        listadoTickets[positionTicketActivo]["totalesIVA"] = (Math.round(0 * 100) / 100).toFixed(2);
        localStorage.setItem('ticketsVentas',JSON.stringify(listadoTickets));
      }
    }
  }
}
function removeItemFromTicket(position) {
  const ticketActivo = getTicketActivo();
  const listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
  if(localStorage.getItem(ticketActivo.ticket)){
    listaItems.splice(position, 1);// elimino un item del ticket activo de la posicion recibida
    localStorage.setItem(ticketActivo.ticket,JSON.stringify(listaItems)); // guardo el array de items
    leerItemsTicket()// leo tabla de items de productos, servicios.. etc al borrar un item
  }
}
function verNotaDelItem(position) {
  const ticketActivo = getTicketActivo();
  const listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
  if(localStorage.getItem(ticketActivo.ticket)){
    const notaItem = listaItems[position]["nota"];
    const descripcion = listaItems[position]["descripcion"];
    $('#tituloNotaItemModal').text(descripcion);
    $('#areaNotaItem').val(notaItem);
    $('#positionItemModalNote').text(position);
    $('#modalNotaItem').modal({backdrop: 'static', keyboard: false})
  }
}
function addNoteToItemTicket() {
  const ticketActivo = getTicketActivo();
  const listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
  const position =$('#positionItemModalNote').text();
  const nota =$('#areaNotaItem').val();
  if(localStorage.getItem(ticketActivo.ticket)){
    listaItems[position]["nota"] = nota;// le agrego la nota al item
    localStorage.setItem(ticketActivo.ticket,JSON.stringify(listaItems)); // guardo el array de items
    $('#modalNotaItem').modal('hide');// oculto el modal servicio
    leerItemsTicket()// leo tabla de items de productos, servicios.. etc al borrar un item
  }
}
function aumentarDisminuir(position,restaSuma) {
  const ticketActivo = getTicketActivo();
  let listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
  if(localStorage.getItem(ticketActivo.ticket)){
    const cantidadAnterior = listaItems[position]["cantidad"];
    if (restaSuma) {
      nuevaCantidad = parseInt(cantidadAnterior) + 1;
      listaItems[position]["cantidad"] = nuevaCantidad;// le agrego la nueva cantidad al item
    } else {
      nuevaCantidad = parseInt(cantidadAnterior) - 1; 
      listaItems[position]["cantidad"] = nuevaCantidad;// le agrego la nueva cantidad al item
    }
    localStorage.setItem(ticketActivo.ticket,JSON.stringify(listaItems)); // guardo el array de items
    leerItemsTicket()// leo tabla de items de productos, servicios.. etc al modificar cantidad de un item
  }
}
function modificarCantidadItem(position) {
  const ticketActivo = getTicketActivo();
  let listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
  if(localStorage.getItem(ticketActivo.ticket)){
    const cantidadAnterior = listaItems[position]["cantidad"];
    const existencia = listaItems[position]["existencia"];
    const nuevaCantidad = $("#cantidadItemTr"+position).html();
    if(nuevaCantidad !=''){
      if(!isNaN(nuevaCantidad) && nuevaCantidad > 0){
        if ( nuevaCantidad <= existencia) {
          listaItems[position]["cantidad"] = nuevaCantidad;// le agrego la nueva cantidad al item
        }else{
          showMessageNotify(`La cantidad ${nuevaCantidad} supera la existencia ${existencia} disponible`,'danger', 3000);
          $("#cantidadItemTr"+position).html(cantidadAnterior);
        }
      }else{
        $("#cantidadItemTr"+position).html(cantidadAnterior);
      }
    }else{
      $("#cantidadItemTr"+position).html(cantidadAnterior);
    }
    localStorage.setItem(ticketActivo.ticket,JSON.stringify(listaItems)); // guardo el array de items
    leerItemsTicket()// leo tabla de items de productos, servicios.. etc al modificar cantidad de un item
  }
}
function aplicarMayoreo(position) { // aplica y quita el mayoreo
  const ticketActivo = getTicketActivo();
  const listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
  if(localStorage.getItem(ticketActivo.ticket)){
    const precioAnterior = listaItems[position]["precio"];
    const nuevoPrecio = listaItems[position]["precioMayoreo"];
    const mayoreoAplicado = listaItems[position]["mayoreoAplicado"];
    listaItems[position]["precio"] = nuevoPrecio;
    listaItems[position]["precioMayoreo"] = precioAnterior;
    listaItems[position]["mayoreoAplicado"] = !mayoreoAplicado;
    localStorage.setItem(ticketActivo.ticket,JSON.stringify(listaItems)); // guardo el array de items
    leerItemsTicket();
  }
}

 function borrarTicket() {
  const ticketActivo = getTicketActivo();
  const firstTicketDesactivado = getPrimerTicketDesactivado();
  const ticketActivoPosition = getPositionTicketActivo();
  const firstTicketDesactivadoPosition = getPositionPrimerTicketDesactivado();
  const listaTickets = JSON.parse(localStorage.getItem('ticketsVentas'));
  Swal.fire({
      title: `¿Seguro de borrar el ticket ${ticketActivo.ticket}?`,
      text: "¡No podrás revertir esto!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: '¡Cancelar!',
      confirmButtonText: 'Sí, borrarlo!'
    }).then((result) => {
      if (result.value) {
        if (localStorage.getItem('ticketsVentas')){
          listaTickets[firstTicketDesactivadoPosition]["estado"] = 'activo';// cambio su estado a activo al primer ticket desactivado
          listaTickets.splice(ticketActivoPosition, 1);// elimino el ticket activado del array de tickets
          localStorage.removeItem(ticketActivo.ticket); // borro la variable localstorage con sus items
          localStorage.setItem('ticketsVentas',JSON.stringify(listaTickets)); // guardo el array de tickets
          showButtonsTickets()// muestro los botones de tickets
          leerItemsTicket()// leo tabla de items de productos, servicios
        }
      }
    })
 }
 /*=======================================================================
--- Get data del clienteTV
--- Get data del clienteInternet
--- registrar cliente TV
--- registrar cliente Internet
--- actualizar cliente TV
--- actualizar cliente Internet
========================================================================*/
function getDataClienteTV(idCliente) {
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
  $.ajax({
      url: "{{ url('admin/ventas/getdataclientetv') }}" ,
      type: "get",
      data: {
          'id':idCliente
      },
      success: function(respuesta) {
          ok = respuesta.ok;
          if(ok){
            cliente = respuesta.cliente; 
            mensaje = respuesta.mensaje;
            idCliente = cliente.id;
            nombre = cliente.name;
            idTvServicio= cliente.televisions[0].id;//id del tv service
            referencia =  cliente.televisions[0].pivot.referencia; //obtengo la referencia pasando por los nodos del objeto
            $('#idClienteModalEdit').val(idCliente);            
            $('#nombreClienteModalEdit').val(nombre);
            //$("div.selectTvOption select").val(idTvServicio); //seteo el select
            $("#televisionsSelectIdEdit").val(idTvServicio); //seteo el select
            $('#referenciaClienteModalEdit').val(referencia);
            $('#updateClienteTV').modal({backdrop: 'static', keyboard: false});
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
  }) 
}

function getDataClienteInternet(idCliente) {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': csrf_token
    }
  });
  $.ajax({
    url: "{{ url('admin/ventas/getdataclienteinternet') }}" ,
    type: "get",
    data: {
        'id':idCliente
    },
    success: function(respuesta) {
        ok = respuesta.ok;
        if(ok){

          mensaje = respuesta.mensaje;

          cliente = respuesta.cliente;

          idCliente = cliente.id;
          nombre = cliente.name;
          idServicioInternet= cliente.internets[0].pivot.internet_id;//id del internet service
          antennaIp= cliente.internets[0].pivot.antenna_ip;
          clientIp= cliente.internets[0].pivot.client_ip;
          antennaPassword= cliente.internets[0].pivot.antenna_password;
          routerPassword= cliente.internets[0].pivot.router_password;
          dateStart= cliente.internets[0].pivot.date_start;
          dateExpiration= cliente.internets[0].pivot.date_expiration;

         $('#idClienteModalInternet').val(idCliente); 
         $('#internetsSelectModalInternet').val(idServicioInternet);            
         $('#nombreClienteModalInternet').val(nombre);            
         $('#ipAntenaModalInternet').val(antennaIp);            
         $('#ipClienteModalInternet').val(clientIp);            
         $('#passwordAntenaModalInternet').val(antennaPassword);            
         $('#passwordRouterModalInternet').val(routerPassword);            
         $('#fechaInicioModalInternet').val(dateStart.slice(0, -8));            
         $('#fechaExpiracionModalInternet').val(dateExpiration.slice(0, -8));            

         $('#updateClienteInternet').modal({backdrop: 'static', keyboard: false});

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
}) 
}

function saveClienteTV(){
  let nombreCliente = document.getElementById("nombreClienteModal").value;
  let idTvServicio = document.getElementById("televisionsSelectId").value;
  let referenciaCliente = document.getElementById("referenciaClienteModal").value;

  if(nombreCliente != '' && referenciaCliente != ''){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
    $.ajax({
        url: "{{ url('admin/ventas/saveclientetv') }}" ,
        type: "POST",
        data: {
          'name':nombreCliente,
          'television_id': idTvServicio,
          'referencia':referenciaCliente
        },
        success: function(respuesta) {
            ok = respuesta.ok;
            if(ok){
              cliente = respuesta.cliente; 
              mensaje = respuesta.mensaje;
              $('#registrarClienteTV').modal('hide');// oculto el modal registrarCliente
              showMessageNotify(mensaje, "info", 3000);
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
    })
  } else {

    if(nombreCliente == ''){
      showMessageNotify('Indique el nombre para el cliente', "danger", 3000);
      document.getElementById('nombreClienteModal').focus();
    } else if(referenciaCliente == ''){
      showMessageNotify('Indique la referencia para el cliente', "danger", 3000);
      document.getElementById('referenciaClienteModal').focus();
    }

  } 
}

function saveClienteInternet(){

  let nombreCliente = document.getElementById("nombreClienteInternetR").value;
  let idInternetServicio = document.getElementById("internetsSelectInternetR").value;
  let ipAntena = document.getElementById("ipAntenaInternetR").value;
  let ipCliente = document.getElementById("ipClienteInternetR").value;
  let passwordAntena = document.getElementById("passwordAntenaInternetR").value;
  let passworRouter = document.getElementById("passwordRouterInternetR").value;
  let dateStart = document.getElementById("fechaInicioInternetR").value;

  if(nombreCliente !='' && ipAntena != '' && ipCliente != '' && passwordAntena != '' && passworRouter != '' && dateStart != ''){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
    $.ajax({
        url: "{{ url('admin/ventas/saveclienteinternet') }}" ,
        type: "POST",
        data: {
          'nombreCliente': nombreCliente,
          'idInternet': idInternetServicio,
          'ipAntena': ipAntena,
          'ipCliente': ipCliente,
          'passwordAntena': passwordAntena,
          'passwordRouter': passworRouter,
          'fechaInicio': dateStart
        },
        success: function(respuesta) {
            ok = respuesta.ok;
            if(ok){
              cliente = respuesta.cliente; 
              mensaje = respuesta.mensaje;
              $('#registrarClienteInternet').modal('hide');// oculto el modal registrarClienteInternet
              showMessageNotify(mensaje, "info", 3000);
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
    })
  } else {
    if(nombreCliente == ''){
      showMessageNotify('Indique el nombre para el cliente', "danger", 3000);
      document.getElementById('nombreClienteInternetR').focus();
    } else if(ipAntena == ''){
      showMessageNotify('Indique Ip de la antena', "danger", 3000);
      document.getElementById('ipAntenaInternetR').focus();
    } else if(ipCliente == ''){
      showMessageNotify('Indique ip del cliente', "danger", 3000);
      document.getElementById('ipClienteInternetR').focus();
    }else if(passwordAntena == ''){
      showMessageNotify('Indique la contraseña de la antena', "danger", 3000);
      document.getElementById('passwordAntenaInternetR').focus();
    }else if(passworRouter == ''){
      showMessageNotify('Indique la contraseña del router', "danger", 3000);
      document.getElementById('passwordRouterInternetR').focus();
    }else if(dateStart == ''){
      showMessageNotify('Indique la fecha de pago', "danger", 3000);
      document.getElementById('dateStart').focus();
    }
  } 
}

function updateClienteTV() {
  let idCliente = document.getElementById("idClienteModalEdit").value;
  let nombreCliente = document.getElementById("nombreClienteModalEdit").value;
  let idTvServicio = document.getElementById("televisionsSelectIdEdit").value;
  let referenciaCliente = document.getElementById("referenciaClienteModalEdit").value;

  if(referenciaCliente != ''){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
    $.ajax({
        url: "{{ url('admin/ventas/updateclientetv') }}" ,
        type: "PUT",
        data: {
          'id':idCliente,
          'name':nombreCliente,
          'television_id': idTvServicio,
          'referencia':referenciaCliente
        },
        success: function(respuesta) {
            ok = respuesta.ok;
            if(ok){
              cliente = respuesta.cliente; 
              mensaje = respuesta.mensaje;
              $('#updateClienteTV').modal('hide');// oculto el modal updateCliente
              $('#clienteReferencia').val('');
              $("#listaClientes").html('');
              showMessageNotify(mensaje, "info", 3000);
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
    })
  }else {
    showMessageNotify('Inidque la referencia para el cliente', "danger", 3000);
  } 
}

function updateClienteInternet() {

  let idCliente = document.getElementById("idClienteModalInternet").value;
  let nombreCliente = document.getElementById("nombreClienteModalInternet").value;
  let idInternetServicio = document.getElementById("internetsSelectModalInternet").value;
  let ipAntena = document.getElementById("ipAntenaModalInternet").value;
  let ipCliente = document.getElementById("ipClienteModalInternet").value;
  let passwordAntena = document.getElementById("passwordAntenaModalInternet").value;
  let passworRouter = document.getElementById("passwordRouterModalInternet").value;
  let dateStart = document.getElementById("fechaInicioModalInternet").value;

  if(ipAntena != '' && ipCliente != '' && passwordAntena != '' && passworRouter != '' && dateStart != ''){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
    $.ajax({
        url: "{{ url('admin/ventas/updateclienteinternet') }}" ,
        type: "PUT",
        data: {
          'nombreCliente':nombreCliente,
          'idCliente':idCliente,
          'idInternet': idInternetServicio,
          'ipAntena':ipAntena,
          'ipCliente':ipCliente,
          'passwordAntena':passwordAntena,
          'passwordRouter':passworRouter,
          'fechaInicio':dateStart
        },
        success: function(respuesta) {
            ok = respuesta.ok;
            if(ok){
              cliente = respuesta.cliente; 
              mensaje = respuesta.mensaje;
              $('#updateClienteInternet').modal('hide');// oculto el modal updateClienteInternet
              $('#nameClienteInternet').val('');
              $("#listaClientesInternet").html('');
              showMessageNotify(mensaje, "info", 3000);
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
    })
  }else {
    showMessageNotify('No deje ningún campo vacío', "danger", 3000);
  } 
}
/*=======================================================================
--- fin de Get data del clienteInternet
--- fin de registrar cliente TV
--- fin de registrar cliente Internet
--- fin de actualizar cliente TV
--- fin de actualizar cliente Internet
========================================================================*/

/*=======================================================================
--- cobrar la venta
--- validar datos de cobro, calcular cambio
--- eliminar variables localstorage
--- añadir notas en cabecera de la cuenta
--- enviar lista de items a DB de transacciones (cobro)
========================================================================*/
function openCobrar() {
  const ticketActivo = getTicketActivo();
  const ticketActivoPosition = getPositionTicketActivo();
  const listaTickets = JSON.parse(localStorage.getItem('ticketsVentas'));
  const importe = listaTickets[ticketActivoPosition]['total'];
  const folio = listaTickets[ticketActivoPosition]['ticket'];
  const nota = listaTickets[ticketActivoPosition]['nota'];

  if(localStorage.getItem('ticketsVentas')){
    if(localStorage.getItem(ticketActivo.ticket)){
      $('#folioCobro').text(folio);
      $('#importeItems').val(importe);
      $('#notaEnCabecera').val(nota);
      $('#cambioDiferencia').val('0.00');
      $('#cobrarVenta').modal({backdrop: 'static', keyboard: false});
    }
  }
}
// para validar campos acepten solo numero y decimales
$(function(){
    $(".validarDecimal").keydown(function(event){
        //alert(event.keyCode);
        if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
            return false;
        }
    });
});
function calcularCambio() {
  const importe = parseFloat(document.getElementById("importeItems").value);
  const pagaCon = parseFloat(document.getElementById("pagaCon").value);
  if(pagaCon >= importe){
    $('.btn-cobrar').prop('disabled', false);
    const cambio = pagaCon - importe;
    $('#cambioDiferencia').val((Math.round(cambio * 100) / 100).toFixed(2));
  }else{
    $('.btn-cobrar').prop('disabled', true);
    $('#cambioDiferencia').val('0.00');
  }
}
function addNotaEnCabecera() { //nota que se agrega al cobrar
  const listaTickets = JSON.parse(localStorage.getItem('ticketsVentas'));
  const ticketActivoPosition = getPositionTicketActivo();
  const notaCabecera = document.getElementById("notaEnCabecera").value;
  if (localStorage.getItem('ticketsVentas')) {
    listaTickets[ticketActivoPosition]["nota"] = notaCabecera;
    localStorage.setItem('ticketsVentas',JSON.stringify(listaTickets));  
  }
}
function cobrar(necesitaTicket) {
  const ticketActivo = getTicketActivo();
  const ticketActivoPosition = getPositionTicketActivo();
  const listaTickets = JSON.parse(localStorage.getItem('ticketsVentas'));
  const listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
  const totalesIVA = listaTickets[ticketActivoPosition]['totalesIVA'];
  const totalSinIVA = listaTickets[ticketActivoPosition]['totalSinIVA'];
  const importe = listaTickets[ticketActivoPosition]['total'];

  const folio = listaTickets[ticketActivoPosition]['ticket'];
  const notaCabecera = listaTickets[ticketActivoPosition]['nota'];

  const pagaCon = document.getElementById("pagaCon").value;
  const cambio = document.getElementById("cambioDiferencia").value;

  if(localStorage.getItem('ticketsVentas')){
    if(localStorage.getItem(ticketActivo.ticket)){
      cabecera = {
        'folio': folio,
        'pagaCon': pagaCon,
        'iva': totalesIVA,
        'subTotal': totalSinIVA,
        'total': importe,
        'cambio': cambio,
        'nota': notaCabecera
      };
      $.ajaxSetup({
      headers: { 
        'X-CSRF-TOKEN': csrf_token
      }
    });
      $.ajax({
          url: "{{ url('admin/ventas/cobrar') }}" ,
          type: "post",
          data: {
              'items': listaItems,
              'cabecera': cabecera,
              'necesitaTicket': necesitaTicket
          },
          success: function(respuesta) {
              ok = respuesta.ok;
              if(ok){
                mensaje = respuesta.mensaje;
                //cliente = respuesta.cliente;

                $('#cobrarVenta').modal('hide');// oculto el modal servicio
                showMessageNotify(mensaje,'success',2000)
                generaNuevoTicketAlCobrar()// borro los datos del ticket, variables localstorage
                showButtonsTickets()// muestro los botones de tickets
                leerItemsTicket()// leo tabla de items de productos, servicios
                //console.log(cliente);
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
      })
    }
  }
}
//genero nuevo ticket si al cobrar la lista de tickets su lenght se igual a uno o sino activar el proximo ticket desactivado
function generaNuevoTicketAlCobrar() { 
  const ticketActivo = getTicketActivo();
  const ticketActivoPosition = getPositionTicketActivo();
  const listaTickets = JSON.parse(localStorage.getItem('ticketsVentas'));
  const longitudTickets = listaTickets.length;
  if(localStorage.getItem('ticketsVentas')){
    if(longitudTickets==1){
      const ticket = Math.random().toString(36).substr(2, 9);
      const valor = [];
      const datosTicket = {
        'ticket' : ticket,
        'estado':'activo',
        'totalesIVA':'0.00',
        'totalSinIVA':'0.00',
        'total': '0.00',
        'nota':''
      }
      listaTickets.splice(ticketActivoPosition, 1);   
      localStorage.removeItem(ticketActivo.ticket);
      const tickets = listaTickets.concat(datosTicket);// fusiono el array de localstorage con el nuevo
      localStorage.setItem('ticketsVentas',JSON.stringify(tickets));
      localStorage.setItem(ticket, JSON.stringify(valor));

    }else{
      const firstTicketDesactivado = getPrimerTicketDesactivado();  
      const firstTicketDesactivadoPosition = getPositionPrimerTicketDesactivado();
      listaTickets[firstTicketDesactivadoPosition]["estado"] = 'activo';
      listaTickets.splice(ticketActivoPosition, 1);
      localStorage.removeItem(ticketActivo.ticket);
      localStorage.setItem('ticketsVentas',JSON.stringify(listaTickets));
    }
  }
}
/*=======================================================================
--- fin de cobrar la venta
--- fin de validar datos de cobro
--- fin de enviar lista de items a DB de transacciones
========================================================================*/
 </script>