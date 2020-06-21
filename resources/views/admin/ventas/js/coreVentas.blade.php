<script>
let listaTicketVentas = [];
let ticketsVentas = 'ticketsVentas';
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
    //resultado.innerHTML = mensaje;
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
            servicioTV = respuesta.servicioTV;
            showModalServicioTV(servicioTV, idCliente, nombreCliente, referencia);          
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
function showModalServicioTV(servicioTV, idCliente, nombreCliente, referencia){
  //le pinto los valores en los campos
  $('#idClienteInputTVService').val(idCliente);
  $('#nombreClienteInputTVService').val(nombreCliente);
  $('#referenciaClienteInputTVService').val(referencia);
 // document.getElementById('referenciaClienteInputTVService').onclick = copiar(idCliente);
  $("#referenciaClienteInputTVService").click(copiar(idCliente));
  $('#nombreInputTVService').val(servicioTV.name);
  $('#precioInputTVService').val(servicioTV.price);
  $('#comisionInputTVService').val(servicioTV.commission);
  $('#precioFinalInputTVService').val(servicioTV.final_price);
  listarTicketsEnModal();
  $('#servicioTV').modal({backdrop: 'static', keyboard: false})
}

function listarTicketsEnModal(){
  if(localStorage.getItem(ticketsVentas)){
    listadoTickets = JSON.parse(localStorage.getItem(ticketsVentas)); //convierto a json
    longitudArrTickets = listadoTickets.length;
    if(longitudArrTickets > 1){
      select = `<label class="form-label">Selecciona ticket</label><select class='form-control' name='idModo' id='modoSelect'>"`
      for(i = 0;  i<listadoTickets.length; i++){
        select+="<option value='"+listadoTickets[i]+"'>" +listadoTickets[i]+ "</option>"; 
      }
      select += `</select>`
      $("#lstTicketsTvServicios").html(select); 
    }else{
      button=`<button type="button" class="btn btn-primary" onclick="addServicioCliente()"><i class="fal fa-plus-square fs-xl"></i> ${listadoTickets[0]}</button>`
      $("#lstTicketsTvServicios").html(button); 
    }
    
  }
}

// reseteo el contenido del modal al cerrarlo
$('#servicioTV').on('hidden.bs.modal', function () {
    texto = document.getElementById('referenciaModalSpan');
    $('#servicioTV form')[0].reset();
    texto.innerHTML = '';
});
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

function getTickets(){
  if(localStorage.getItem(ticketsVentas)){
    leerTickets();
  }else {
    let ticket = Math.random().toString(36).substr(2, 9);
    let valor = [];
    listaTicketVentas.push(ticket);
    localStorage.setItem(ticketsVentas, JSON.stringify(listaTicketVentas));
    localStorage.setItem(ticket, JSON.stringify(valor));
    leerTickets();
  }
}
 
