<?php
   class Usuario{
       private $_conexion;
       private $_idUsuario;
       private $_nombreUsuario;
       private $_correoUsuario;
       private $_claveUsuario;
       private $_fechaRegistroUsuario;
       private $_celularUsuario;
       private $_idRolesUsuario;
       
       
       private $_paginacion = 10;
       
       function __construct($conexion, $idUsuario, $nombreUsuario, $correoUsuario, $claveUsuario, $fechaRegistroUsuario, $celularUsuario, $idRolesUsuario){
           $this->_conexion = $conexion;
           $this->_idUsuario = $idUsuario;
           $this->_nombreUsuario = $nombreUsuario;
           $this->_correoUsuario = $correoUsuario;
           $this->_claveUsuario = $claveUsuario;
           $this->_fechaRegistroUsuario = $fechaRegistroUsuario;
           $this->_celularUsuario = $celularUsuario;
           $this->_idRolesUsuario = $idRolesUsuario;       
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Usuario (idUsuario, nombreUsuario, correoUsuario, claveUsuario, fechaRegistroUsuario, celularUsuario, idRolesUsuario) values (NULL,'$this->_nombreUsuario','$this->_correoUsuario','".hash('sha256',$this->_claveUsuario)."','$this->_fechaRegistroUsuario','$this->_celularUsuario','$this->_idRolesUsuario')") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){
        $consultaClave=mysqli_query($this->_conexion,"SELECT CONVERT(claveUsuario, CHAR(100)) AS claveOriginal FROM usuario WHERE idusuario = $this->_idUsuario");
        $unregistro=mysqli_fetch_array($consultaClave);
        $claveOriginal = $unregistro['claveOriginal'];
        
        if ($this->_claveUsuario==$claveOriginal){
            $modificacion=mysqli_query($this->_conexion,"UPDATE usuario SET nombreUsuario='$this->_nombreUsuario', correoUsuario='$this->_correoUsuario', claveUsuario='$this->_claveUsuario', fechaRegistroUsuario='$this->_fechaRegistroUsuario', celularusuario='$this->_celularUsuario',idRolesUsuario='$this->_idRolesUsuario' WHERE idUsuario=$this->_idUsuario")or die (mysqli_error($this->_conexion)); 
        }
       else{
            $modificacion=mysqli_query($this->_conexion,"UPDATE Usuario SET nombreUsuario='$this->_nombreUsuario', correoUsuario='$this->_correoUsuario', claveUsuario='".hash('sha256',$this->_claveUsuario)."', fechaRegistroUsuario='$this->_fechaRegistroUsuario', celularUsuario='$this->_celularUsuario',idRolesusuario='$this->_idRolesUsuario' WHERE idUsuario=$this->_idUsuario")or die (mysqli_error($this->_conexion));
        }
            session_start();
          $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $modificacion;
       }
                                     
       function eliminar(){
           $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Usuario
           WHERE idUsuario=$this->_idUsuario");
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idUsuario)/$this->_paginacion) AS cantidad FROM usuario")
                  or die(mysqli_error($this->_conexion));
           $unRegistro=mysqli_fetch_array($cantidadBloques);
           return $unRegistro['cantidad'];
       }
       function getRoles($idUsuario){
        $roles=mysqli_query($this->_conexion, "SELECT ".static::class."roles AS elpermiso FROM roles WHERE idRoles IN(SELECT idRolesUsuario FROM Usuario WHERE idUsuario =$idUsuario)") or die (mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($roles);
        return $unregistro['elpermiso'];
    }
       function listar($pagina){
           if ($pagina<=0){
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Usuario ORDER BY idUsuario") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Usuario ORDER BY idUsuario
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>