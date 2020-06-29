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
function getDataServicioTVCliente(idCliente, idTV, code,nombreCliente, referencia){
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
            showModalservicio(servicio, idCliente, nombreCliente, referencia);          
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
// para mostrar el modal donde se pintan los datos de cliente y su servicio de tv
function showModalservicio(servicio, idCliente, nombreCliente, referencia){
  //le pinto los valores en los campos
  $('#idClienteInputTVService').val(idCliente);
  $('#codeTvService').val(servicio.code);

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
    button=`<button type="button" class="btn btn-primary" onclick="addServicioCliente()"><i class="fal fa-plus-square fs-xl"></i> ${ticketActivo.ticket}</button>`
    $("#lstTicketsTvServicios").html(button);  
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

$('#modalNotaItem').on('hidden.bs.modal', function () {
    texto = document.getElementById('positionItemModalNote');
    $('#modalNotaItem form')[0].reset();
    texto.innerHTML = '';
});

$('#registrarCliente').on('hidden.bs.modal', function () {
    $('#registrarCliente form')[0].reset();
});
/*=======================================================================
--- fin de reseteo el contenido de los modales al cerrarlo
========================================================================*/

// calculo el precio final con base al precio inicial + la comision
function calculoPrecioFinal(){
    
    let precio = document.getElementById("precioInputTVService").value;
    let comision = document.getElementById("comisionInputTVService").value;
    
    if( precio == ''){
        document.getElementById("precioInputTVService").value = 0;
        precio = 0;
    }
    if( comision == ''){
        document.getElementById("comisionInputTVService").value = 0;
        comision = 0;
    }
    document.getElementById("precioFinalInputTVService").value = parseFloat(precio) + parseFloat(comision);
 
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
      'estado':'activo'
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
      'estado':'desactivado'
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

function addServicioCliente() {
  let listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json

  let idCliente = document.getElementById("idClienteInputTVService").value;
  let code = document.getElementById("codeTvService").value;
  let nombreCliente = document.getElementById("nombreClienteInputTVService").value;
  let referencia = document.getElementById("referenciaClienteInputTVService").value;
  let descripcion = document.getElementById("nombreInputTVService").value;
  let precio = document.getElementById("precioInputTVService").value;
  let comision = document.getElementById("comisionInputTVService").value;
  let numPago = document.getElementById("numPago").value;
  let numAutorizacion = document.getElementById("numAutorizacion").value;
  let precioFinal = document.getElementById("precioFinalInputTVService").value;

  const ticketActivo = getTicketActivo();

  let datosItem = JSON.stringify({
    'folio' : ticketActivo.ticket,
    'idCliente' : idCliente,
    'idProducto':'-',
    'nombreCliente' : nombreCliente,
    'referencia' : referencia,
    'descripcion' :  descripcion,
    'tipo' : 'servicio',
    'codigo' : code,
    'cantidad' : 1,
    'existencia' : 'Ilim',
    'tieneMayoreo': false,
    'mayoreoAplicado':false,
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

 function addProducto(idProducto,code,descripcion,precio,precioMayoreo, existencia) {
  let listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  const ticketActivo = getTicketActivo();

  let datosItem = JSON.stringify({
    'folio' : ticketActivo.ticket,    
    'idCliente' : '-',
    'idProducto':idProducto,
    'nombreCliente' : '-',
    'referencia' : '-',
    'descripcion' :  descripcion,
    'tipo' : 'producto',
    'codigo' : code,
    'cantidad' : 1,
    'existencia' : existencia,
    'tieneMayoreo': true,
    'mayoreoAplicado':false,
    'precio' : precio,
    'precioMayoreo':precioMayoreo,
    'comision' : 0,
    'numPagoProveedor' : '-',
    'numAutorizacionProveedor' : '-',
    'nota':''
  });
  //añado al ticket y leo listado
  addToTicket(datosItem);
  leerItemsTicket();

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
  let listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
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
          const tipo = listaItems[i]['tipo'];
          const cantidad = parseInt(listaItems[i]['cantidad']);
          const existencia = listaItems[i]['existencia'];
          const tieneMayoreo = listaItems[i]['tieneMayoreo'];
          const mayoreoAplicado = listaItems[i]['mayoreoAplicado'];
          const total = precio * cantidad;
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
              <td>${(Math.round(precio * 100) / 100).toFixed(2)}</td>
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
  let listadoTickets = JSON.parse(localStorage.getItem('ticketsVentas')); //convierto a json
  const ticketActivo = getTicketActivo();
  if(localStorage.getItem('ticketsVentas')){
    if (localStorage.getItem(ticketActivo.ticket)){
      listaItems = JSON.parse(localStorage.getItem(ticketActivo.ticket));
      if (listaItems.length > 0 ) {
        total = 0;
        for (let i = 0; i < listaItems.length; i++) {
          const precio = parseFloat(listaItems[i]['precio']);
          const cantidad = parseInt(listaItems[i]['cantidad']);
          const subtoTotal = precio * cantidad;
          total = total + subtoTotal;
        }
        const trItem =`
          <tr >
            <td colspan="4" style='text-align:center;vertical-align:middle'>Total</td>
            <td colspan="3" style='text-align:center;vertical-align:middle'>${(Math.round(total * 100) / 100).toFixed(2)}</td>
          </tr>
          <tr>
            <td colspan="7" style='text-align:center;vertical-align:middle'>
              <button type="button" class="btn btn-info btn-block"><i class="fal fa-money-bill"></i> Cobrar</button>
            </td>
          </tr>
        `;
        $("#tabla_items_tr tfoot").append(trItem);
      }else{
        const trItem =`<tr class="bg-primary-500">
            <td colspan="4" style='text-align:center;vertical-align:middle'>Total</td>
            <td colspan="3" style='text-align:center;vertical-align:middle'>${(Math.round(0 * 100) / 100).toFixed(2)}</td>
          </tr>`;
        $("#tabla_items_tr tfoot").append(trItem);
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
  let listaTickets = JSON.parse(localStorage.getItem('ticketsVentas'));
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
--- Get data del cliente
--- registrar cliente
--- actualizar cliente
========================================================================*/
function getDataCliente(idCliente) {

  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
  $.ajax({
      url: "{{ url('admin/ventas/getdatacliente') }}" ,
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
            $('#updateCliente').modal({backdrop: 'static', keyboard: false});
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
function saveCliente() {
  let idCliente = document.getElementById("idClienteModalEdit").value;
  let nombreCliente = document.getElementById("nombreClienteModal").value;
  let idTvServicio = document.getElementById("televisionsSelectId").value;
  let referenciaCliente = document.getElementById("referenciaClienteModal").value;
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
  $.ajax({
      url: "{{ url('admin/ventas/savecliente') }}" ,
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
            $('#registrarCliente').modal('hide');// oculto el modal registrarCliente
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
}
function updateCliente() {
  let idCliente = document.getElementById("idClienteModalEdit").value;
  let nombreCliente = document.getElementById("nombreClienteModalEdit").value;
  let idTvServicio = document.getElementById("televisionsSelectIdEdit").value;
  let referenciaCliente = document.getElementById("referenciaClienteModalEdit").value;
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf_token
      }
    });
  $.ajax({
      url: "{{ url('admin/ventas/updatecliente') }}" ,
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
            $('#updateCliente').modal('hide');// oculto el modal updateCliente
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
}
/*=======================================================================
--- fin de Get data del cliente
--- fin de registrar cliente
--- fin de actualizar cliente
========================================================================*/
 </script>