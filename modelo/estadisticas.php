<?php

  require_once 'BD/conexion.php';
 
  class Estadisticas extends BD {
  
   private $id_usuario_sistema;
   private $fecha;
   private $hora;
   private $accion;
   private $ip_address;
   private $conex;
 
   // Inicio del constructor
   public function __construct(){
    
    $this->conex = parent::__construct(); 
   }
   
   public function Add(){

    $strSql = 'INSERT INTO bitacora(id_usuario_sistema,
                                    fecha,
                                    hora,
                                    accion,
                                    ip_address)
                           VALUES (:id_usuario_sistema,
                                   :fecha,
                                   :hora,
                                   :accion,
                                   :ip_address)'; 

               $respuestaArreglo = '';  
                try {

                  $strExec = BD::prepare($strSql);  
                  $strExec->bindParam(':id_usuario_sistema',$this->id_usuario_sistema);
                  $strExec->bindParam(':fecha',$this->fecha);
                  $strExec->bindParam(':hora',$this->hora);
                  $strExec->bindParam(':accion',$this->accion);
                  $strExec->bindParam(':ip_address',$this->ip_address);

                  $strExec->execute(); 
                  $respuestaArreglo = $strExec->fetchAll(); 
                  $respuestaArreglo += ['estatus' => true];
                 
                 return $respuestaArreglo ;

                } catch (PDOException $e) { 
                  $errorReturn = ['estatus' => false];
                  $errorReturn += ['info' => "error sql:{$e}"];

                  return $errorReturn;
                }

          }//Fin

           public function consultarBeneficioentregado($month, $year){
              $strSql = "SELECT count(id_usuario_) as total FROM operativo_usuario where month(fecha_entrega)='$month' and year(fecha_entrega)='$year'";
              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
              return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

          public function consultarOperativoRealizados($month, $year){
              $strSql = "SELECT count(id_operativo) as total FROM operativo where month(fecha_inicio_operativo)='$month' and year(fecha_inicio_operativo)='$year'";
              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
              return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar



public function dineroIngresado($month, $year){
              $strSql = "SELECT *, SUM(o.precio_operativo) as cash 
                             FROM usuario u
                       INNER JOIN operativo_usuario opu 
                               ON u.id_usuario = opu.id_usuario_ 
                        LEFT JOIN operativo o
                               ON opu.id_operativo_ = o.id_operativo
                            WHERE opu.id_operativo_ IS NOT NULL
                              AND month(fecha_inicio_operativo)='$month' 
                              AND year(fecha_inicio_operativo)='$year'";
              $respuestaArreglo = '';


              try {

                $strExec = BD::prepare($strSql);
                $strExec->execute();
                            $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retorna
                            $strExec->execute(); 
                            

                  } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                    $errorReturn = ['estatus' => "false"];
                    $errorReturn += ['info' => "error sql:{$e}"];
                    return $errorReturn; ; //retornamos el contenido de esa variable
                  }// fin del catch
                  return $respuestaArreglo;
              }// fin del metodo Buscar


public function consultarBeneficioLogueados($month, $year){
              $strSql = "SELECT *, COUNT(b.accion) as total, u.id_usuario as idu
                             FROM usuario u
                       INNER JOIN bitacora b 
                               ON u.id_usuario = b.id_usuario_sistema 
                            WHERE u.tipo_rol = '4'
                              AND b.accion ='Login success'  
                              AND month(b.fecha)='$month' 
                              AND year(b.fecha)='$year'";
              $respuestaArreglo = '';


              try {

                $strExec = BD::prepare($strSql);
                $strExec->execute();
                            $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retorna
                            $strExec->execute(); 
                            

                  } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                    $errorReturn = ['estatus' => "false"];
                    $errorReturn += ['info' => "error sql:{$e}"];
                    return $errorReturn; ; //retornamos el contenido de esa variable
                  }// fin del catch
                  return $respuestaArreglo;
              }// fin del metodo Buscar

    /* 
<!-- ============================================================== -->
<!--                        METODOS SETTER                          -->
<!-- ============================================================== -->
*/  

  public function setId_usuario($id_usuario){
  $this->id_usuario_sistema=$id_usuario;}

  public function setHora($hora){
  $this->hora=$hora;}     

  public function setFecha($fecha){
  $this->fecha=$fecha;}

  public function setAccion($accion){
  $this->accion=$accion;}    

  public function setIp($ip){
  $this->ip_address=$ip;}  

/* 
<!-- ============================================================== -->
<!--                        METODOS GETTER                          -->
<!-- ============================================================== -->
*/ 

   public function getId_usuario(){
   return $this->id_usuario_sistema;}

   public function getHora(){
   return $this->hora;}

   public function getFecha(){
   return $this->fecha;}

   public function getAccion(){
   return $this->accion;}

   public function getIp(){
   return $this->ip_address;}

}


    