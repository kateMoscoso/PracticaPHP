<?php // views/muestraListadoTemas.php
if (isset($cabeceraTemas)) {
    $titulo = 'temas encontrados';
    ob_start();
    
    print'<div class="container">';
    print'<div class="panel panel-default">';
}
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

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php
// var_dump($temas);
if (isset($temas['tracks']['items'])) {
    $temas = $temas['tracks']['items'];
}
foreach ($temas as $indice => $tema) {
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
                      <a href="/favorito/tema/nuevo/$tema[id]">
                        <span class="glyphicon glyphicon-star-empty" aria-hidden="true" title="Marcar Favorito" ></span>
                      </a>
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
?>
</div>
<?php
if (isset($cabeceraTemas)) {
    print'</div>';
    print'</div>';
    $contenido = ob_get_clean();
    include 'layout.php';
}
?>
