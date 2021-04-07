<?php

  require_once 'BD/conexion.php';
 
   class Usuario extends BD{
     
     private $id_usuario;
     private $nombre;
     private $apellido;
     private $tcedula;
     private $cedula;
     private $fecha_n;
     private $email;
     private $temail;
     private $tcelular;
     private $celular;
     private $area;
     private $dependencia;
     private $direccion;
     private $tipo_rol;
     private $contrasena;
     private $foto;
     private $status;
    
     public $conex;
     public function __construct(){
        $this->conex = parent::__construct();
    }// fin del constructor


    // METODOS SETTER
    public function setid($id){
      $this->id_usuario=$id;}

    public function setFoto($foto){
      $this->foto=$foto;}

    public function setNombre($nom){
      $this->nombre=$nom;}

    public function setApellido($ape){
      $this->apellido=$ape;}

    public function setTcedula($tci){
      $this->tcedula=$tci;}

    public function setCedula($ci){
      $this->cedula=$ci;}

    public function setFecha_n($fechan){
      $this->fecha_n=$fechan;}

    public function setEmail($correo){
      $this->email=$correo;}

    public function setTemail($tcorreo){
      $this->temail=$tcorreo;}

    public function setTcelular($tcel){
      $this->tcelular=$tcel;}

    public function setCelular($cel){
      $this->celular=$cel;}

    public function setArea($areas){
      $this->area=$areas;}

    public function setDependencia($are){
      $this->dependencia=$are;}

    public function setDireccion($direc){
      $this->direccion=$direc;}

    public function setRol($tipo){
      $this->tipo_rol=$tipo;}

    public function setContrasena($passw){
      $this->contrasena=$passw;}

    public function setEstatus($tatu){
      $this->status=$tatu;}

    // METODOS GETTER
    public function getid(){
      return $this->id_usuario;}

    public function getFoto(){
      return $this->foto;}

    public function getConex(){
      return $this->conex;}
    
    public function getNombre(){
      return $this->nombre;}

    public function getApellido(){
      return $this->apellido;}

    public function getTcedula(){
      return $this->tcedula;}

    public function getCedula(){
      return $this->cedula;}

    public function getFecha_n(){
      return $this->fecha_n;}

    public function getEmail(){
      return $this->email;}

    public function getTemail(){
      return $this->temail;}

    public function getTcelular(){
      return $this->tcelular;}

    public function getCelular(){
      return $this->celular;}

    public function getArea(){
      return $this->area;}

    public function getDependencia(){
      return $this->dependencia;}

    public function getDireccion(){
      return $this->direccion;}

    public function getRol(){
      return $this->tipo_rol;}

    public function getContrasena(){
      return $this->contrasena;}

    public function getEstatus(){
      return $this->status;}

    public function __toString(){
      return $this->nombre . '   ' .$this->cedula;}

    
    // ________________CRUD_________________________

     public function Registrar(){
       $strSql = 'INSERT INTO usuario (
                              nombre, 
                              apellido,
                              tcedula,
                              cedula,
                              contrasena,
                              fecha_n,
                              email,
                              temail,
                              tcelular,
                              celular,
                              area,
                              dependencia,
                              direccion,
                              tipo_rol,
                              status) 
                      VALUES (:nombre, 
                              :apellido,
                              :tcedula,
                              :cedula,
                              :contrasena,
                              :fecha_n,
                              :email,
                              :temail,
                              :tcelular,
                              :celular,
                              :area,
                              :dependencia,
                              :direccion,
                              :tipo_rol,
                              :status)'; 
     $respuestaArreglo = '';  

      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindParam(':nombre', $this->nombre);
        $strExec->bindParam(':apellido', $this->apellido);
        $strExec->bindParam(':tcedula', $this->tcedula);
        $strExec->bindParam(':cedula', $this->cedula);
        $strExec->bindParam(':contrasena', $this->contrasena);
        $strExec->bindParam(':fecha_n', $this->fecha_n);
        $strExec->bindParam(':email', $this->email);
        $strExec->bindParam(':temail', $this->temail);
        $strExec->bindParam(':tcelular', $this->tcelular);
        $strExec->bindParam(':celular', $this->celular);
        $strExec->bindParam(':area', $this->area);
        $strExec->bindParam(':dependencia', $this->dependencia);
        $strExec->bindParam(':direccion', $this->direccion);
        $strExec->bindParam(':tipo_rol', $this->tipo_rol);
        $strExec->bindParam(':status', $this->status);

        $strExec->execute(); 
        $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
        $respuestaArreglo += ['estatus' => true];
        return $respuestaArreglo;
      } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
        $respuestaArreglo += ['estatus' => false];
        return $errorReturn; //retornamos el contenido de esa variable
      }


} // fin del registrar

