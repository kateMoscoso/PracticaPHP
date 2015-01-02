<?php
// views/muestraListadoTemasFavoritos.php

$titulo = 'temas favoritos';

ob_start();
?>
<?php

/**
 * Genera una cadena con la duración en minutos y segundos a partir de los milisegundos
 * @param integer $milisegundos Duración del tema en milisegundos
 */
function duracion($milisegundos) {
    $segundos = $milisegundos / 1000;
    $minutos = $segundos / 60;
    $segundos %= $minutos;

    return sprintf("%02d", $minutos) . ':' . sprintf("%02d", $segundos);
}
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>
                <span class="glyphicon glyphicon-music" aria-hidden="true"></span> 
                Temas: <small>Lista de Temas Favoritos</small>
            </h1>
            <p class="lead">Lista de sus temas favoritos.</p>
        </div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
            if (!empty($temas)) {
                if (isset($temas['tracks']['items'])) {
                    $temas = $temas['tracks']['items'];
                }
                foreach ($temas['tracks'] as $indice => $tema) {
                    $numtema = sprintf("%02d", $tema['track_number']);
                    $numdisco = sprintf("%02d", $tema['disc_number']);
                    $id = $tema['id'];
                    $duracion = duracion($tema['duration_ms']);
                    $url_preview = $tema['preview_url'];
                    $preview = <<< ________MARCA
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm" title="Escuchar">Preview</button>
              <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel$indice" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <video controls="" name="media">
                      <source src="$url_preview" type="audio/mpeg">
                    </video>
                  </div>
                </div>
              </div>
________MARCA;
                    $url_spotify = $tema['external_urls']['spotify'];
                    print <<< ________MARCA_FINAL
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading$indice">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse$indice" aria-expanded="true" aria-controls="collapse$indice">
                    <span class="caret"></span> $numtema: $tema[name] 
                  </a>
                </h4>
            </div>
            <div id="collapse$indice" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading$indice">
                <div class="panel-body">
                  <div class='row'>
                    <div class='col-sm-1'>
                            <td>
                          <!-- Button trigger modal -->
                          <a href="#" class="btn btn-info" aria-hidden="true" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#basicModal$id">
                            <span class="glyphicon glyphicon-trash"></span> 
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
                                    <h3>¿Esta seguro que desea eliminar el Tema  ?</h3>
                                </div>
                                <div class="modal-footer">
                                     <a href="#" class="btn" data-dismiss="modal">No</a>
                                     <a href="favoritos/borrar/tema/$id?>" class="btn btn-primary">Si</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </td>
                     </div>
                     <div class='col-sm-3'>
                       Duración: $duracion 
                     </div>
                     <div class='col-sm-2'>
                       <a href='$url_spotify' target='_blank' title='Escuchar en Spotify'>
                         <img src="public/logoSpotify.png" class="img-responsive" alt="Spotify"></a>
                     </div>
                     <div class='col-sm-6'>
                       $preview
                     </div>
                  </div>
                </div>
              </div>
            </div>
________MARCA_FINAL;
                }
            } else {
                print <<< '________________MARCA_FINAL'
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  <h4>¡Su lista de temas esta vacia!</h4>
                </div>
                <p>
                  <a href="temas">
                    <button type="button" class="btn btn-primary btn-lg">Buscar Temas</button>
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
