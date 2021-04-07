<?php

  require_once 'BD/conexion.php';
 
  class Seguridad extends BD {
  
   private $idUsuario;
   private $idPermiso;
   private $status;
   private $tipo_rol;
   private $pregunta;
   private $respuesta;
    
   private $conex;
 
   // Inicio del constructor
   public function __construct(){
    
    $this->conex = parent::__construct(); 
   }


   public function modStatus($id){
        $strSql = "UPDATE usuario  SET status=:status
                                WHERE id_usuario='".$id."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':status',$this->status);

        $strExec->execute(); 
        $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
        $respuestaArreglo += ['estatus' => true];
        return $respuestaArreglo;
      } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
        $errorReturn = ['estatus' => false];
        $errorReturn += ['info' => "error sql:{$e}"];

        return $errorReturn; //retornamos el contenido de esa variable
      }

    }

    public function registrarQuestions(){

    $strSql = 'INSERT INTO preguntas_seguridad(idUsuario,
                                               pregunta,
                                               respuesta)

                                       VALUES (:idUsuario,
                                               :pregunta,
                                               :respuesta)'; 

               $respuestaArreglo = '';  
                try {

                  $strExec = BD::prepare($strSql);  
                  $strExec->bindParam(':idUsuario',$this->idUsuario);
                  $strExec->bindParam(':pregunta',$this->pregunta);
                  $strExec->bindParam(':respuesta',$this->respuesta);

                  $strExec->execute(); 
                  $respuestaArreglo = $strExec->fetchAll(); 
                  $respuestaArreglo += ['status' => true];
                 
                 return $respuestaArreglo ;

                } catch (PDOException $e) { 
                  $errorReturn = ['status' => false];
                  $errorReturn += ['info' => "error sql:{$e}"];

                  return $errorReturn;
                }

          }//Fin

    public function eliminarQuest($id){ // metodo eliminar

        $strSql="DELETE FROM preguntas_seguridad WHERE idUsuario='$id'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }

    public function buscar_quest($id){
              $strSql = "SELECT * FROM preguntas_seguridad WHERE idUsuario = '$id'";
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

    public function buscar_questUS($id, $pregunta){
              $strSql = "SELECT * FROM preguntas_seguridad WHERE idUsuario = '$id' AND pregunta = '$pregunta'";
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


    public function modificarTatuRol($idRol){
        $strSql = "UPDATE roles  SET statusRol=:status
                                WHERE idRol='".$idRol."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':status',$this->status);

        $strExec->execute(); 
        $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
        $respuestaArreglo += ['estatus' => true];
        return $respuestaArreglo;
      } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
        $errorReturn = ['estatus' => false];
        $errorReturn += ['info' => "error sql:{$e}"];

        return $errorReturn; //retornamos el contenido de esa variable
      }

    }

    public function modificarTodoRol($idRol){
        $strSql = "UPDATE usuario  SET status=:status
                                WHERE tipo_rol='".$idRol."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':status',$this->status);

        $strExec->execute(); 
        $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
        $respuestaArreglo += ['estatus' => true];
        return $respuestaArreglo;
      } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
        $errorReturn = ['estatus' => false];
        $errorReturn += ['info' => "error sql:{$e}"];

        return $errorReturn; //retornamos el contenido de esa variable
      }

    }

    public function modRol($id){
        $strSql = "UPDATE usuario  SET tipo_rol=:tipo_rol
                                WHERE id_usuario='".$id."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':tipo_rol',$this->tipo_rol);

        $strExec->execute(); 
        $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
        $respuestaArreglo += ['estatus' => true];
        return $respuestaArreglo;
      } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
        $errorReturn = ['estatus' => false];
        $errorReturn += ['info' => "error sql:{$e}"];

        return $errorReturn; //retornamos el contenido de esa variable
      }

    }
  
   public function actualizarPermisoUsuario(){

    $strSql = 'INSERT INTO permisos_usuario(idUsuario,
                                 idPermiso)

                         VALUES (:idUsuario,
                                 :idPermiso)'; 

               $respuestaArreglo = '';  
                try {

                  $strExec = BD::prepare($strSql);  
                  $strExec->bindParam(':idUsuario',$this->idUsuario);
                  $strExec->bindParam(':idPermiso',$this->idPermiso);

                  $strExec->execute(); 
                  $respuestaArreglo = $strExec->fetchAll(); 
                  $respuestaArreglo += ['status' => true];
                 
                 return $respuestaArreglo ;

                } catch (PDOException $e) { 
                  $errorReturn = ['status' => false];
                  $errorReturn += ['info' => "error sql:{$e}"];

                  return $errorReturn;
                }

          }//Fin



           public function consultarPermisos_usuarios($idRol, $id_ussuario){
              $strSql = "SELECT * FROM roles 
                                            LEFT JOIN modulo_roles ON modulo_roles.idRol = roles.idRol
                                            LEFT JOIN modulos ON modulos.idModulo = modulo_roles.idModulo
                                            LEFT JOIN permisos ON permisos.idModulo = modulos.idModulo
                                            RIGHT JOIN permisos_usuario ON permisos_usuario.idPermiso = permisos.idPermiso
                                            AND idUsuario = $id_ussuario
                                            WHERE roles.idRol = '$idRol'
                                         ";
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

          public function consultarRol(){
              $strSql = "SELECT * FROM roles";
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

           public function consultarModulos(){
              $strSql = "SELECT * FROM modulos";
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

          public function consultarPermisos(){
              $strSql = "SELECT * FROM permisos";
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

          public function consultarPermisosUsers($idUser){
              $strSql = "SELECT * FROM permisos_usuario WHERE idUsuario = $idUser";
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

              public function Buscar_rol($idRol){
              $strSql = "SELECT * FROM roles WHERE idRol ='$idRol'";
              $respuestaArreglo = '';
                   try {
                $strExec =  BD::prepare($strSql);
                $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
                $respuestaArreglo += ['status' => true];
              return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['status' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; ; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo Buscar

        public function Buscar_rolUsuarios($idRol){
              $strSql = "SELECT * FROM usuario WHERE tipo_rol ='$idRol' ORDER BY status ASC ";
              $respuestaArreglo = '';
                   try {
                $strExec =  BD::prepare($strSql);
                $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
             return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['info' => "error sql:{$e}"];
              }// fin del catch
          }// fin del metodo Buscar

          public function eliminarAntiguosPermisos($idRolUS){ // metodo eliminar

        $strSql="DELETE FROM permisos_usuario WHERE idRolUs='$idRolUS'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }

      public function eliminarRegistro($id){ // metodo eliminar

        $strSql="DELETE FROM bitacora WHERE id_bitacora='$id'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }

    /* 
<!-- ============================================================== -->
<!--                        METODOS SETTER                          -->
<!-- ============================================================== -->
*/  

  public function setIdUsuario($idUsuario){
  $this->idUsuario=$idUsuario;}

  public function setIdPermiso($idPermiso){
  $this->idPermiso=$idPermiso;}

  public function setEstatus($tatu){
  $this->status=$tatu;}

  public function setRol($tipo){
  $this->tipo_rol=$tipo;}

  public function setQuest($quest){
  $this->pregunta=$quest;}

  public function setRespuest($respuest){
  $this->respuesta=$respuest;}

/* 
<!-- ============================================================== -->
<!--                        METODOS GETTER                          -->
<!-- ============================================================== -->
*/ 
  public function getEstatus(){
  return $this->status;}

  public function getRol(){
  return $this->tipo_rol;}

  public function getIdUsuario(){
  return $this->idUsuario;}

  public function getIdPermiso(){
  return $this->idPermiso;}

  public function getQuest($quest){
  return $this->pregunta;}

  public function getRespuest($respuest){
  return $this->respuesta;}

}


    