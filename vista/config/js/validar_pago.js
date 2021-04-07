
function validar() {

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;
    var noValido = /\s/;
    var noRef = /^['0-9']+$/;

    var id_o = document.getElementById("id_operativo");
    var ref = document.getElementById("ref");
    var fecha = document.getElementById("fecha1");
 
    if(!ref.value)
    {
        swal("¡Lo siento!", "El número de movimiento no puede estar vacío", "error");
        verificar = false;
    }

     else if(noValido.exec(ref.value)){
        swal("¡Lo siento!", "El número de movimiento no puede contener espacios en blanco", "error");
        verificar = false;
    }

    else if(!noRef.exec(ref.value)){
        swal("¡Lo siento!", "El número de movimiento solo es de carácter numérico", "error");
        verificar = false;
    }

    else if(!id_o.value)
    {
        swal("¡Lo siento!", "El operativo a pagar no puede estar vacío", "error");
        id_o.focus();
        verificar = false;
    }

    else if(!fecha.value)
    {
        swal("¡Lo siento!", "La fecha de pago no puede estar vacía", "error");
        id_o.focus();
        verificar = false;
    }

    if(verificar==true){
        
        document.pagar.submit();

    }

}

window.onload = function(){

    var bottomenviar;

    bottomenviar = document.pagar.aceptar;
    bottomenviar.onclick= validar;
}
