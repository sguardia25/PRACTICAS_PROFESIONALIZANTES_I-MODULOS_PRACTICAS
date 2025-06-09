<?php include 'template/cabecera.php';?>
        <!--AGREGAR PROYECTO-->
        <header class="masthead">
            <div class="container" id="layoutSidenav_content">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">PROYECTO</h2>
                    <div class="card-header"><h5>AGREGAR INFORMACIÓN</h5></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <br><br><br>
                        <div class="card btn-primary text-dark">
                            <div class="card-body">
                                
                                <form action="bd/consultas.php" method="POST" enctype="multipart/form-data">
                                    <div>
                                        <label><h6>Titulo</h6></label>
                                        <input type="text" class="form-control" name="titulo" placeholder="Titulo del proyecto">
                                    </div><br>

                                    <div>
                                        <label for="exampleFormControlTextarea1"><h6>Descripción</h6></label>
                                        <textarea type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion" placeholder="Resumen del proyecto"></textarea>
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
                                        <input type="text" class="form-control" name="link" placeholder="Enlace pagina externa">
                                    </div><br>
                                     
                                    <div class="text-center">
                                        <input class="text-center btn btn-success" type="submit" value="AGREGAR" name="action">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($proyecto['id']); ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
                
        </header>  
<?php include 'template/pie.php';?>