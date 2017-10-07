<?php
   class Profesores{
       private $_conexion;
       private $_idProfesores;
       private $_documentoProfesores;
       private $_nombreProfesores;
       private $_celularProfesores;
       private $_direccionProfesores;
       private $_correoProfesores;
       private $_fechaIngreso;
       private $_idEstudiantesProfesores;
       private $_esAuxiliar;
       private $_idEsAuxiliar;
       private $_paginacion = 10;
       
       function __construct($conexion, $idProfesores, $documentoProfesores, $nombreProfesores,  $celularProfesores, $direccionProfesores, $correoProfesores, $fechaIngreso, $idEstudiantesProfesores, $esAuxiliar, $idEsAuxiliar){
           $this->_conexion = $conexion;
           $this->_idProfesores = $idProfesores;
           $this->_documentoProfesores = $documentoProfesores;
           $this->_nombreProfesores = $nombreProfesores;
           $this->_celularProfesores = $celularProfesores;
           $this->_direccionProfesores = $direccionProfesores;
           $this->_correoProfesores = $correoProfesores;
           $this->_fechaIngreso = $fechaIngreso;
           $this->_idEstudiantesProfesores = $idEstudiantesProfesores;
           $this->_esAxuiliar = $esAuxiliar;
           $this->_idEsAuxiliar = $idEsAuxiliar;        
           
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Profesores (idProfesores, documentoProfesores, nombreProfesores,  celularProfesores,  direccionProfesores, correoProfesores, fechaIngreso, idEstudiantesProfesores, esAuxiliar, idEsAuxiliar) values (NULL,'$this->_documentoProfesores', '$this->_nombreProfesores',  '$this->_celularProfesores','$this->_direccionProfesores','$this->_correoProfesores','$this->_fechaIngreso', '$this->_idEstudiantesProfesores', '$this->_esAxuiliar', '$this->_idEsAuxiliar')") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){

           $modificacion = mysqli_query($this->_conexion,"UPDATE Profesores SET documentoProfesores='$this->_documentoProfesores', nombreProfesores='$this->_nombreProfesores',  celularProfesores='$this->_celularProfesores', direccionProfesores='$this->_direccionProfesores', correoProfesores='$this->_correoProfesores', fechaIngreso='$this->_fechaIngreso', idEstudiantesProfesores='$this->_idEstudiantesProfesores', esAuxiliar= '$this->_esAxuiliar', idEsAuxiliar= '$this->_idEsAuxiliar' WHERE idProfesores=$this->_idProfesores") or   die (mysqli_error($this->_conexion));
           session_start();
          $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $modificacion;
       }
       function eliminar(){
           $elminacion = mysqli_query($this->_conexion,"DELETE FROM Profesores
           WHERE idProfesores=$this->_idProfesores");
          session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idProfesores)/$this->_paginacion) AS cantidad FROM profesores")
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
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Profesores ORDER BY idProfesores") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Profesores ORDER BY idProfesores
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>