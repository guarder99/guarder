<?php
   class Login{
       private $_conexion;
       private $_idUsuario;
       private $_emailUsuario;
       private $_hashedClaveUsuario;
       private $_nombreUsuario;
       private $_idRolesUsuario;
       
       function __construct($conexion, $correo, $clave){
           $this->_conexion = $conexion;
           $this->_emailUsuario = $correo;
           $this->_hashedClaveUsuario = hash('sha256', $clave);
       }
        function verificarUsuario(){
           $verificacion = mysqli_query($this->_conexion,"SELECT idUsuario, nombreUsuario, idRolesUsuario FROM Usuario WHERE correoUsuario LIKE '$this->_emailUsuario' AND CONVERT(claveUsuario, CHAR(100)) LIKE '$this->_hashedClaveUsuario'") or die (mysqli_error($this->_conexion));
           
         echo "SELECT idUsuario, nombreUsuario, idRolesUsuario FROM Usuario WHERE correoUsuario LIKE '$this->_emailUsuario' AND CONVERT(claveUsuario, CHAR(100)) LIKE '$this->_hashedClaveUsuario'";
            
        if(mysqli_num_rows($verificacion)){
            $unUsuario = mysqli_fetch_array($verificacion);
            $this->_idUsuario          = $unUsuario["idUsuario"];
            $this->_nombreUsuario      = $unUsuario["nombreUsuario"];
            $this->_idRolesUsuario     = $unUsuario["idRolesUsuario"];
            return true;
        }
            return false;
            
        }
       function getIdUsuario(){
           return $this->_idUsuario;
       }
       function getNombreUsuario(){
           return $this->_nombreUsuario;
       }
       function getidRolesUsuario(){
           return $this->_idRolesUsuario;
       }
   }
       ?>
       