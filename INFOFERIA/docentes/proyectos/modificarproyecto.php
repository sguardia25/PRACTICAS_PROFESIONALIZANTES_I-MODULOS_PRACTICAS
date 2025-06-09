<?php 
include 'template/cabecera.php';
include_once 'bd/conexion.php';
session_start();

// ID DEL ULTIMO PROYECTO
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $conexion = new conexion();
    $conexion->conectar();
    
    $query = "SELECT * FROM expocen WHERE id = :id";
    $consulta = $conexion->conexion->prepare($query);
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    
    $proyecto = $consulta->fetch(PDO::FETCH_ASSOC);
    
    if (!$proyecto) {
        echo "Proyecto no encontrado.";
        exit; // O redirigir a otra página
    }
} else {
    echo "ID de proyecto no especificado o inválido.";
    exit; // O redirigir a otra página
}
?>

<!-- MODIFICAR PROYECTO -->
<header class="masthead">
    <div class="container" id="layoutSidenav_content">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">PROYECTO</h2>
            <div class="card-header"><h5>MODIFICAR INFORMACIÓN</h5></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <br><br><br>
                <div class="card btn-primary text-dark">
                    <div class="card-body">
                        
                        <form action="bd/consultas.php" method="POST" enctype="multipart/form-data">
                            <!-- ID -->
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($proyecto['id']); ?>">

                            <div>
                                <label><h6>Titulo</h6></label>
                                <input type="text" class="form-control" name="titulo" placeholder="Titulo del proyecto" value="<?php echo htmlspecialchars($proyecto['titulo']); ?>">
                            </div><br>

                            <div>
                                <label for="exampleFormControlTextarea1"><h6>Descripción</h6></label>
                                <textarea type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion" placeholder="Resumen del proyecto"><?php echo htmlspecialchars($proyecto['descripcion']); ?></textarea>
                            </div><br>
                            
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Logotipo del proyecto</label>
                                <input class="form-control" type="file" id="formFile" name="logo">
                            </div><br>
                            
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Foto de la presentación</label>
                                <input class="form-control" type="file" id="formFile" name="imagen">
                            </div><br>
                            
                            <div>
                                <label><h6>Link Externo</h6></label>
                                <input type="text" class="form-control" name="link" placeholder="Enlace página externa" value="<?php echo htmlspecialchars($proyecto['linkexterno']); ?>">
                            </div><br>
                             
                            <div class="text-center">
                                <input class="text-center btn btn-success" type="submit" value="MODIFICAR" name="action">
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</header>  

<?php include 'template/pie.php'; ?>
