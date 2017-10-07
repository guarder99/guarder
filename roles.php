<?php
   class Roles{
       private $_conexion;
       private $_idRoles;
       private $_nombreRoles;
       private $_estudianteRoles;
       private $_municipioRoles;
       private $_departamentoRoles;
       private $_padresRoles;
       private $_parentescoRoles;
       private $_incidenciaRoles;
       private $_enfermedadRoles;
       private $_restriccionesRoles;
       private $_avancesRoles;
       private $_profesoresRoles;
       private $_cursosRoles;
       private $_nivelRoles;
       private $_matriculaRoles;
       private $_mensualidadRoles;
       private $_acudienteRoles;
       private $_usuarioRoles;
       private $_rolesRoles;
       private $_paginacion = 10;
       
       function __construct($conexion, $idRoles, $nombreRoles, $estudianteRoles, $municipioRoles, $departamentoRoles, $padresRoles, $parentescoRoles, $incidenciaRoles, $enfermedadRoles, $restriccionesRoles, $avancesRoles, $profesoresRoles, $cursosRoles, $nivelRoles, $matriculaRoles, $mensualidadRoles, $acudienteRoles, $usuarioRoles, $rolesRoles){
           $this->_conexion = $conexion;
           $this->_idRoles = $idRoles;
           $this->_nombreRoles = $nombreRoles;
           $this->_estudianteRoles = $estudianteRoles;
           $this->_municipioRoles = $municipioRoles;
           $this->_departamentoRoles = $departamentoRoles;
           $this->_padresRoles = $padresRoles;
           $this->_parentescoRoles = $parentescoRoles;
           $this->_incidenciaRoles = $incidenciaRoles;
           $this->_enfermedadRoles = $enfermedadRoles;
           $this->_restriccionesRoles = $restriccionesRoles;
           $this->_avancesRoles = $avancesRoles;
           $this->_profesoresRoles = $profesoresRoles;
           $this->_cursosRoles = $cursosRoles;
           $this->_nivelRoles = $nivelRoles;
           $this->_matriculaRoles = $matriculaRoles;
           $this->_mensualidadRoles = $mensualidadRoles;
           $this->_acudienteRoles = $acudienteRoles;
           $this->_usuarioRoles = $usuarioRoles;
           $this->_rolesRoles = $rolesRoles;
           
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Roles (idRoles, nombreRoles, estudianteRoles, municipioRoles, departamentoRoles, padresRoles, parentescoRoles, incidenciaRoles, enfermedadRoles, restriccionesRoles, avancesRoles, profesoresRoles,
           cursosRoles, nivelRoles, matriculaRoles, mensualidadRoles, acudienteRoles, usuarioRoles, rolesRoles) values (NULL,'$this->_nombreRoles','$this->_estudianteRoles','$this->_municipioRoles','$this->_departamentoRoles','$this->_padresRoles', '$this->_parentescoRoles','$this->_incidenciaRoles','$this->_enfermedadRoles','$this->_restriccionesRoles','$this->_avancesRoles','$this->_profesoresRoles','$this->_cursosRoles','$this->_nivelRoles','$this->_matriculaRoles','$this->_mensualidadRoles', '$this->_acudienteRoles', '$this->_usuarioRoles', '$this->_rolesRoles')") or 
               die (mysqli_error($this->_conexion));
          session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){       
           $modificacion = mysqli_query($this->_conexion,"UPDATE Roles SET nombreRoles='$this->_nombreRoles', estudianteRoles='$this->_estudianteRoles', municipioRoles='$this->_municipioRoles', departamentoRoles='$this->_departamentoRoles', padresRoles='$this->_padresRoles', parentescoRoles='$this->_parentescoRoles', incidenciaRoles='$this->_incidenciaRoles', enfermedadRoles='$this->_enfermedadRoles', restriccionesRoles='$this->_restriccionesRoles', avancesRoles='$this->_avancesRoles', profesoresRoles='$this->_profesoresRoles', nivelRoles='$this->_nivelRoles', cursosRoles = '$this->_cursosRoles', matriculaRoles='$this->_matriculaRoles', mensualidadRoles='$this->_mensualidadRoles', acudienteRoles='$this->_acudienteRoles', usuarioRoles='$this->_usuarioRoles', rolesRoles='$this->_rolesRoles'
           WHERE idRoles=$this->_idRoles") or 
               die (mysqli_error($this->_conexion));
           session_start();
          $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $modificacion;
       }
       function eliminar(){
           $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Roles
           WHERE idRoles=$this->_idRoles");
          session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idRoles)/$this->_paginacion) AS cantidad FROM roles")
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
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Roles ORDER BY idRoles") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Roles ORDER BY idRoles
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>