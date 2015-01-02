<?php
// views/muestraListadoAlbumes.php

$titulo = 'álbumes encontrados';

ob_start();
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>
                <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> 
                Albumes: <small>Resultado de la búsqueda</small>
            </h1>
            <p class="lead">Lista de sus álbumes favoritos.</p>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <?php
                //echo $albumes;
                if (!empty($albumes)) {
                    if (isset($albumes['albums']['items'])) {
                        $albumes = $albumes['albums']['items'];
                    }



                    foreach ($albumes['albums'] as $album) {
                        if (count($album['images']) > 2) {
                            $imagen = $album['images'][2]['url'];
                        } else {
                            $imagen = '';
                        }
                        $name = $album['name'];
                        $id = $album['id'];
                        print <<< ____________MARCA_FINAL
              <tr>
                <td>
                  <a href='album/$id'>
                    <img src='$imagen' width='64' height='64' alt='Imagen $name' title='$name'>
                  </a>
                </td>
                <td>$name</td>
                <td>

                    <!-- Button trigger modal -->
                <a href="#" class="btn btn-info btn-lg" aria-hidden="true" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#basicModal$id">
                <span class="glyphicon glyphicon-trash"></span> Eliminar
                </a>                     
                        <!-- Modal -->
                        <div class="modal fade" id="basicModal$id" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Eliminar elemento</h4>
                                </div>
                                <div class="modal-body">
                                    <h3>¿Esta seguro que desea eliminar el favorito?</h3>
                                </div>
                                <div class="modal-footer">
                                     <a href="#" class="btn" data-dismiss="modal">No</a>
                                     <a href="favoritos/borrar/album/$id?>" class="btn btn-primary">Si</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
              </tr>
____________MARCA_FINAL;
                    }
                    print '  </table>';
                } else {
                    print <<< '________________MARCA_FINAL'
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  <h4>¡No se han encontrado álbumes favoritos!</h4>
                </div>
                <p>
                  <a href="album">
                    <button type="button" class="btn btn-primary btn-lg">Buscar Album</button>
                  </a>
                </p>
________________MARCA_FINAL;
                }
                ?>

        </div>
    </div>
</div>
<?php
$contenido = ob_get_clean();

include 'layout.php';