function leerTickets(){
  if(localStorage.getItem(ticketsVentas)){
    listadoTickets = JSON.parse(localStorage.getItem(ticketsVentas)); //convierto a json
    listadoTickets.forEach( function (elemento, indice)  {
      panel = `
      <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        folio <span class="badge badge-success">${elemento}</span> <span class="fw-300"><i></i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    </div>
                </div>
                <div class="panel-container ${show = (indice === 0 ) ? 'show' : 'collapse'}">
                    <div class="panel-content">
                        <div id="tabla_items">
                          <table class="table table-sm m-0" id="tabla_items_tr">
                              <thead class="bg-primary-500">
                                  <tr>                               
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
    });
  }else{
    console.log('vacio');
  }
}
 function addServicioCliente() {
  let listadoTickets = JSON.parse(localStorage.getItem(ticketsVentas)); //convierto a json

  let idCliente = document.getElementById("idClienteInputTVService").value;
  let nombreCliente = document.getElementById("nombreClienteInputTVService").value;
  let referencia = document.getElementById("referenciaClienteInputTVService").value;
  let descripcion = document.getElementById("nombreInputTVService").value;
  let precio = document.getElementById("precioInputTVService").value;
  let comision = document.getElementById("comisionInputTVService").value;
  let numPago = document.getElementById("numPago").value;
  let numAutorizacion = document.getElementById("numAutorizacion").value;
  let precioFinal = document.getElementById("numAutorizacion").value;


  let datosItem = JSON.stringify({
    'folio' : listadoTickets[0],
    'idCliente' : idCliente,
    'idProducto':'-',
    'nombreCliente' : nombreCliente,
    'referencia' : referencia,
    'descripcion' :  descripcion,
    'tipo' : 'servicioTV',
    'barcode' : '-',
    'cantidad' : 1,
    'existencia' : '-',
    'precio' : precio,
    'comision' : comision,
    'numPagoProveedor' : numPago,
    'numAutorizacionProveedor' : numAutorizacion,
    'nota':''
  });

  if(precio !='' && comision !='' && numPago != '' && numAutorizacion !=''){
    addToTicket(datosItem);
    leerItemsTicket(); //leo el contenido del ticket
  }else{
    showMessageNotify("Algún campo está vacío", "danger", 3000)
  }
 }
 function addProducto(idProducto,barcode,descripcion,precio, existencia) {
  let listadoTickets = JSON.parse(localStorage.getItem(ticketsVentas)); //convierto a json
  let datosItem = JSON.stringify({
    'folio' : listadoTickets[0],
    'idCliente' : '-',
    'idProducto':idProducto,
    'nombreCliente' : '-',
    'referencia' : '-',
    'descripcion' :  descripcion,
    'tipo' : 'producto',
    'barcode' : barcode,
    'cantidad' : 1,
    'existencia' : existencia,
    'precio' : precio,
    'comision' : '-',
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
  let listadoTickets = JSON.parse(localStorage.getItem(ticketsVentas)); //convierto a json
  if(localStorage.getItem(ticketsVentas)){
    if (localStorage.getItem(listadoTickets[0])) {
      datosItem = JSON.parse(datosItem);
      listaItems.push(datosItem);
      localStorage.setItem(listadoTickets[0],JSON.stringify(listaItems));
    }
  }
 }
 function leerItemsTicket() {
  let listadoTickets = JSON.parse(localStorage.getItem(ticketsVentas)); //convierto a json

  $("#tabla_items_tr tbody").empty();//limpio tbody de tabla
  $("#tabla_items_tr tfoot").empty();// limpio el pie
  if(localStorage.getItem(ticketsVentas)){
    if (localStorage.getItem(listadoTickets[0])) {
      listaItems = JSON.parse(localStorage.getItem(listadoTickets[0]));
      for (let i = 0; i < listaItems.length; i++) {
        const folio = listaItems[i]['folio'];
        const descripcion = listaItems[i]['descripcion'];
        const precio = parseFloat(listaItems[i]['precio']);
        const tipo = listaItems[i]['tipo'];
        const cantidad = parseInt(listaItems[i]['cantidad']);
        const existencia = listaItems[i]['existencia'];
        const total = precio * cantidad;

        let disabled = cantidad == 1 ? 'disabled' : '';
        let disabled2 = tipo == 'servicioTV' ? 'disabled' : '';


        const trItem =`<tr>
            <th scope="row">${descripcion}</th>
            <td>${precio}</td>
            <td>${cantidad}</td>
            <td>${existencia}</td>
            <td>${total}</td>
            <td>
              <button type="button" class="btn btn-warning btn-sm" ${disabled}><i class="fal fa-minus"></i></button>
              <button type="button" class="btn btn-success btn-sm" ${disabled2}><i class="fal fa-plus-circle"></i></button>
              <button type="button" class="btn btn-info btn-sm"><i class="fal fa-sticky-note"></i></button>
              <button type="button" class="btn btn-danger btn-sm"><i class="fal fa-trash-alt"></i></button>
            </td>
        </tr>`;
        $("#tabla_items_tr tbody").append(trItem);
      }

    }
  }
 }
 </script>