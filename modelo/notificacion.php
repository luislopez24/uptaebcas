
<!-- ============================================================== -->
<!--                      MODELO NOTIFICACION                       -->
<!-- ============================================================== -->

<?php
require_once 'BD/conexion.php';
 
   class Notificacion extends BD{
     
     private $foto_icono;
     private $idEmisor;
     private $idReceptor;
     private $asunto;
     private $mensaje;
     private $tipo;
     private $favorito;
     private $fecha;
     private $leido;
     private $idBuzon;
     public $conex;

     public function __construct(){
        $this->conex = parent::__construct();
    }// fin del constructor

// CRUD

    public function RegistrarNotificacion(){

         $strSql = 'INSERT INTO buzon (foto_icono,
                                                idEmisor,
                                                idReceptor,
                                                asunto,
                                                mensaje,
                                                tipo,
                                                favorito,
                                                fecha) 
                                       VALUES (:foto_icono,
                                               :idEmisor,
                                               :idReceptor,
                                               :asunto,
                                               :mensaje,
                                               :tipo,
                                               :favorito,
                                               :fecha)'; 

         $respuestaArreglo = '';  
          try {
            $strExec = BD::prepare($strSql);  
            $strExec->bindParam(':foto_icono', $this->foto_icono);
            $strExec->bindParam(':idEmisor', $this->idEmisor);
            $strExec->bindParam(':idReceptor', $this->idReceptor);
            $strExec->bindParam(':asunto', $this->asunto);
            $strExec->bindParam(':mensaje', $this->mensaje);
            $strExec->bindParam(':tipo', $this->tipo);
            $strExec->bindParam(':favorito', $this->favorito);
            $strExec->bindParam(':fecha', $this->fecha);
            $strExec->execute(); 
            $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
            $respuestaArreglo += ['estatus' => true];
            return $respuestaArreglo;
          } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
            $errorReturn = ['estatus' => false];
            $errorReturn += ['info' => "error sql:{$e}"];

            return $errorReturn; //retornamos el contenido de esa variable
          }

    }// fin del metodo Registrar

    public function RegistrarMsj(){

         $strSql = 'INSERT INTO mensajes (idBuzon,
                                                idEmisor,
                                                idReceptor) 
                                       VALUES (:idBuzon,
                                               :idEmisor,
                                               :idReceptor)'; 

         $respuestaArreglo = '';  
          try {
            $strExec = BD::prepare($strSql);  
            $strExec->bindParam(':idBuzon', $this->idBuzon);
            $strExec->bindParam(':idEmisor', $this->idEmisor);
            $strExec->bindParam(':idReceptor', $this->idReceptor);
            $strExec->execute(); 
            $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
            $respuestaArreglo += ['estatus' => true];
            return $respuestaArreglo;
          } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
            $errorReturn = ['estatus' => false];
            $errorReturn += ['info' => "error sql:{$e}"];

            return $errorReturn; //retornamos el contenido de esa variable
          }

    }// fin del metodo Registrar

     public function mensajeLeido($idMsj){
        $strSql = "UPDATE buzon  SET leido=:leido
                                WHERE idBuzon='".$idMsj."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':leido',$this->leido);

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

    public function setFav($id){
        $strSql = "UPDATE buzon  SET favorito=:favorito
                                WHERE idBuzon='".$id."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':favorito',$this->favorito);

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

    public function consultarMensajes($idRecep){
              $strSql = "SELECT *FROM buzon 
                           INNER JOIN usuario
                                   ON buzon.idEmisor = usuario.id_usuario
                                WHERE buzon.idReceptor ='$idRecep' 
                                  AND tipo != '1' 
                                  AND tipo != '3'
                             ORDER BY buzon.leido ASC";
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

     public function vermensaje($idMsj){
              $strSql = "SELECT *FROM buzon 
                           INNER JOIN usuario
                                   ON buzon.idEmisor = usuario.id_usuario
                                WHERE buzon.idBuzon ='$idMsj'";
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

      public function chequeoMensaje($idMsj){
              $strSql = "SELECT *FROM mensajes 
                                WHERE mensajes.idBuzon ='$idMsj'";
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

      public function vermensajeSystem($idMsj){
              $strSql = "SELECT *FROM buzon 
                                WHERE buzon.idEmisor = '0'
                                  AND buzon.idBuzon ='$idMsj'";
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

     public function consultarNotificaciones($id){
              $strSql = "SELECT * FROM buzon 
                                 WHERE tipo = '1'
                                   AND idReceptor = '$id'
                              ORDER BY leido ASC";
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

       public function consultarEnviados($idE){
              $strSql = "SELECT *FROM mensajes 
                           INNER JOIN usuario
                                   ON mensajes.idReceptor = usuario.id_usuario
                            INNER JOIN buzon
                                   ON mensajes.idBuzon = buzon.idBuzon
                                WHERE mensajes.idEmisor ='$idE'";
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


      public function fav($id){
              $strSql = "SELECT *FROM buzon 
                            RIGHT JOIN usuario
                                   ON buzon.idEmisor = usuario.id_usuario
                                WHERE buzon.idReceptor ='$id'
                                  AND buzon.favorito = '1'
                                  AND buzon.idEmisor != '0'";
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

      public function favSystem($id){
              $strSql = "SELECT *FROM buzon 
                                WHERE buzon.idEmisor = '0'
                                  AND buzon.idReceptor ='$id'
                                  AND buzon.favorito = '1'
                                  AND buzon.tipo != '3'";
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


       public function archivadosBuzon($id){
              $strSql = "SELECT *FROM buzon 
                            RIGHT JOIN usuario
                                   ON buzon.idEmisor = usuario.id_usuario 
                                WHERE buzon.idReceptor ='$id'
                                  AND buzon.tipo= '3'
                                  AND buzon.idEmisor != '0'";
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

           public function archivadosBuzonNoti($id){
           
             $strSql = "SELECT * FROM buzon 
                                WHERE buzon.idEmisor = '0' 
                                  AND buzon.idReceptor ='$id'
                                  AND buzon.tipo= '3'";

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

          public function actTipo($id){
        $strSql = "UPDATE buzon  SET tipo=:tipo
                                WHERE idBuzon='".$id."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':tipo',$this->tipo);

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

    public function eliminarMsj($msj){
       $strSql = "UPDATE buzon  SET idReceptor=:idReceptor
                                          WHERE idBuzon='".$msj."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':idReceptor',$this->idReceptor);

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

    public function eliminarE($msj){

       $strSql="DELETE FROM mensajes WHERE idBuzon='$msj'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();

    }

    public function eliminarR($msj){

       $strSql="DELETE FROM buzon WHERE idBuzon='$msj'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();

    }

    public function eliminarMsjDefinitivoR($id){ // metodo eliminar

        $strSql="DELETE FROM buzon WHERE idBuzon='$id'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }

    public function eliminarMsjDefinitivoE($id){ // metodo eliminar

        $strSql="DELETE FROM mensajes WHERE idBuzon='$id'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }

      public function eliminar($id){ // metodo eliminar

        $strSql="DELETE FROM catalogo WHERE id_catalogo='$id'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }


     //CONSULTAR ULTIMO ID 
        public function ultimoMensaje(){
              $strSql = 'SELECT MAX(idBuzon) AS id FROM buzon';
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
  
     
       //Para el catalogo del carrito - operativo
 
     public function catalogoGeneral(){
             $strSql = "SELECT * FROM Catalogo ORDER BY id_clasificacion ASC";
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

           public function usuarios_por_pagar($id){
          $strSql = "SELECT * FROM usuario
                         LEFT JOIN operativo_usuario
                                ON operativo_usuario.id_usuario_ = usuario.id_usuario
                               AND operativo_usuario.id_operativo_ ='$id'
                         LEFT JOIN operativo 
                                ON operativo_usuario.id_operativo_ = operativo.id_operativo 
                             WHERE operativo_usuario.id_operativo_ IS NULL
                              AND tipo_rol !=1
                              AND tipo_rol !=2
                              AND tipo_rol !=3";
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

     
  // METODOS SETTER

    public function setfoto_icono($foto_iconoEmisor){
      $this->foto_icono=$foto_iconoEmisor;}

    public function setIdUser($id_user){
      $this->idEmisor=$id_user;}

    public function setIdReceptor($id_destino){
      $this->idReceptor=$id_destino;}

    public function setAsunto($asunt){
      $this->asunto=$asunt;}

    public function setMensaje($menssaje){
      $this->mensaje=$menssaje;}
    
    public function setIdMensaje($idMsj){
      $this->idBuzon=$idMsj;}

    public function setTipo($tipo){
      $this->tipo=$tipo;}

    public function setFavorito($favorito){
      $this->favorito=$favorito;}    

    public function setFecha($date){
      $this->fecha=$date;}

    public function setLeido($view){
      $this->leido=$view;}

    
// Metodos Getter

    public function getConex(){
        return $this->conex;}
   
    public function getfoto_icono(){
        return $this->$foto_icono;}

    public function getidEmisor(){
        return $this->$idEmisor;}

    public function getidReceptor(){
        return $this->$idReceptor;}

    public function getAsunto(){
        return $this->asunto;}

    public function getMensaje(){
        return $this->menssaje;}

    public function getIdMensaje(){
        return $this->idBuzon;}

    public function getFecha(){
        return $this->fecha;}

    public function getLeido(){
        return $this->leido;}

}// FIN DE LA CLASE 
