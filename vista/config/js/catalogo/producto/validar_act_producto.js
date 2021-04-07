
function validar() {

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;

    var nombre = document.getElementById("nombre");
    
    if(!nombre.value)
    {
        swal("¡Lo siento!", "El nombre es un campo obligatorio", "error");
        nombre.focus();
        verificar = false;
    }
    else if(!expreNom.exec(nombre.value)){
        swal("¡Lo siento!", "El nombre solo acepta letras", "error");
        nombre.focus();
        verificar = false;

    }

   else if(nombre.value.length>20){
        swal("¡Lo siento!", "El nombre es muy largo", "error");
        nombre.focus();
        verificar= false;
    }

    if(verificar==true){
        
        actualizar_c();

    }

}

window.onload = function(){

    var bottomenviar;

    bottomenviar = document.clasificacion.aceptar;
    bottomenviar.onclick= validarform;
}
