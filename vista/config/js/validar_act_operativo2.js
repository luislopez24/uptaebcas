
function validar() {

    var verificar = true;
    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;

    var da = document.getElementById("date");
    var fechaf = document.getElementById("fechaf");
    var fechai = document.getElementById("fechai");
    
     if(!fechaf.value)
    {
        swal("¡Lo siento!", "La fecha final del operativo es obligatoria" , "error");
        fechaf.focus();
        verificar = false;
    }

    else if(fechai.value > fechaf.value)
    {
        swal("¡Lo siento!", "La fecha final del operativo es invalida" , "error");
        fechaf.focus();
        verificar = false;
    }

    else if(fechai.value == fechaf.value)
    {
        swal("¡Lo siento!", "La fecha final no puede ser igual a la fecha inicial" , "error");
        fechaf.focus();
        verificar = false;
    }

    

    if(verificar==true){
        
        actualizar_operativo2();

    }


}
