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
</script>