//CONSULTAR ULTIMO ID 
        public function ultimo_idUsuario(){
              $strSql = 'SELECT MAX(id_usuario) AS id FROM usuario';
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

public function consultarPuroBeneficiario(){
              $strSql = "SELECT * FROM usuario WHERE tipo_rol = '4'";
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

public function buscar_Usuario_Registrado(){


 $strSql = 'SELECT * FROM usuario WHERE cedula=:cedula AND tipo_rol=:tipo_rol'; 
       $respuestaArreglo = '';
       $strExec = BD::prepare($strSql);  
       $strExec->bindParam(':cedula', $this->cedula);
       $strExec->bindParam(':tipo_rol', $this->tipo_rol);
       $strExec->execute(); 
       $respuestaArreglo = $strExec->fetchAll();
       $respcons= $respuestaArreglo;

      if (isset($respcons[0][0])) {
          $_SESSION["id_ussuario"] = $respcons[0][0];
          $_SESSION["cedula"] = $respcons[0][4];
        
          
          $respuestaArreglo += ['estatus' => true];
          return $respuestaArreglo;
        }
       
        else
        {
          $respuestaArreglo += ['estatus' => false];
          return $respuestaArreglo;
        }


     
} 



      public function buscar($id){
      $strSql = "SELECT * from usuario LEFT JOIN roles ON usuario.tipo_rol = roles.idRol WHERE  id_usuario='".$id."'";
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

  public function buscarPuro($id){
      $strSql = "SELECT * from usuario WHERE  id_usuario='".$id."'";
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

      public function buscar_ci($ci){

      $strSql = "SELECT * FROM usuario WHERE cedula = $ci";
              $respuestaArreglo = '';
              try {
              
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
                $respuestaArreglo += ['estatus' => 'true'];
              
              return $respuestaArreglo;

              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['estatus' => 'false'];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

     public function eliminar($id){ // metodo eliminar

        $strSql="DELETE FROM usuario WHERE id_usuario='$id'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }
        

    public function consultarbenef(){

      $strSql = "SELECT * FROM usuario LEFT JOIN roles ON usuario.tipo_rol = roles.idRol ORDER BY tipo_rol ASC";
              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
              return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos eneficial contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

public function ConsultarBeneficiarioPorSession($dependencia, $identificacionOperador){

      $strSql = "SELECT * FROM usuario 
                  WHERE dependencia = '$dependencia' 
                    AND area = '$identificacionOperador'";
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

public function consultarusuario(){

              $strSql = "SELECT * FROM usuario LEFT JOIN roles ON usuario.tipo_rol = roles.idRol /*WHERE tipo_rol != '1' */ ORDER BY tipo_rol ASC";
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

    public function consultarTipoRol($id){

              $strSql = "SELECT * FROM usuario LEFT JOIN roles ON usuario.tipo_rol = roles.id_rol WHERE usuario.id_usuario = $id";
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


  
  public function modificar($id){
        $strSql = "UPDATE usuario  
                          SET nombre=:nombre, 
                              apellido=:apellido,
                              tcedula=:tcedula,
                              cedula=:cedula,
                              contrasena=:contrasena,
                              fecha_n=:fecha_n,
                              email=:email,
                              temail=:temail,
                              tcelular=:tcelular,
                              celular=:celular,
                              area=:area,
                              dependencia=:dependencia,
                              direccion=:direccion,
                              tipo_rol=:tipo_rol,
                              status=:status
                        WHERE id_usuario='".$id."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':nombre', $this->nombre);
        $strExec->bindValue(':apellido',$this->apellido);
        $strExec->bindValue(':tcedula',$this->tcedula);
        $strExec->bindValue(':cedula',$this->cedula);
        $strExec->bindValue(':contrasena',$this->contrasena);
        $strExec->bindValue(':fecha_n',$this->fecha_n);
        $strExec->bindValue(':email',$this->email);
        $strExec->bindValue(':temail',$this->temail);
        $strExec->bindValue(':tcelular',$this->tcelular);
        $strExec->bindValue(':celular', $this->celular);
        $strExec->bindValue(':area', $this->area);
        $strExec->bindValue(':dependencia', $this->dependencia);
        $strExec->bindParam(':direccion', $this->direccion);
        $strExec->bindParam(':tipo_rol', $this->tipo_rol);
        $strExec->bindParam(':status', $this->status);

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

 public function actPass($id){
        $strSql = "UPDATE usuario  
                          SET contrasena=:contrasena
                        WHERE id_usuario='".$id."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':contrasena',$this->contrasena);

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

public function modificarFoto($id){
        $strSql = "UPDATE usuario  
                          SET foto = :foto 
                        WHERE id_usuario='".$id."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':foto',$this->foto);

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
       
     public function mod_contra($id){
       $strSql = "UPDATE usuario  SET contrasena=:contrasena
                                WHERE id_usuario='".$id."'";
                     
     $respuestaArreglo = '';  
      try {
        $strExec = BD::prepare($strSql);  
        $strExec->bindValue(':contrasena',$this->contrasena);

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

public function entrar(){

       $strSql = 'SELECT * FROM usuario
                          WHERE cedula=:cedula AND contrasena=:contrasena'; 
       $respuestaArreglo = '';
       $strExec = BD::prepare($strSql);  
       $strExec->bindParam(':cedula', $this->cedula);
       $strExec->bindParam(':contrasena', $this->contrasena);
       $strExec->execute(); 
       $respuestaArreglo = $strExec->fetchAll();
       $respcons= $respuestaArreglo;

       if (isset($respcons[0][0])) {
          $_SESSION["id_ussuario"] = $respcons[0][0];
          $_SESSION["nombre"] = $respcons[0][1];
          $_SESSION["apellido"]= $respcons[0][2];
          $_SESSION["tcedula"]= $respcons[0][3];
          $_SESSION["cedula"]= $respcons[0][4];
          $_SESSION["contrasena"] = $respcons[0][5];
          $_SESSION["fecha_n"]= $respcons[0][6];
          $_SESSION["correo"]= $respcons[0][7];
          $_SESSION["tcorreo"]= $respcons[0][8];
          $_SESSION["tcelular"]= $respcons[0][9];
          $_SESSION["celular"]= $respcons[0][10];
          $_SESSION["area"] = $respcons[0][11];
          $_SESSION["dependencia"]= $respcons[0][12];
          $_SESSION["direccion"]= $respcons[0][13];
          $_SESSION["tipo_rol"]= $respcons[0][14];
          $_SESSION["foto"] = $respcons[0][15];
          $_SESSION["status"] = $respcons[0][16];
          
          $respuestaArreglo += ['estatus' => true];
          return $respuestaArreglo;
        }
       
        else
        {
          $respuestaArreglo += ['estatus' => false];
          return $respuestaArreglo;
        }

  }//FIN DE LA FUNCION ENTRAR

   //CONSULTAR ULTIMO ID 
        public function segurityQuestions($id){
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

}// fin de la clase

