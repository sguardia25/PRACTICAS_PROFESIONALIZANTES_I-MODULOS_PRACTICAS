<?php
    session_start();

    include_once 'conexion.php';
    $conexion = new conexion();
    $conexion->conectar();

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Preparar la sentencia SQL con marcadores de posición
    $query = "SELECT * FROM persona WHERE usuario = :usuario AND contrasenia = :contrasena AND estado = 1";

    // Crear una sentencia preparada
    $validar_login = $conexion->conexion->prepare($query);

    // Asignar los valores a los marcadores de posición de forma segura
    $validar_login->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $validar_login->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);

    
    $validar_login->execute();
    
    $resultado = $validar_login->fetchAll(PDO::FETCH_ASSOC);
    $id= $resultado[0]['idPersona'];
    $nombre= $resultado[0]['nombre'];
    $apellido= $resultado[0]['apellido'];
    $rol=$resultado[0]['rol'];
   
    
    if (isset($id) and strcmp($usuario," ")!=0 and strcmp($contrasena," ")!=0){
       $_SESSION['usuario'] = $usuario;
       $_SESSION['idPersona']=$id;
       $_SESSION['nombre']=$nombre;
       $_SESSION['apellido']=$apellido;
      if($rol==1){//Admin
           header('<script>alert("ACCESO SOLO PARA DOCENTES");
                    window.location = "../index.php";  
              </script>');
       }
       if($rol==2){//Docente
           header('location:../proyectos/accesoproyectos.php');
       }
      if($rol==3){//Alumno
           header('<script>alert("ACCESO SOLO PARA DOCENTES");
                    window.location = "../index.php";  
              </script>');
       }
      if($rol==4){//Preceptor
           header('<script>alert("ACCESO SOLO PARA DOCENTES");
                    window.location = "../index.php";  
              </script>');
       }
       exit;
    }else {
      echo '<script>alert("USUARIO O CONTRASEÑA INCORRECTO");
                    window.location = "../loginsedenonogasta.php";  
              </script>';
      exit();        
    }
?>