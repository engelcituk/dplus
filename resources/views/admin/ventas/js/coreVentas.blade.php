<script>
let listaTicketVentas = [];
let ticketsVentas = 'ticketsVentas';

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
  console.log('hla')
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
      button=`<button type="button" class="btn btn-primary"><i class="fal fa-plus-square fs-xl"></i> ${listadoTickets[0]}</button>`
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

function getTickets(){
  if(localStorage.getItem(ticketsVentas)){
    leerTickets();
  }else {
    let ticket = Math.random().toString(36).substr(2, 9);
    listaTicketVentas.push(ticket);

    /* let ticket2 = Math.random().toString(36).substr(2, 9);
    listaTicketVentas.push(ticket2);

    let ticket3 = Math.random().toString(36).substr(2, 9);
    listaTicketVentas.push(ticket3);

    let ticket4 = Math.random().toString(36).substr(2, 9);
    listaTicketVentas.push(ticket4); */

    localStorage.setItem(ticketsVentas, JSON.stringify(listaTicketVentas));
    leerTickets();
  }
}

function leerTickets(){
  if(localStorage.getItem(ticketsVentas)){
    listadoTickets = JSON.parse(localStorage.getItem(ticketsVentas)); //convierto a json
    listadoTickets.forEach( function (elemento, indice)  {
      //console.log(elemento, indice,)
      panel = `
      <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        ${elemento} <span class="fw-300"><i>${indice}</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container ${show = (indice === 0 ) ? 'show' : 'collapse'}">
                    <div class="panel-content">
                        Click the buttons below to show and hide another element via class changes:
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


</script>