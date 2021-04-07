
<?php foreach ($p as $permiso):

            // MODULOS
                
             if ($permiso['idModulo'] == '1') {

                $mUsuario = true;
             }

             if ($permiso['idModulo'] == '2') {

                $mBeneficiario = true;
             }

             if ($permiso['idModulo'] == '3') {

                $mOperativo = true;
             }

             if ($permiso['idModulo'] == '3') {

                $mOperativo = true;
             }

             if ($permiso['idModulo'] == '4') {

                $mSegurity = true;
             }

             if ($permiso['idModulo'] == '5') {

                $mReporte = true;
             }

            // PERMISOS

            //--- USUARIO
             if ($permiso['idPermiso'] == '1') {

                $registrarUsuario = true;
             }

             if ($permiso['idPermiso'] == '2') {

                $modificarUsuario = true;
             }

             if ($permiso['idPermiso'] == '3') {

                $eliminarUsuario = true;
             }

             //--- BENEFICIARIO
             if ($permiso['idPermiso'] == '4') {

                $registrarBeneficiario = true;
             }

             if ($permiso['idPermiso'] == '5') {

                $modificarBeneficiario = true;
             }

             if ($permiso['idPermiso'] == '6') {

                $eliminarBeneficiario = true;
             }

             //--- OPERATIVO
             if ($permiso['idPermiso'] == '7') {

                $registrarOperativo = true;
             }

             if ($permiso['idPermiso'] == '8') {

                $modificarOperativo = true;
             }

             if ($permiso['idPermiso'] == '9') {

                $eliminarOperativo = true;
             }

             if ($permiso['idPermiso'] == '10') {

                $addProductosOperativo = true;
             }

             if ($permiso['idPermiso'] == '11') {

                $publicarOperativo = true;
             }

             //--- OPERATIVO / CATALOGO
             if ($permiso['idPermiso'] == '18') {

                $registrarCatalogo = true;
             }

             if ($permiso['idPermiso'] == '19') {

                $modificarCatalogo = true;
             }

             if ($permiso['idPermiso'] == '20') {

                $eliminarCatalogo = true;
             }

             //--- OPERATIVO / DIVERSIDAD
             if ($permiso['idPermiso'] == '21') {

                $registrarDiversidad = true;
             }

             if ($permiso['idPermiso'] == '22') {

                $modificarDiversidad = true;
             }

             if ($permiso['idPermiso'] == '23') {

                $eliminarDiversidad = true;
             }

             //--- OPERATIVO / CLASIFICACIÓN
             if ($permiso['idPermiso'] == '15') {

                $registrarClasificacion = true;
             }

             if ($permiso['idPermiso'] == '16') {

                $modificarClasificacion = true;
             }

             if ($permiso['idPermiso'] == '17') {

                $eliminarClasificacion = true;
             }

             //--- OPERATIVO / DISTRIBUCION
             if ($permiso['idPermiso'] == '12') {

                $distribuirOperativo = true;
             }

             //--- OPERATIVO / PAGOS
             if ($permiso['idPermiso'] == '13') {

                $registrarPago = true;
             }

             if ($permiso['idPermiso'] == '14') {

                $modificarPago = true;
             }

             //--- SEGURIDAD
             if ($permiso['idPermiso'] == '24') {

                $verBitacoras = true;
             }

             if ($permiso['idPermiso'] == '25') {

                $eliminarBitacoras = true;
             }

             if ($permiso['idPermiso'] == '26') {

                $segAvanzada = true;
             }

             //--- REPORTE
             if ($permiso['idPermiso'] == '27') {

                $verEstadisticas = true;
             }

             if ($permiso['idPermiso'] == '28') {

                $generarReporte = true;
             }



          endforeach;
   
    ?> 