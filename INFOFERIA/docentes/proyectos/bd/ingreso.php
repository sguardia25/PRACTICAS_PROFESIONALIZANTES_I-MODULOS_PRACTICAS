<?php

    session_start();

    if (!isset($_SESSION['usuario'])) {
        echo '<script> alert("INICIAR SESIÓN"); 
            window.location = "../loginsedenonogasta.php"; 
                </script>';
        session_destroy();
        die();
    }

?>