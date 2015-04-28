$(document).ready(function() {
    
    console.log("account js");
    
    $('#numero_factura').keydown(function(e) {    
      // Admite [0-9], BACKSPACE y TAB  
      if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode != 8 && e.keyCode != 9)  
          e.preventDefault();  
    });
    
    $('#numero_control').keydown(function(e) {    
      // Admite [0-9], BACKSPACE y TAB  
      if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode != 8 && e.keyCode != 9)  
          e.preventDefault();  
    });
    
    
    $("#pais_contrib").change(function(){
        console.log($("#pais_contrib").val());
        $.ajax({
          url:"selects_dependientes.php",
          type: "POST",
          data:"idPais="+$("#pais_contrib").val(),
          success: function(opciones){
            $("#estado_contrib").html(opciones);
            
          }
        })
    });
    
        $('#rif_tecnico').keydown(function(e) {    
        // Admite [0-9], BACKSPACE y TAB  
        if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode != 8 && e.keyCode != 9)  
            e.preventDefault();  
        });
 
});

function cambio_clave(){
    
    $('#diferentes').hide();
    $('#clave_errada').hide();
    $('#clave_error').hide();
    $('#clave_correcta').hide();
    
    /*
    console.log($("#clave_anterior").val());
    console.log($("#clave_nueva").val());
    console.log($("#clave_repetir").val());
    console.log($("#rif_user").val());
    */
    
    var clave_anterior = $("#clave_anterior").val();
    var clave_nueva = $("#clave_nueva").val();
    var clave_repetir = $("#clave_repetir").val();
    var rif = $("#rif_user").val();
    
    var valores = {"clave_anterior" : clave_anterior, "clave_nueva" : clave_nueva, "rif" : rif};
    
    if(clave_nueva != clave_repetir){
        $('#diferentes').show('slow');
    }else{
        $.ajax({
            url:"modules/cambio_clave.php",
            type: "POST",
            data: valores,
            success: function(opciones){
                console.log(opciones);
                if(opciones == 0){
                    $('#clave_errada').show('slow');
                }
                if(opciones == -1){
                    $('#clave_error').show('slow');
                }
                if(opciones == 1){
                    $('#clave_correcta').show('slow');
                    $("#clave_anterior").val('');
                    $("#clave_nueva").val('');
                    $("#clave_repetir").val('');
                }
            }
        })
    }
    
    return false;
}


function nuevo_tecnico(){
    
    $('#tec_exist').hide();
    $('#tec_error').hide();
    $('#tec_save').hide();
    var nombre_tecnico = $("#nombre_tecnico").val();
    var rif_tecnico = $("#letra_rif").val()+$("#rif_tecnico").val();
    var rif = $("#rif_user").val();
    
    var nuevo_tec = {"nombre_tecnico" : nombre_tecnico, "rif_tecnico" : rif_tecnico, "rif" : rif};
    /*
    console.log(nombre_tecnico);
    console.log(rif_tecnico);
    console.log(rif);
    */
        $.ajax({
            url:"modules/nuevo_tecnico.php",
            type: "POST",
            data: nuevo_tec,
            success: function(opciones){
                console.log(opciones);
                if(opciones == 0){
                    $('#tec_exist').show('slow');
                }
                if(opciones == -1){
                    $('#tec_error').show('slow');
                }
                if(opciones == 1){
                    $('#tec_save').show('slow');
                    $("#nombre_tecnico").val('');
                    $("#letra_rif").val('');
                    $("#rif_tecnico").val('');
                    window.setTimeout('location.reload()', 3000);
                }
            }
        })
   
    
    
    return false;
}

