

function validarcorreo() {

    var verificar = true;

    var expreNom=/^[a-zA-ZÑñúÚÁáÉéÍíÓó\s]+$/;
    var noValido = /\s/;
    var expreCel = /^['0-9']+$/;
    var expreCor=/^\w+([\.-]?\w+)+$/;

    var receptor = document.getElementById("tipoo");
    var asunto = document.getElementById("txtasuntico");

    if(!receptor.value)
    {
        swal("¡Lo siento!", "El receptor es un campo obligatorio", "error");
        verificar = false;
    }

    else if(!asunto.value)
    {
        swal("¡Lo siento!", "El asunto es un campo obligatorio", "error");
        asunto.focus();
        verificar = false;
    }

    if(verificar==true){

        document.email.submit();

    }

}
 
