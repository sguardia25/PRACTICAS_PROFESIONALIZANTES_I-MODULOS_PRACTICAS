<?php 
    include "template/cabecera.php";
    include_once 'bd/conexion.php';
    session_start();
    $conexion = new conexion();
    $conexion->conectar();
    
    $query = "SELECT * FROM expocen";
    $consulta = $conexion->conexion->prepare($query);
    $consulta->execute();
    $proyecto = $consulta->fetchAll(PDO::FETCH_ASSOC);
    $ultimo_proyecto = end($proyecto);
?>

<!-- VISTA PRELIMINAR -->
<div class="container px-5 my-5">
    <div class="text-center mb-5">
        <h3 class="display-8 fw-bolder mb-0">
            VISTA PRELIMINAR DEL PROYECTO
        </h3>
        <div class="align-items-center justify-content-between mb-4">
            <a class="btn btn-success px-4 py-3" href="modificarproyecto.php?id=<?php echo $ultimo_proyecto['id']; ?>">
                <div class="d-inline-block bi bi-link me-2"></div>
                MODIFICAR
            </a>
            <a class="btn btn-danger px-4 py-3" href="bd/eliminar.php?action=ELIMINAR&id=<?php echo $ultimo_proyecto['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este proyecto?');">
                <div class="d-inline-block bi bi-link me-2"></div>
                ELIMINAR
            </a>
        </div>
    </div>
    
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bolder mb-0">
            <img src="assets/imgproyectos/<?php echo basename($ultimo_proyecto['logo']); ?>" alt="Logo del Proyecto" style="width: 150px; height: auto;">
        </h1>
    </div>
    
    <div class="row gx-5 justify-content-center">
        <div class="col-lg-11 col-xl-9 col-xxl-8">
            <section>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="text-primary fw-bolder mb-0"><?php echo htmlspecialchars($ultimo_proyecto['titulo']); ?></h2>
                    <a class="btn btn-warning px-4 py-3" href="<?php echo htmlspecialchars($ultimo_proyecto['linkexterno']); ?>" target="_blank">
                        <div class="d-inline-block bi bi-link me-2"></div>
                        <?php echo htmlspecialchars($ultimo_proyecto['titulo']); ?>
                    </a>
                </div>

                <div class="card shadow border-0 rounded-4 mb-5">
                    <div class="card-body p-5">
                        <div class="row align-items-center gx-5">
                            <div class="col-lg-8">
                                <div><?php echo nl2br(htmlspecialchars($ultimo_proyecto['descripcion'])); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow border-0 rounded-4 mb-5">
                    <div class="card-body p-5">
                        <div class="row align-items-center gx-5">
                            <div class="col-lg-8">
                                <img src="assets/imgproyectos/<?php echo basename($ultimo_proyecto['imagen']); ?>" alt="Imagen del Proyecto" style="width: 150px; height: auto;">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php include "template/pie.php"; ?>