<?php

require_once 'BD/conexion.php';

class Pdf_1 extends BD {
 private $conex;

 public function __construct(){

   $this->conex = parent::__construct();

      }// fin del constructor

      public function buscar_operativo_diversidad($id){
        $strSql = "SELECT * from operativo_diversidad
        INNER JOIN operativo
        ON operativo_diversidad.id_operativo_nuevo = operativo.id_operativo
        INNER JOIN clasificacion
        ON operativo.id_tipo_operativo = clasificacion.id_clasificacion
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

      public function usuarios_por_pagar($id){
        $strSql = "SELECT * from usuario
        LEFT JOIN operativo_usuario
        ON operativo_usuario.id_usuario_ = usuario.id_usuario
        AND operativo_usuario.id_operativo_ ='$id'
        LEFT JOIN operativo 
        ON operativo_usuario.id_operativo_ = operativo.id_operativo 
        WHERE operativo_usuario.id_operativo_ IS NULL
        AND rol != 'superu' 
        AND rol != 'administrador'
        ";
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


        public function usuarios_por_pagar_individual($id, $dependencia){
          $strSql = "SELECT * from usuario
          LEFT JOIN operativo_usuario
          ON operativo_usuario.id_usuario_ = usuario.id_usuario
          AND operativo_usuario.id_operativo_ ='$id'
          LEFT JOIN operativo 
          ON operativo_usuario.id_operativo_ = operativo.id_operativo 
          WHERE operativo_usuario.id_operativo_ IS NULL
          AND rol='$dependencia'";
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

        public function usuarios_por_pagar_individual_doc($id, $dependencia, $depend2){
          $strSql = "SELECT * from usuario
          LEFT JOIN operativo_usuario
          ON operativo_usuario.id_usuario_ = usuario.id_usuario
          AND operativo_usuario.id_operativo_ ='$id'
          LEFT JOIN operativo 
          ON operativo_usuario.id_operativo_ = operativo.id_operativo 
          WHERE operativo_usuario.id_operativo_ IS NULL
          AND tipo_rol='$dependencia'
          AND dependencia='$depend2'";
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

        public function usuarios_pagos(){
              $strSql = "SELECT * from usuario
                             LEFT JOIN operativo_usuario
                                    ON operativo_usuario.id_usuario_ = usuario.id_usuario
                            LEFT JOIN operativo 
                                    ON operativo_usuario.id_operativo_ = operativo.id_operativo 
                                 WHERE operativo_usuario.id_operativo_ IS NOT NULL
                                   AND tipo_rol = '4'";
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


      public function consultarMoroso($id){
        $strSql = "SELECT * from usuario
        LEFT JOIN operativo_usuario
        ON operativo_usuario.id_usuario_ = usuario.id_usuario
        AND operativo_usuario.id_operativo_ ='$id'
        WHERE operativo_usuario.id_operativo_ IS NULL
        AND usuario.tipo_rol = '4'
        ORDER BY area ASC";
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

       public function consultarMorosoInicio(){
       $strSql = "SELECT *, count(id_usuario) as cantidad from usuario
                      LEFT JOIN operativo_usuario
                             ON operativo_usuario.id_usuario_ = usuario.id_usuario
                      INNER JOIN operativo
                            ON operativo_usuario.id_operativo_ = operativo.id_operativo
                          WHERE operativo_usuario.id_operativo_ IS NULL
                            AND usuario.tipo_rol = '4'
                       ORDER BY area ASC";
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


        public function consultarMoroso_individual($id, $operador, $dependencia){
          $strSql = "SELECT * from usuario
          LEFT JOIN operativo_usuario
          ON operativo_usuario.id_usuario_ = usuario.id_usuario
          AND operativo_usuario.id_operativo_ ='$id'
          WHERE operativo_usuario.id_operativo_ IS NULL
          AND usuario.area = $operador
          AND usuario.dependencia = $dependencia";
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

        public function consultarOperativo(){
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

      public function operativo_entregado(){

        $strSql = "SELECT * FROM operativo_usuario
        LEFT JOIN usuario 
        ON operativo_usuario.id_usuario_ = usuario.id_usuario
        LEFT JOIN operativo 
        ON operativo_usuario.id_operativo_ = operativo.id_operativo
        WHERE estatud = 'si'";
        $respuestaArreglo = '';
        try {
          $strExec = BD::prepare($strSql);
          $strExec->execute();
          $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
                $respuestaArreglo += ['estatus' => true];
                return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

          public function operativo_entregado_individual($dependencia, $identificacionOperador){

            $strSql = "SELECT * FROM operativo_usuario
                           LEFT JOIN usuario 
                                  ON operativo_usuario.id_usuario_ = usuario.id_usuario
                           LEFT JOIN operativo 
                                  ON operativo_usuario.id_operativo_ = operativo.id_operativo
                               WHERE estatud = 'si'
                                 AND usuario.dependencia='$dependencia'
                                 AND usuario.area='$identificacionOperador'";
            $respuestaArreglo = '';
            try {
              $strExec = BD::prepare($strSql);
              $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
                $respuestaArreglo += ['estatus' => true];
                return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

          public function operativo_no_entregado(){

            $strSql = "SELECT * FROM operativo_usuario
            LEFT JOIN usuario 
            ON operativo_usuario.id_usuario_ = usuario.id_usuario
            LEFT JOIN operativo 
            ON operativo_usuario.id_operativo_ = operativo.id_operativo
            WHERE estatud = 'no'";
            $respuestaArreglo = '';
            try {
              $strExec = BD::prepare($strSql);
              $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
                $respuestaArreglo += ['estatus' => true];
                return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

          public function operativo_no_entregado_individual($dependencia, $identificacionOperador){

            $strSql = "SELECT * FROM operativo_usuario
            LEFT JOIN usuario 
            ON operativo_usuario.id_usuario_ = usuario.id_usuario
            LEFT JOIN operativo 
            ON operativo_usuario.id_operativo_ = operativo.id_operativo
            WHERE estatud = 'no'
            AND usuario.dependencia='$dependencia'
            AND usuario.area ='$identificacionOperador'";
            $respuestaArreglo = '';
            try {
              $strExec = BD::prepare($strSql);
              $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
                $respuestaArreglo += ['estatus' => true];
                return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

          public function operativos_por_pagar(){
            $strSql = 'SELECT *FROM operativo
            LEFT JOIN operativo_usuario
            ON operativo.id_operativo = operativo_usuario.id_operativo_
            WHERE operativo_usuario.id_operativo_ is null';
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

          public function personalRol($rol){
            $strSql = "SELECT * FROM usuario
            WHERE area='$rol'";
            $respuestaArreglo = '';
            try {
              $strExec = BD::prepare($strSql);
              $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
              $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
              return $respuestaArreglo;
            } catch (PDOException $e) { 
              $errorReturn += ['info' => "error sql:{$e}"];
              return $errorReturn; 
            }
          }

          public function personal_individual($dependencia, $operador){
            $strSql = "SELECT * FROM usuario
                           LEFT JOIN roles 
                                  ON usuario.tipo_rol = roles.idRol
                               WHERE tipo_rol= roles.idRol
                                 AND dependencia = '$dependencia'
                                 AND area ='$operador'";
            $respuestaArreglo = '';
            try {
              $strExec = BD::prepare($strSql);
              $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
              $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
              return $respuestaArreglo;
            } catch (PDOException $e) { 
              $errorReturn += ['info' => "error sql:{$e}"];
              return $errorReturn; 
            }
          }

          public function personal(){
            $strSql = "SELECT * FROM usuario
            WHERE tipo_rol = '4'
            ORDER BY area ASC";
            $respuestaArreglo = '';
            try {
              $strExec = BD::prepare($strSql);
              $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
              $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
              return $respuestaArreglo;
            } catch (PDOException $e) { 
              $errorReturn += ['info' => "error sql:{$e}"];
              return $errorReturn; 
            }
          }

          public function usuario($usuario){
            $strSql = "SELECT * FROM usuario  
            LEFT JOIN roles 
            ON usuario.tipo_rol = roles.idRol
            WHERE tipo_rol='$usuario'";
            $respuestaArreglo = '';
            try {
              $strExec = BD::prepare($strSql);
              $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
              $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
              return $respuestaArreglo;
            } catch (PDOException $e) { 
              $errorReturn += ['info' => "error sql:{$e}"];
              return $errorReturn; 
            }
          }

          public function usuarios(){
            $strSql = "SELECT * FROM usuario 
            LEFT JOIN roles
            ON usuario.tipo_rol = roles.idRol
            WHERE usuario.tipo_rol !='4'
            AND usuario.tipo_rol !='1'
            ORDER BY tipo_rol ASC";
            $respuestaArreglo = '';
            try {
              $strExec = BD::prepare($strSql);
              $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
              $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
              return $respuestaArreglo;
            } catch (PDOException $e) { 
              $errorReturn += ['info' => "error sql:{$e}"];
              return $errorReturn; 
            }
          }

          public function usuariosMasSU(){
            $strSql = "SELECT * FROM usuario 
            LEFT JOIN roles
            ON usuario.tipo_rol = roles.idRol
            WHERE usuario.tipo_rol !='4'
            ORDER BY tipo_rol ASC";
            $respuestaArreglo = '';
            try {
              $strExec = BD::prepare($strSql);
              $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
              $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
              return $respuestaArreglo;
            } catch (PDOException $e) { 
              $errorReturn += ['info' => "error sql:{$e}"];
              return $errorReturn; 
            }
          }

   }// fin de la clase
   ?>

