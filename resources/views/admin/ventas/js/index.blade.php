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
                listaClientes += `<li class="list-group-item">${idCliente}- ${clientes[i].name} - <span id="ref${idCliente}">${clientes[i].referencia}</span> - <button type="button" class="btn btn-primary xs" onclick="copiar(${idCliente})"><i class="fal fa-copy"></i></button></li>`;
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
  var resultado = document.getElementById('resultado');
  var texto = document.querySelector('#ref'+idCliente);
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
    resultado.innerHTML = mensaje;
  }
}
</script>