

function validarform() {

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;
    var noValido = /\s/;
    var expreCel = /^['0-9']+$/;
    var expreCor=/^\w+([\.-]?\w+)+$/;

    var nombre = document.getElementById("nom");
    var apellido = document.getElementById("ape");
    var tcedula = document.getElementById("tci");
    var cedula = document.getElementById("ci");
    var fecha = document.getElementById("fecha");
    var correo= document.getElementById("correo");
    var ttelefono= document.getElementById("tcel");
    var telefono= document.getElementById("cel");
    var fecha= document.getElementById("fechan");
    var contrasena= document.getElementById("password");
    var pass= document.getElementById("passwo");
    var direccion= document.getElementById("direc");
    
    var fecha_min = "2003-01-01";
    var p = 6;

    if(!tcedula.value)
    {
        swal("¡Lo siento!", "El tipo de cédula es un campo obligatorio", "error");
        tcedula.focus();
        verificar = false;
    }

    else if(!cedula.value)
    {
        swal("¡Lo siento!", "La cédula es un campo obligatorio", "error");
        verificar = false;
    }


    else if(isNaN(cedula.value)){
        swal("¡Lo siento!", "La cédula solo admite valor numerico", "error");
        verificar = false;
    }

    else if(noValido.exec(cedula.value)){
        swal("¡Lo siento!", "La cédula no puede tener espacios en blanco", "error");
        verificar = false;
    }

    else if(cedula.value.length<7){
        swal("¡Lo siento!", "Esta cédula no existe", "error");
        verificar= false;
    }

    else if(cedula.value.length>12){
        swal("¡Lo siento!", "Esta cédula no es valida", "error");
        verificar= false;
    }

    else if(!nombre.value)
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

    else if(noValido.exec(nombre.value)){
        swal("¡Lo siento!", "Digite solo el primer nombre sin espacios en blanco", "error");
        nombre.focus();
        verificar = false;
    }

    else if(!apellido.value)
    {   
        swal("¡Lo siento!", "El apellido es un campo obligatorio", "error");
        apellido.focus();
        verificar = false;
    }
    else if(!expreNom.exec(apellido.value)){
        swal("¡Lo siento!", "El apellido solo acepta letras", "error");
        apellido.focus();
        verificar = false;

    }

    else if(noValido.exec(apellido.value)){
        swal("¡Lo siento!", "Solo digite primer apellido sin espacios en blanco", "error");
        apellido.focus();
        verificar = false;
    }

    else if(!contrasena.value)
    {   
        swal("¡Lo siento!", "Por favor digite su nueva contraseña", "error");
        pass.focus();
        verificar = false;
    }

    else if(noValido.exec(contrasena.value)){
        swal("¡Lo siento!", "La contraseña no puede tener espacios en blanco", "error");
        pass.focus();
        verificar = false;
    }

    else if(contrasena.value.length>12){
        swal("¡Lo siento!", "La contraseña es muy larga", "error");
        contrasena.focus();
        verificar= false;
    }
    
    else if(!pass.value)
    {   
        swal("¡Lo siento!", "Por favor rectifique su nueva contraseña", "error");
        contrasena.focus();
        verificar = false;
    }

    else if(noValido.exec(pass.value)){
        swal("¡Lo siento!", "La contraseña no puede tener espacios en blanco", "error");
        contrasena.focus();
        verificar = false;
    }

    else if(pass.value.length>12){
        swal("¡Lo siento!", "La contraseña es muy larga", "error");
        pass.focus();
        verificar= false;
    }

    else if(contrasena.value != pass.value){
        swal("¡Lo siento!", "Sus contraseñas no coinciden", "error");
        contrasena.focus();
        pass.focus();
        verificar = false;
    }

    else if(!correo.value)
    {
        swal("¡Lo siento!", "El correo es un campo obligatorio", "error");
        correo.focus();
        verificar = false;
    }
    else if(!expreCor.exec(correo.value))
    {
        swal("¡Lo siento!", "El correo contiene carácteres invalidos", "error");
        correo.focus();
        verificar = false;
    }

    else if(noValido.exec(correo.value)){
        swal("¡Lo siento!", "El correo no puede tener espacios en blanco", "error");
        correo.focus();
        verificar = false;
    }

    else if(correo.value.length>16){
        swal("¡Lo siento!", "El correo es muy largo", "error");
        correo.focus();
        verificar= false;
    }


    else if(!ttelefono.value)
    {
        swal("¡Lo siento!", "El tipo de telefono es un campo obligatorio", "error");
        ttelefono.focus();
        verificar = false;
    }

    else if(!telefono.value)
    {
        swal("¡Lo siento!", "El telefono es un campo obligatorio", "error");
        telefono.focus();
        verificar = false;
    }


    else if(!expreCel.exec(telefono.value)){
        swal("¡Lo siento!", "El telefono es solo carácter numérico", "error");
        telefono.focus();
        verificar = false;
    }

    else if(noValido.exec(telefono.value)){
        swal("¡Lo siento!", "El telefono no puede tener espacios en blanco", "error");
        telefono.focus();
        verificar = false;
    }

    else if(telefono.value.length>7){
        swal("¡Lo siento!", "El telefono tiene numeros de más", "error");
        telefono.focus();
        verificar= false;
    }

    else if(telefono.value.length<7){
        swal("¡Lo siento!", "Al telefono le hacen falta números", "error");
        telefono.focus();
        verificar= false;
    }

    else if(!direccion.value)
    {
        swal("¡Lo siento!", "Debe ingresar alguna dirección", "error");
        direccion.focus();
        verificar = false;
    }

    else if(direccion.value.length>120){
        swal("¡Lo siento!", "El campo dirección solo acepta 120 caractéres", "error");
        direccion.focus();
        verificar= false;
    }

    else if(!fecha.value)
    {
        swal("¡Lo siento!", "La fecha nacimiento es obligatoria", "error");
        fecha.focus();
        verificar = false;
    }

    else if(fecha.value > fecha_min)
    {
        swal("¡Lo siento!", "La fecha no es admitida", "error");
        fecha.focus();
        verificar = false;
    }

    if(verificar==true){
        
        document.user.submit();

    }

}

window.onload = function(){

    var bottomenviar;

    bottomenviar = document.user.aceptar;
    bottomenviar.onclick= validarform;
}
