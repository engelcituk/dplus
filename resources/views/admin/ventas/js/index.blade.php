<script>
function buscarClientes(){
  let datosCliente= $('#clienteReferencia').val();
  let csrf_token = $('meta[name="csrf-token"]').attr('content');     
  
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
            listaClientes = `<ul class="list-group mt-3">`
              for(i = 0; i < clientes.length; i++){
                let idCliente = clientes[i].idCliente
                let idTV = clientes[i].idTelevision
                let nombreCliente = clientes[i].name
                let referencia = clientes[i].referencia

                listaClientes += `<li class="list-group-item">${idCliente} - ${idTV} - ${nombreCliente} - <span id="ref${idCliente}">${referencia}</span> - <button type="button" class="btn btn-primary xs" onclick="copiar(${idCliente})"><i class="fal fa-copy"></i></button> - <button type="button" class="btn btn-info xs" onclick="getDataServicioTVCliente(${idCliente}, ${idTV}, '${nombreCliente}',${referencia})"><i class="fal fa-plus-circle"></i></button> </li>`;
              }
            listaClientes += "</ul>";
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

function getDataServicioTVCliente(idCliente, idTV, nombreCliente, referencia){
  let csrf_token = $('meta[name="csrf-token"]').attr('content');     

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


  $('#servicioTV').modal({backdrop: 'static', keyboard: false})
}
// reseteo el contenido del modal al cerrarlo
$('#servicioTV').on('hidden.bs.modal', function () {
    texto = document.getElementById('referenciaModalSpan');
    $('#servicioTV form')[0].reset();
    texto.innerHTML = '';

});
</script>