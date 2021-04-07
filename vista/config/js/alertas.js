
$('#beneficio_regis').submit(function (e) {
                e.preventDefault();
                //captura todos los valores que tiene el formulario es decir todos los input que esten en ese formulario...
                var datos=$(this).serialize();
                
                $.ajax({
                    type:"POST",
                    url:"?url=gesOperativo",
                    data:datos,
                    success:function(data){
                        swal(
                            'Registro del Beneficio Completado',
                            'Sin errores',
                            'success'
                        );
                        //AQUI SE PUEDE IMPRIMIR UN MENSAJE QUE PROCESA AJAX
                       
                    }
                });
            });

function confirmarBitacora(){
        
        swal({   
        title: "¿Realmente desea eliminar los registros seleccionados?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Eliminar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#eliminarBi');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se han eliminado los registros", 
                "error");   
            } 
        });
                
    }

function eliminarMensajes(){
        
        swal({   
        title: "¿Realmente desea eliminar los mensajes seleccionados?",   
        text: "No podrás deshacer este paso", 
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Eliminar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#eliminarMsj');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se han eliminado los mensajes", 
                "error");   
            } 
        });
                
    }

 function eliminar(url){
        
        swal({   
        title: "¿Desea eliminar este registro?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Eliminar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {

                window.location=url;
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha eliminado el registro", 
                "error");   
            } 
        });

    }

function users_morosos(url){
        
        swal({   
        title: "¿Desea recordarle a cada beneficiario deudor, pagar este operativo?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Notificar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {

                window.location=url;
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se le ha notificado a ningún beneficiario", 
                "error");   
            } 
        });

    }

 function validar_resetContrasena(url){
        
        swal({   
        title: "¿Desea restaurar la contraseña de este usuario?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Restaurar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {

                window.location=url;
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha restaurado la contraseña", 
                "error");   
            } 
        });

    }

 function validar_resetQuest(url){
        
        swal({   
        title: "¿Desea restaurar las preguntas de seguridad de este usuario?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Restaurar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {

                window.location=url;
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha restaurado las preguntas de seguridad", 
                "error");   
            } 
        });

    }

function actualizar(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#user');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado el usuario", 
                "error");   
            } 
        });
                
    }    

function actualizarClasi(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#clasificacion');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado la clasificación", 
                "error");   
            } 
        });
                
    }

function actualizarUserRol(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#userRol');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado el usuario", 
                "error");   
            } 
        });
                
    }

function actualizarPermisos(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#as');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado los permisos del usuario", 
                "error");   
            } 
        });
                
    }


function actualizar_p2(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#pro');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado el producto", 
                "error");   
            } 
        });
                
    }


function actualizar_p(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#producto');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado el producto", 
                "error");   
            } 
        });
                
    }

function actualizar_c(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#catalogo');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado el catalogo", 
                "error");   
            } 
        });
                
    }

function actualizar_clasi(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#clasificacion');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado la clasificación", 
                "error");   
            } 
        });
                
    }

    function actualizar_operativo(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#1');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado el operativo", 
                "error");   
            } 
        });
                
    }

     function actualizar_operativo2(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#1');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado el operativo", 
                "error");   
            } 
        });
                
    }

function elimi(url){
        
        swal({   
        title: "¿Deseas eliminar este producto del operativo?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Eliminar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                
                window.location=url;
                 
            } else {     

                swal("¡Cancelado!", 
                    "No se ha eliminado el producto del operativo", 
                "error");   
            } 
        });
                
    }

function cancelar(url){
        
        swal({   
        title: "¿Desea eliminar el registro de este operativo?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Eliminar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {

                window.location=url;
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha eliminado el operativo", 
                "error");   
            } 
        });

    }

function ocultar(url){
        
        swal({   
        title: "¿Desea ocultar este operativo?",   
        text: "Ningún beneficiario podrá ver ni pagar el operativo una vez ocultado",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Ocultar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {

                window.location=url;
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha ocultado el operativo", 
                "error");   
            } 
        });

    }

function pago(){
        
        swal({   
        title: "¿Desea realizar estos cambios?",   
        text: "No podrás deshacer este paso",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Actualizar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                var form = $('#act_pago');
                form.submit(); 
                
                 
            } else {     
                swal("¡Cancelado!", 
                    "No se ha actualizado el pago", 
                "error");   
            } 
        });
                
    }

function entregarr(url){
        
        swal({   
        title: "¿Deseas quitarle el operativo a este beneficiario?",   
        text: "No saldrá como entregado en el reporte",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "¡Quitar!",   
        cancelButtonText: "Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 

        function(isConfirm){   
            if (isConfirm) {    
                
                window.location=url;
                 
            } else {     

                swal("¡Cancelado!", 
                    "No se le ha quitado el operativo", 
                "error");   
            } 
        });
                
    }

 $("#selectall").on("click", function() {  
     $(".id_delete").prop("checked", this.checked);  
 });  

// if all checkbox are selected, check the selectall checkbox and viceversa  
$(".id_delete").on("click", function() {  
  if ($(".id_delete").length == $(".id_delete:checked").length) {  
    $("#selectall").prop("checked", true);  
  } else {  
    $("#selectall").prop("checked", false);  
  }  
});