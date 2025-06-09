<?php include 'template/cabecera.php'; ?>
        <!--LOGIN-->  
        <header class="masthead" class="page-section" id="services">
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="card btn-dark text-dark">
                            <div class="text-center card-header"><h6>ACCESO DOCENTES</h6></div>
                            <div class="card-body">
                                <form action="bd/usuario.php" method="POST">
                                    
                                    <div class="form-group mb-2">
                                        <label for="name"><h6>INGRESAR DNI SIN PUNTOS (USUARIO)</h6></label>
                                        <input type="text" name="usuario" class="form-control" id="name" required>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label for="name"><h6>INGRESAR DNI SIN PUNTOS (CONTRASEÑA)</h6></label>
                                        <input type="password" class="form-control" name="contrasena" id="contraseña" required>
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning text-dark" required>
                                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                            <h6>ACCEDER</h6>
                                        </button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </header>
<?php include 'template/pie.php';?>