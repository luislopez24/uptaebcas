
function validarform() {

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;
    var noValido = /\s/;

    var fechaS = document.getElementById("fechaGroup");
    var celS = document.getElementById("celularGroup");
    
    if(!fechaS.value)
    {
        swal("¡Lo siento!", "El campo de fecha no puede estar vacío", "error");
        fechaS.focus();
        verificar = false;
    }

    else (!celS.value)
    {
        swal("¡Lo siento!", "El campo de celular no puede estar vacío", "error");
        celS.focus();
        verificar = false;
    }

    if(verificar==true){
        
        document.quest.submit();

    }

}

window.onload = function(){

    var bottomenviar;

    bottomenviar = document.quest.aceptar;
    bottomenviar.onclick= validarform;
}
