
<?php
// views/muestraDatosUsuario.php

$titulo = 'listado de usuarios';

ob_start();
?>
<?php

/**
 * Genera una cadena con la duración en minutos y segundos a partir de los milisegundos
 * @param integer $milisegundos Duración del tema en milisegundos
 */
function checkPasswordMatch() {
    if ($_POST['newpass'] != $_POST['newpass2']) {
        echo("Oops! Password did not match! Try again. ");
    }
}
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>
                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> 
                Hola, <small>  <?php print $usuario; ?></small>
            </h1>
            <p class="lead">Aquí es donde puedes editar la información de tu perfil </p>
        </div>
        <div class="panel-body">

            <div class="table-responsive">          
                <div class="panel panel-default">
                    <table class="table table-striped table-condensed">
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                <a href="#" class="btn btn-info btn-lg" aria-hidden="true" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#basicModal">
                                    <span class="glyphicon glyphicon-trash"></span>Cambiar contraseña
                                </a>  
                                <?php
                                require 'cambiarPassword.php';
                                ?>

                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <a href="perfil/cambiarNombreUsuario" class="btn btn-info btn-lg" aria-hidden="true" class="glyphicon glyphicon-pencil">
                                    <span class="glyphicon glyphicon-pencil"></span> Cambiar Nombre Usuario
                                </a>                     

                            </td>
                            <?php
                            if (isset($adm) && $adm == 1) {
                                ?>
                                <td>
                                    <!-- Button trigger modal -->
                                    <a href="perfil/cambiarPermisos" class="btn btn-info btn-lg" aria-hidden="true" class="glyphicon glyphicon-pencil">
                                        <span class="glyphicon glyphicon-pencil"></span> Cambiar Permisos
                                    </a>                     

                                </td>
                                <?php
                            }
                            ?>

                        </tr>

                    </table>
                </div>
            </div>       
        </div>
    </div>
</div>

<?php
$contenido = ob_get_clean();

include 'layout.php';
