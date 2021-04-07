
function validar() {

    var verificar = true;
    var expreNom=/^[0-9-a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;

    var nombre = document.getElementById("descrip");
    var marca = document.getElementById("marca");
    var con = document.getElementById("contenido");
    var des = document.getElementById("descripcion");
    
    if(!nombre.value)
    {
        swal("¡Lo siento!", "El nombre es un campo obligatorio", "error");
        verificar = false;
    }

   else if(nombre.value.length>25){
        swal("¡Lo siento!", "El nombre es muy largo", "error");
        verificar= false;
    }

    else if(!marca.value)
    {
        swal("¡Lo siento!", "La marca es un campo obligatorio", "error");
        marca.focus();
        verificar = false;
    }

   else if(marca.value.length>15){
        swal("¡Lo siento!", "La marca es muy larga", "error");
        marca.focus();
        verificar= false;
    }

    else if(!con.value)
    {
        swal("¡Lo siento!", "El contenido es un campo obligatorio", "error");
        con.focus();
        verificar = false;
    }

   else if(con.value.length>10){
        swal("¡Lo siento!", "El campo contenido es muy largo", "error");
        con.focus();
        verificar= false;
    }

    else if(!des.value)
    {
        swal("¡Lo siento!", "La descripcion es un campo obligatorio", "error");
        des.focus();
        verificar = false;
    }

   else if(des.value.length>20){
        swal("¡Lo siento!", "La descripción es muy larga", "error");
        des.focus();
        verificar= false;
    }

    if(verificar==true){
        
        actualizar_p();

    }

}

window.onload = function(){

    var bottomenviar;

    bottomenviar = document.user.aceptar;
    bottomenviar.onclick= validarform;
}
