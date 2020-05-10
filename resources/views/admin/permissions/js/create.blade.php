<script>
    // para validar campos acepten solo numero y decimales
    $(function(){
    $(".validarDecimal").keydown(function(event){
        //alert(event.keyCode);
        if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
            return false;
        }
    });
});

// hacer calculos

function calculoPrecioFinal(){
    
    let precio = document.getElementById("precio").value;
    let seguro = document.getElementById("seguro").value;
    
    if( precio=='' || precio==0){
        Swal.fire({
            type: "error",
            title: "Oops...",
            text: "No dejes vacío el campo o en cero",
            //footer: "<a href>Why do I have this issue?</a>"
        }); 
        document.getElementById("precio").focus();
    }
    document.getElementById("precioFinal").value = parseFloat(precio) + parseFloat(seguro);
 
}
</script>