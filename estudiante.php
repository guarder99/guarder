<?php
   class Estudiante{
       private $_conexion;
       private $_idEstudiante;
       private $_nombreEstudiante;
       private $_apellidoEstudiante;
       private $_fechaNacimientoEstudiante;
       private $_generoEstudiante;
       private $_idMunicipioEstudiante;
       private $_idPadreEstudiante;
       private $_idMadreEstudiante;
       private $_idAcudienteEstudiante;
       private $_idCursoEstudiante;
       
       private $_paginacion = 10;
       
       function __construct($conexion, $idEstudiante, $nombreEstudiante, $apellidoEstudiante, $fechaNacimientoEstudiante, $generoEstudiante, $idMunicipioEstudiante, $idPadreEstudiante, $idMadreEstudiante, $idAcudienteEstudiante, $idCursoEstudiante){
           $this->_conexion = $conexion;
           $this->_idEstudiante = $idEstudiante;
           $this->_nombreEstudiante = $nombreEstudiante;
           $this->_apellidoEstudiante = $apellidoEstudiante;
           $this->_fechaNacimientoEstudiante = $fechaNacimientoEstudiante;
           $this->_generoEstudiante = $generoEstudiante;
           $this->_idMunicipioEstudiante = $idMunicipioEstudiante;
           $this->_idPadreEstudiante = $idPadreEstudiante;
           $this->_idMadreEstudiante = $idMadreEstudiante;
           $this->_idAcudienteEstudiante = $idAcudienteEstudiante;
           $this->_idCursoEstudiante = $idCursoEstudiante;
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Estudiante (idEstudiante, nombreEstudiante, apellidoEstudiante,  fechaNacimientoEstudiante, generoEstudiante, idMunicipioEstudiante, idPadreEstudiante, idMadreEstudiante, idAcudienteEstudiante,  idCursoEstudiante) values (NULL,'$this->_nombreEstudiante','$this->_apellidoEstudiante','$this->_fechaNacimientoEstudiante','$this->_generoEstudiante','$this->_idMunicipioEstudiante','$this->_idPadreEstudiante','$this->_idMadreEstudiante','$this->_idAcudienteEstudiante','$this->_idCursoEstudiante')") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){  
           $modificacion = mysqli_query($this->_conexion,"UPDATE Estudiante SET nombreEstudiante='$this->_nombreEstudiante',  apellidoEstudiante='$this->_apellidoEstudiante', fechaNacimientoEstudiante='$this->_fechaNacimientoEstudiante',generoEstudiante='$this->_generoEstudiante', idMunicipioEstudiante='$this->_idMunicipioEstudiante',idPadreEstudiante='$this->_idPadreEstudiante',idMadreEstudiante='$this->_idMadreEstudiante',idAcudienteEstudiante='$this->_idAcudienteEstudiante',idCursoEstudiante='$this->_idCursoEstudiante'
           WHERE idEstudiante=$this->_idEstudiante") or   die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));;
           return $modificacion;
       }
       function eliminar(){
           $elminacion = mysqli_query($this->_conexion,"DELETE FROM Estudiante
           WHERE idEstudiante=$this->_idEstudiante");
           session_start();
          $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));;
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idEstudiante)/$this->_paginacion) AS cantidad FROM estudiante")
                  or die(mysqli_error($this->_conexion));
           $unRegistro=mysqli_fetch_array($cantidadBloques);
           return $unRegistro['cantidad'];
       }
       function getRoles($idUsuario){
        $roles=mysqli_query($this->_conexion, "SELECT ".static::class."roles AS elpermiso FROM roles WHERE idRoles IN(SELECT idRolesUsuario FROM Usuario WHERE idusuario =$idUsuario)") or die (mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($roles);
        return $unregistro['elpermiso'];
    }
       function listar($pagina){
           if ($pagina<=0){
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Estudiante ORDER BY idEstudiante") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Estudiante ORDER BY idEstudiante
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>