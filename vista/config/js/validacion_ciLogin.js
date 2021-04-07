
function validarform() {

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;
    var noValido = /\s/;

    var ci = document.getElementById("ciUser");
    
    if(!ci.value)
    {
        swal("¡Lo siento!", "El campo no puede estar vacío", "error");
        ciUser.focus();
        verificar = false;
    }

    else if(expreNom.exec(ci.value)){
        swal("¡Lo siento!", "La cédula es de solo carácter numérico", "error");
        ciUser.focus();
        verificar = false;
    }
    
   else if(ci.value.length>12){
        swal("¡Lo siento!", "La cédula es muy larga", "error");
        ciUser.focus();
        verificar= false;

    }

    else if(ci.value.length<7){
        swal("¡Lo siento!", "La cédula es muy corta", "error");
        ciUser.focus();
        verificar= false;

    }

    else if(noValido.exec(ci.value)){
        swal("¡Lo siento!", "La cédula no puede tener espacios en blanco", "error");
        ciUser.focus();
        verificar = false;
    }


    if(verificar==true){
        
        document.recuperar.submit();

    }

}

window.onload = function(){

    var bottomenviar;

    bottomenviar = document.recuperar.aceptar;
    bottomenviar.onclick= validarform;
}
