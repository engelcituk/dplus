<script>
        controls = { leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
                      rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
                    }
      
      
      $(document).ready(function(){
            $(":input").inputmask(); // valida ip
      
            // minimum setup
            $('#fechaInicioModalInternet').datepicker({
                todayHighlight: true,
                format: 'yyyy/mm/dd',
                orientation: "bottom left",
                templates: controls,
                //startDate: new Date(),
                //startDate: '-0d',
                startDate: 'now()',  
            });
      
            $('#fechaExpiracionModalInternet').datepicker({
                todayHighlight: true,
                format: 'yyyy/mm/dd',
                orientation: "bottom left",
                templates: controls,
                //startDate: new Date(),
                //startDate: '-0d',
                startDate: 'now()',  
            });   
      });
      
        
      </script>