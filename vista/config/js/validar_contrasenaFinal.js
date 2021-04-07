
function validarform() {

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;
    var noValido = /\s/;
    
    var pass = document.getElementById("contra_");
    var passwo = document.getElementById("contra_2");
    
    if(!pass.value)
    {
        swal("¡Lo siento!", "Ingrese su nueva contraseña", "error");
        pass.focus();
        verificar = false;
    }
    
   else if(pass.value.length>12){
        swal("¡Lo siento!", "La nueva contraseña es muy larga", "error");
        pass.focus();
        verificar= false;
    }

    else if(pass.value.length<6){
        swal("¡Lo siento!", "La nueva contraseña es muy corta", "error");
        pass.focus();
        verificar= false;
    }

    else if(noValido.exec(pass.value)){
        swal("¡Lo siento!", "La contraseña no puede tener espacios en blanco", "error");
        pass.focus();
        verificar = false;
    }

    else if(!passwo.value)
    {
        swal("¡Lo siento!", "Rectifique su contraseña", "error");
        passwo.focus();
        verificar = false;
    }

        else if(passwo.value !== pass.value)
        {
            swal("¡Lo siento!", "Sus contraseñas no coinciden", "error");
            verificar = false;
        }

    else if(noValido.exec(passwo.value)){
        swal("¡Lo siento!", "La contraseña no puede tener espacios en blanco", "error");
        passwo.focus();
        verificar = false;
    }

    if(verificar==true){
        
        document.pass.submit();

    }

}

window.onload = function(){

    var bottomenviar;

    bottomenviar = document.pass.aceptar;
    bottomenviar.onclick= validarform;
}
