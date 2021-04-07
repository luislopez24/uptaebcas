
function validar() {

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;
    var noValido = /\s/;

    var pas = document.getElementById("con");
    var pass = document.getElementById("contra_");
    var passwo = document.getElementById("contra_2");

    var antPass = document.getElementById("antPass");
    
    if(!pas.value)
    {
        swal("¡Lo siento!", "Ingrese su antigua contraseña", "error");
        verificar = false;
    }
    
    else if(noValido.exec(pas.value)){
        swal("¡Lo siento!", "La contraseña no puede tener espacios en blanco", "error");
        verificar = false;
    }

    if(!pass.value)
    {
        swal("¡Lo siento!", "Ingrese su nueva contraseña", "error");
        verificar = false;
    }
    
   else if(pass.value.length>12){
        swal("¡Lo siento!", "la nueva contraseña es muy larga", "error");
        verificar= false;
    }

    else if(noValido.exec(pass.value)){
        swal("¡Lo siento!", "La contraseña no puede tener espacios en blanco", "error");
        verificar = false;
    }

    if(!passwo.value)
    {
        swal("¡Lo siento!", "Rectifique su contraseña", "error");
        verificar = false;
    }
    else if(noValido.exec(passwo.value)){
        swal("¡Lo siento!", "La contraseña no puede tener espacios en blanco", "error");
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
        
        document.passw.submit();

    }

}

window.onload = function(){

    var bottomenviar;

    bottomenviar = document.passw.aceptar;
    bottomenviar.onclick= validar;
}
