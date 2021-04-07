
function validar() {

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;

    var nombre = document.getElementById("nombre_act");
    var fechai = document.getElementById("fechai");
    var da = document.getElementById("date");
    var price = document.getElementById("precio");
    var fechaf = document.getElementById("fechaf");
    var descrip = document.getElementById("descrip");

    
    if(!nombre.value)
    {
        swal("¡Lo siento!", "El nombre es un campo obligatorio", "error");
        verificar = false;
    }

   else if(nombre.value.length>30){
        swal("¡Lo siento!", "El nombre es muy largo", "error");
        verificar= false;
    }
    
    else if(!fechai.value)
    {
        swal("¡Lo siento!", "La fecha de inicio del operativo es obligatoria", "error");
        fechai.focus();
        verificar = false;
    }

    else if(date.value > fechai.value)
    {
        swal("¡Lo siento!", "La fecha de inicio del operativo es invalida" , "error");
        fechai.focus();
        verificar = false;
    }
    else if(!price.value)
    {
        swal("¡Lo siento!", "El precio no puede estar vacío" , "error");
        price.focus();
        verificar = false;
    }
    
    else if(!fechaf.value)
    {
        swal("¡Lo siento!", "La fecha final del operativo es obligatoria" , "error");
        fechaf.focus();
        verificar = false;
    }

    else if(fechai.value > fechaf.value)
    {
        swal("¡Lo siento!", "La fecha final del operativo es invalida" , "error");
        fechai.focus();
        verificar = false;
    }

    else if(fechai.value == fechaf.value)
    {
        swal("¡Lo siento!", "La fecha final no puede ser igual a la fecha inicial" , "error");
        fechaf.focus();
        verificar = false;
    }
    
    else if(!descrip.value)
    {
        swal("¡Buhh..!", "Añadele una descripción al operativo" , "error");
        descrip.focus();
        verificar = false;
    }

    else if(descrip.value.length>100){
        swal("¡Lo siento!", "La descripción es muy larga", "error");
        descrip.focus();
        verificar= false;
    }

    if(verificar==true){
        
        actualizar_operativo();

    }


}
