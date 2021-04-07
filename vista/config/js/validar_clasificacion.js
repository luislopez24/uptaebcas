
function validar() {

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;
    var noValido = /\s/;
    var noRef = /^['0-9']+$/; 

    var ref = document.getElementById("price");
    var fecha = document.getElementById("fecha1");
    var fecha_f_o = document.getElementById("fecha_f_o");
    var fecha_i_o = document.getElementById("fecha_i_o");
    
    if(!ref.value)
    {
        swal("¡Lo siento!", "El número de movimiento no puede estar vacío", "error");
        verificar = false;
    }
    
    else if(noValido.exec(ref.value)){
        swal("¡Lo siento!", "El número de movimiento no puede tener espacios en blanco", "error");
        verificar = false;
    }

    else if(!noRef.exec(ref.value)){
        swal("¡Lo siento!", "El número de movimiento solo es de carácter numérico", "error");
        verificar = false;
    }

    else if(!fecha.value)
    {
        swal("¡Lo siento!", "La fecha de pago no puede estar vacía", "error");
        id_o.focus();
        verificar = false;
    }

    else if(fecha_i_o.value > fecha.value)
    {
        swal("¡Lo siento!", "La fecha ingresada no puede ser menor que la fecha inicial del operativo", "error");
        verificar = false;
    }

    else if(fecha.value > fecha_f_o.value)
    {
        swal("¡Lo siento!", "La fecha ingresada no puede ser mayor que la fecha final del operativo", "error");
        verificar = false;
    }


    if(verificar==true){
        
        pago();

    }

}

window.onload = function(){

    var bottomenviar;

    bottomenviar = document.pagar.aceptar;
    bottomenviar.onclick= validarform;
}
