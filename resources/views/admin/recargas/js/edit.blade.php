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
  let comision = document.getElementById("comision").value;
    if( precio == ''){
        document.getElementById("precio").value = 0.00;
        precio = 0.00;
    }
    if( comision == ''){
        document.getElementById("comision").value = 0.00;
        comision = 0.00;
    }

    precioFinal = parseFloat(precio) + parseFloat(comision);
    document.getElementById('precioFinal').value = (Math.round( precioFinal * 100) / 100).toFixed(2);
}

</script>