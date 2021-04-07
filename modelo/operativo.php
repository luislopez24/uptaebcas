<?php

  require_once 'BD/conexion.php';
 
  class Operativo extends BD {
    
     private $nombre_operativo;
     private $precio_operativo;
     private $fecha_inicio_operativo;
     private $fecha_final_operativo;
     private $descripcion;
     private $estado;
     private $banco_admitido;
     private $foto;
     private $notificar_vencimiento;

     private $conex;
     private $delete;

     public function __construct(){
                     
                 $this->conex = parent::__construct();
                
      }// fin del constructor

      //  CRUD
        public function Registrar(){
         $strSql = 'INSERT INTO operativo (nombre_operativo,
                                           precio_operativo,
                                           descripcion, 
                                           estado,
                                           banco_admitido,
                                           fecha_inicio_operativo,
                                           fecha_final_operativo,
                                           foto)
                                  VALUES (:nombre_operativo,
                                          :precio_operativo,
                                          :descripcion,
                                          :estado,
                                          :banco_admitido,
                                          :fecha_inicio_operativo,
                                          :fecha_final_operativo,
                                          :foto)'; 
             $respuestaArreglo = '';  
               
              try {

                $strExec = BD::prepare($strSql); 
                $strExec->bindValue(':nombre_operativo', $this->nombre_operativo);
                $strExec->bindValue(':precio_operativo', $this->precio_operativo);
                $strExec->bindValue(':descripcion', $this->descripcion);
                $strExec->bindValue(':estado', $this->estado);
                $strExec->bindValue(':banco_admitido', $this->banco_admitido);
                $strExec->bindValue(':fecha_inicio_operativo', $this->fecha_inicio_operativo);
                $strExec->bindValue(':fecha_final_operativo', $this->fecha_final_operativo);
                $strExec->bindValue(':foto', $this->foto);
                $strExec->execute(); 
              
                $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
                $respuestaArreglo += ['estatus' => 'true'];
                return $respuestaArreglo;
              } 

                catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['estatus' => 'false'];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }
        }// fin del metodo Registrar

        public function buscar_operativo($nom){
            $strSql = "SELECT * FROM operativo WHERE nombre_operativo ='$nom'";
            $respuestaArreglo = '';
                 try {
              $strExec =  BD::prepare($strSql);
              $strExec->execute();
            $strExec ->setFetchMode(PDO::FETCH_ASSOC);
              $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
              $respuestaArreglo += ['estatus' => true];
            return $respuestaArreglo;
            } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
              $errorReturn = ['estatus' => false];
              $errorReturn += ['info' => "error sql:{$e}"];
              return $errorReturn; ; //retornamos el contenido de esa variable
            }// fin del catch
        }// fin del metodo Buscar

        //CONSULTAR ULTIMO ID 
        public function ultimo_id(){
              $strSql = 'SELECT MAX(id_operativo) AS id FROM operativo';
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

        //CONSULTAR PURO 
        public function consultarClasificacion(){
              $strSql = 'SELECT distinct clasificacion.nombre_clasificacion, 
                                         id_operativo_nuevo, 
                                         clasificacion.id_clasificacion 
                                    FROM operativo_diversidad 
                              INNER JOIN diversidad 
                                      ON operativo_diversidad.id_diversidad_operativo = diversidad.id_diversidad 
                              INNER JOIN catalogo 
                                      ON diversidad.id_catalogo = catalogo.id_catalogo 
                              INNER JOIN clasificacion 
                                      ON catalogo.id_clasificacion = clasificacion.id_clasificacion';
              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
                return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

          public function consultar_search($id_o){
              $strSql = "SELECT *FROM operativo 
                           INNER JOIN clasificacion
                                   ON operativo.id_tipo_operativo = clasificacion.id_clasificacion 
                                WHERE id_operativo = $id_o";
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
 
        //LEFT JOIN  PARA EVITAR PUBLICAR SIN PRODUCTOS REGISTRADOS
        public function consultar_productos_en_el_operativo(){
              $strSql =  "SELECT operativo_diversidad.id_operativo_nuevo, count(operativo_diversidad.id_operativo_nuevo) as conteo,
                                 operativo.nombre_operativo,
                                 operativo.precio_operativo,
                                 operativo.fecha_inicio_operativo,
                                 operativo.banco_admitido,
                                 operativo.descripcion,
                                 operativo.estado,
                                 operativo.id_operativo,
                                 operativo.fecha_final_operativo,
                                 operativo.foto
                            FROM operativo 
                       LEFT JOIN operativo_diversidad
                              ON operativo.id_operativo = operativo_diversidad.id_operativo_nuevo
                        GROUP BY operativo_diversidad.id_operativo_nuevo,
                                 operativo.nombre_operativo,
                                 operativo.precio_operativo,
                                 operativo.descripcion,
                                 operativo.estado,
                                 operativo.id_operativo,
                                 operativo.fecha_inicio_operativo,
                                 operativo.banco_admitido,
                                 operativo.fecha_final_operativo,
                                 operativo.foto";
              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
              return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
               
              }// fin del catch
          }// fin del metodo consultar

          public function consultar_publicacion(){
              $strSql = "SELECT * FROM operativo WHERE estado='on'";
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


          public function consultar_publicacion_(){
              $strSql = "SELECT * FROM operativo WHERE estado!='off'";
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
       
        public function eliminar($id){ // metodo eliminar

        $strSql="DELETE FROM operativo WHERE id_operativo='$id'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }

      public function consultarRegistros(){
      $strSql = "SELECT * from operativo";
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

      public function buscar($id){
      $strSql = "SELECT * FROM operativo  
                        WHERE  id_operativo='".$id."'";
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

       public function clasificacionDelOperativo($id){

            $strSql = "SELECT clasificacion.nombre_clasificacion 
                         FROM operativo_diversidad
                   INNER JOIN diversidad
                           ON operativo_diversidad.id_diversidad_operativo = diversidad.id_diversidad
                   INNER JOIN catalogo
                           ON diversidad.id_catalogo = catalogo.id_catalogo
                   INNER JOIN clasificacion
                           ON catalogo.id_clasificacion = clasificacion.id_clasificacion
                        WHERE operativo_diversidad.id_operativo_nuevo = $id 
                     GROUP BY clasificacion.id_clasificacion";
         
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

      public function buscar_operativo_diversidad($id){
      $strSql = "SELECT * from operativo_diversidad
                    INNER JOIN operativo
                            ON operativo_diversidad.id_operativo_nuevo = operativo.id_operativo
                    INNER JOIN diversidad 
                            ON operativo_diversidad.id_producto_operativo = diversidad.id_diversidad 
                         WHERE id_operativo_nuevo = '$id'";
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

      public function buscarDiversidades_operativo($id){
      $strSql = "SELECT * from operativo 
                    INNER JOIN operativo_diversidad 
                            ON operativo.id_operativo = operativo_diversidad.id_operativo_nuevo
                    INNER JOIN diversidad
                            ON operativo_diversidad.id_diversidad_operativo = diversidad.id_diversidad
                         WHERE id_operativo='$id'";
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

      public function Modificar($id){  
      
         $strSql = "UPDATE operativo 
                       SET nombre_operativo = :nombre_operativo, 
                           precio_operativo = :precio_operativo,
                           fecha_inicio_operativo = :fecha_inicio_operativo,
                           fecha_final_operativo = :fecha_final_operativo,
                           descripcion = :descripcion,
                           banco_admitido = :banco_admitido,
                           foto = :foto
                     WHERE id_operativo='$id'";
          $respuestaArreglo = '';
              
              try {

                $strExec = BD::prepare($strSql); 
                $strExec->bindValue(':nombre_operativo', $this->nombre_operativo);
                $strExec->bindValue(':precio_operativo', $this->precio_operativo);
                $strExec->bindValue(':fecha_inicio_operativo', $this->fecha_inicio_operativo);
                $strExec->bindValue(':fecha_final_operativo', $this->fecha_final_operativo);
                $strExec->bindValue(':descripcion', $this->descripcion);
                $strExec->bindValue(':banco_admitido', $this->banco_admitido);
                $strExec->bindValue(':foto', $this->foto);
                $strExec->execute(); 
              
                $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
                $respuestaArreglo += ['estatus' => 'true'];
                return $respuestaArreglo;
              
              } 

                catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
            }
        
          }

          public function publicar($id){   //funcion para modificar al usuarios
      
         $strSql = "UPDATE operativo 
                       SET estado = :estado
                     WHERE id_operativo='$id'";
          $respuestaArreglo = '';
              
              try {
                $strExec = BD::prepare($strSql);
                $strExec->bindValue(':estado', $this->estado);
                $strExec->execute(); 
              
                $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
                return $respuestaArreglo;
              
              } 

                catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
            }
        
          }

          public function activar($id){   //funcion para modificar al usuarios
      
         $strSql = "UPDATE operativo 
                       SET estado = :estado,
                           fecha_final_operativo = :fecha_final_operativo
                     WHERE id_operativo='$id'";
          $respuestaArreglo = '';
              
              try {
                $strExec = BD::prepare($strSql);
                $strExec->bindValue(':estado', $this->estado);
                $strExec->bindValue(':fecha_final_operativo', $this->fecha_final_operativo);
                $strExec->execute(); 
              
                $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
                return $respuestaArreglo;
              
              } 

                catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
            }
        
          }

          public function notificarOperativo($id){   //funcion para modificar al usuarios
      
         $strSql = "UPDATE operativo 
                       SET notificar_vencimiento = :notificar_vencimiento
                     WHERE id_operativo='$id'";
          $respuestaArreglo = '';
              
              try {
                $strExec = BD::prepare($strSql);
                $strExec->bindValue(':notificar_vencimiento', $this->notificar_vencimiento);
                $strExec->execute(); 
              
                $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
                return $respuestaArreglo;
              
              } 

                catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
            }
        
          }
               
              // METODOS SETTER

              public function setFoto($foto){
              $this->foto=$foto;}

              public function setnombre_operativo($nomb){
                $this->nombre_operativo=$nomb;   
              }

              public function setprecio_operativo($precio){
                $this->precio_operativo=$precio;
              }
              
              public function setfecha_inicio_operativo($fechai){
                $this->fecha_inicio_operativo=$fechai;
              }

              public function setfecha_final_operativo($fechaf){
                $this->fecha_final_operativo=$fechaf;
              }

              public function setDescripcion($descrip){
                $this->descripcion=$descrip;
              }

              public function setestado($estatud){
                $this->estado=$estatud;
              }

              public function setBanco_admitido($banco){
                $this->banco_admitido=$banco;
              }

              public function setNot($notificarO){
                $this->notificar_vencimiento=$notificarO;
              }

              // METODOS GETTER

             public function getFoto(){
             return $this->foto;}

             public function getnombre_operativo(){
                  return $this->nombre_operativo;    
              }

              public function getNotVenc(){
                  return $this->notificar_vencimiento;    
              }

              public function getprecio_operativo(){
                  return $this->precio_operativo;
              }
              
              public function getfecha_inicio_operativo(){
                  return $this->fecha_inicio_operativo;
              }

              public function getfecha_final_operativo(){
                  return $this->fecha_final_operativo;
              }

              public function getDescripcion(){
                  return $this->descripcion;
              }

              public function getestado(){
                return $this->estado;
              }

              public function getBanco_admitido(){
                return $this->banco_admitido;
              }

          }// fin de la clase
?>
