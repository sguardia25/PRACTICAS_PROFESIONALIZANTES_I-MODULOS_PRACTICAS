<?php

    include_once 'conexion.php';
    $conexion = new conexion();
    $conexion->conectar();

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST ['correo'];
    $usuario = $_POST ['usuario'];
    $contrasenia = $_POST ['contrasena'];
    $rol=$_POST['rol'];
    $email=$_POST['email'];
    $direccion=$_POST['direccion'];
    $celular=$_POST['celular'];
    
    switch ($_POST['action']) {
            case 'REGISTRAR':
                $query = "INSERT INTO persona (nombre,apellido,usuario,contrasenia,rol,email,Direccion,Celular)
                VALUES ('".$nombre."', '".$apellido."', '".$usuario."', '".$contrasenia."', '".$rol."', '".$email."', '".$direccion."', '".$celular."')";
    
                //VERIFICAR QUE LOS DATOS NO SE REPITAN CORREO
                $consulta_correo = "SELECT * FROM persona WHERE correo= '".$email."'";
                $validar_login = $conexion->conexion->prepare($consulta_correo);
                $validar_login->execute();
            
                if ($validar_login->fetch()>0) {
                    echo"<script>
                    alert('CORREO YA REGISTRADO');
                    window.location = '../admin/accesoadmin.php';
                    </script>";
                    exit();
                }
                
                //VERIFICAR QUE LOS DATOS NO SE REPITAN USUARIO
                $consulta_usuario = "SELECT * FROM persona WHERE usuario= '".$usuario."'";
                $validar_login = $conexion->conexion->prepare($consulta_usuario);
                $validar_login->execute();
            
                if ($validar_login->fetch()>0) {
                    echo"<script>
                    alert('USUARIO YA REGISTRADO');
                    window.location = '../admin/accesoadmin.php';
                    </script>";
                    exit();
                  }
            
                  $ejecutar= $conexion->conexion->prepare($query);
                  $ejecutar->execute();
            
                if ($ejecutar) {
                    echo"<script>
                        alert('USUARIO AGREGADO');
                        window.location = '../admin/accesoadmin.php';
                    </script>";
                } else {
                    "<script>
                        alert('INTENTE NUEVAMENTE');
                        window.location = '../admin/accesoadmin.php';
                    </script>";
                }
                break;
            case 'MODIFICAR':
                $query = "UPDATE persona SET nombre='$nombre',apellido='$apellido',usuario='$usuario',contrasenia='$contrasenia',rol='$rol' WHERE idPersona='".$_POST['id']."'";
                //UPDATE `persona` SET `rol` = '1', `email` = '@gmail.com' WHERE `persona`.`idPersona` = 72;
                //VERIFICAR QUE LOS DATOS NO SE REPITAN CORREO
                 $ejecutar= $conexion->conexion->prepare($query);
                 $ejecutar->execute();
            
                if ($ejecutar) {
                    echo"<script>
                        alert('USUARIO MODIFICADO');
                        window.location = '../admin/accesoadmin.php';
                    </script>";
                } else {
                    "<script>
                        alert('ERROR.INTENTE NUEVAMENTE');
                        window.location = '../admin/accesoadmin.php';
                    </script>";
                }
               
                break;
            case 'ELIMINAR':
                $query="UPDATE FROM persona WHERE idPersona='".$_GET['id']."' ";
                $ejecutar= $conexion->conexion->prepare($query);
                $ejecutar->execute();
            
                if ($ejecutar) {
                    echo"<script>
                        alert('USUARIO ELIMINADO');
                        window.location = '../admin/accesoadmin.php';
                    </script>";
                } else {
                    "<script>
                        alert('ERROR.INTENTE NUEVAMENTE');
                        window.location = '../admin/accesoadmin.php';
                    </script>";
                }
                break;
    }
   
    
    

    

    mysqli_connect_error($conexion);
?>