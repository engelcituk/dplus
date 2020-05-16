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
            console.log(clientes);
            
            listaClientes = `<ul class="list-group mt-3">`
              for(i = 0; i < clientes.length; i++){
                listaClientes += `<li class="list-group-item">${clientes[i].name} - ${clientes[i].referencia} </li>`;
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