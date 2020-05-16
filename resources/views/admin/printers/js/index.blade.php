<script>

$(document).ready(function(){
    $('#tablaPrinters').dataTable({
        responsive: true,
        language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
    },
    });
});
function borrarPrinter(idPrinter){
    var csrf_token = $('meta[name="csrf-token"]').attr('content');     
    Swal.fire({
      title: '¿Seguro de borrar a esta impresora de tickets?',
      text: "¡No podrás revertir esto!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, borrarlo!',
      cancelButtonText: '¡Cancelar!'

    }).then((result) => {
      if (result.value) {
        $.ajax({
              url: "{{ url('admin/printers') }}" + '/' + idPrinter,
              type: "DELETE",
              data: {
                  '_method': 'DELETE',
                  'id': idPrinter,
                  '_token': csrf_token
              },
              success: function(respuesta) {
                    // tablaAlergenos.ajax.reload();
                    var ok= respuesta.ok;
                    if(ok){
                      Swal.fire(
                      'OK!',
                      respuesta.mensaje,
                      'success'
                    )
                   location.reload();
                    }else {
                      Swal.fire(
                      ':(',
                      respuesta.mensaje,
                      'error'
                    )
                  } 
                },
                error: function(respuesta) {
                    swal({
                        title: 'Oops...',
                        text: '¡Algo salió mal!'+respuesta.mensaje,
                        type: 'error',
                        timer: '1500'
                    })
                }
          });
      }
    })
  }
  
  function probarPrinter(impresora) {

    if(impresora.use_mode === 'ip'){
      let ip = impresora.ip;
      testImpresionPorCompartido(ip);
    }

    if(impresora.use_mode === 'compartido'){
      let nombreCompartido = impresora.shared_name;
      //console.log('se usará controlador por impresora compartida',nombreCompartido);
      testImpresionPorCompartido(nombreCompartido);
    }
  }

  function testImpresionPorCompartido(nombreCompartido){
    
    var csrf_token = $('meta[name="csrf-token"]').attr('content');    
        $.ajax({
            url: "{{ url('admin/prints/shared') }}",
            type: "POST",
            data: {
                '_method': 'POST',                           
                '_token': csrf_token,
                'nombreCompartido': nombreCompartido
            },
            success: function(respuesta) {             
                               
                console.log(respuesta); 
                                                    
            },
            error: function(respuesta) { 
                console.log(respuesta); 
            }
        })

  }
</script>