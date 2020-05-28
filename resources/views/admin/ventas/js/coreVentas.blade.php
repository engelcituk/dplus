<script>
    
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


  $('#servicioTV').modal({backdrop: 'static', keyboard: false})
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

</script>