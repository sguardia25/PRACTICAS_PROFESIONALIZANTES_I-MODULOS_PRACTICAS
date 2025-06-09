<?php
    include_once 'conexion.php';
    session_start();
    $conexion = new conexion();
    $conexion->conectar();
    
    $titulo = $_POST['titulo'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $link = $_POST['link'] ?? null;
    
    $action = $_POST['action'] ?? null;
    $id = $_GET['id'] ?? null;
    
    switch ($action) {
        case 'AGREGAR':
            // DIRECTORIO DE LAS IMAGENES
            $upload_dir = '../assets/imgproyectos/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
    
            $logo_path = $upload_dir . basename($_FILES['logo']['name']);
            $imagen_path = $upload_dir . basename($_FILES['imagen']['name']);
            
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK &&
                isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK &&
                move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path) &&
                move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_path)) {
                
                // Verificar si el proyecto ya existe
                $consulta_titulo = "SELECT * FROM expocen WHERE titulo = :titulo";
                $validar_proyecto = $conexion->conexion->prepare($consulta_titulo);
                $validar_proyecto->bindParam(':titulo', $titulo);
                $validar_proyecto->execute();
    
                if ($validar_proyecto->fetch()) {
                    echo "<script>
                        alert('PROYECTO YA AGREGADO');
                        window.location = '../accesoadmin.php';
                    </script>";
                    exit();
                }
    
                $query = "INSERT INTO expocen (titulo, descripcion, logo, imagen, linkexterno, estado)
                          VALUES (:titulo, :descripcion, :logo, :imagen, :link, 1)";
                $ingresar_proyecto = $conexion->conexion->prepare($query);
                $ingresar_proyecto->bindParam(':titulo', $titulo);
                $ingresar_proyecto->bindParam(':descripcion', $descripcion);
                $ingresar_proyecto->bindParam(':logo', $logo_path);
                $ingresar_proyecto->bindParam(':imagen', $imagen_path);
                $ingresar_proyecto->bindParam(':link', $link);
    
                if ($ingresar_proyecto->execute()) {
                    echo "<script>
                        alert('PROYECTO AGREGADO...');
                        window.location = '../vistafinal.php';
                    </script>";
                } else {
                    echo "<script>
                        alert('INTENTE NUEVAMENTE...');
                        window.location = '../accesoadmin.php';
                    </script>";
                }
            } else {
                echo "<script>
                    alert('ERROR AL SUBIR LOS ARCHIVOS. INTENTE NUEVAMENTE...');
                    window.location = '../accesoadmin.php';
                </script>";
            }
            break;
    
       case 'MODIFICAR':
            $id = $_POST['id'] ?? null;
            
            if ($id) {
                // DIRECTORIO
                $upload_dir = '../assets/imgproyectos/';
                
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
        
                $logo_path = null;
                $imagen_path = null;
        
                //MODIFICAR LOGOS
                if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                    $logo_path = $upload_dir . basename($_FILES['logo']['name']);
                    move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path);
                }
        
                //MODIFICAR IMAGENES
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $imagen_path = $upload_dir . basename($_FILES['imagen']['name']);
                    move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_path);
                }
        
                $query = "UPDATE expocen SET titulo = :titulo, descripcion = :descripcion, linkexterno = :link";
                
                if ($logo_path) {
                    $query .= ", logo = :logo";
                }
        
                if ($imagen_path) {
                    $query .= ", imagen = :imagen";
                }
        
                $query .= " WHERE id = :id";
        
                $actualizar_proyecto = $conexion->conexion->prepare($query);
                $actualizar_proyecto->bindParam(':titulo', $titulo);
                $actualizar_proyecto->bindParam(':descripcion', $descripcion);
                $actualizar_proyecto->bindParam(':link', $link);
                $actualizar_proyecto->bindParam(':id', $id);
                
                if ($logo_path) {
                    $actualizar_proyecto->bindParam(':logo', $logo_path);
                }
                if ($imagen_path) {
                    $actualizar_proyecto->bindParam(':imagen', $imagen_path);
                }
        
                if ($actualizar_proyecto->execute()) {
                    echo "<script>
                        alert('PROYECTO MODIFICADO...');
                        window.location = '../vistafinal.php';
                    </script>";
                } else {
                    echo "<script>
                        alert('ERROR AL MODIFICAR EL PROYECTO. INTENTE NUEVAMENTE...');
                        window.location = '../accesoadmin.php';
                    </script>";
                }
            } else {
                echo "<script>
                    alert('ID DEL PROYECTO NO ENCONTRADO');
                    window.location = '../accesoadmin.php';
                </script>";
            }
            break;
            
        /*case 'ELIMINAR':
            if ($id) {
                // Cambiar el estado a 0
                $query = "UPDATE expocen SET estado = 0 WHERE id = :id";
                $eliminar_proyecto = $conexion->conexion->prepare($query);
                $eliminar_proyecto->bindParam(':id', $id);
    
                if ($eliminar_proyecto->execute()) {
                    echo "<script>
                        alert('PROYECTO ELIMINADO...');
                        window.location = '../accesoproyectos.php';
                    </script>";
                } else {
                    echo "<script>
                        alert('NO SE PUDO ELIMINAR EL PROYECTO. INTENTE NUEVAMENTE...');
                        window.location = '../vistaproyecto.php';
                    </script>";
                }
            } else {
                echo "<script>
                    alert('ID DEL PROYECTO NO ENCONTRADO');
                    window.location = '../vistaproyecto.php';
                </script>";
            }
            break;*/
    
        default:
            echo "<script>
                alert('ACCIÓN NO RECONOCIDA');
                window.location = '../accesoadmin.php';
            </script>";
            break;
    }
?>