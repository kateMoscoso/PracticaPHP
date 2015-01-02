<?php // auxiliar/altaUsuarios

require __DIR__ . '/../src/config.php';
require __DIR__ . '/../src/model.php';

use \MiW\PracticaPHP\Model\datosLocales;

// Se realiza la inserción de un par de usuarios
//   inserta_usuario(usuario, palabra_clave, es_administrador)
$ok = datosLocales::inserta_usuario('u1', '*u1*', TRUE);  // Usuario administrador
$ok += datosLocales::inserta_usuario('u2', '*u2*', FALSE);

print (($ok) ?
        "Insertado(s) $ok usuario(s)" :
        'ERROR: no se ha realizado la inserción') . "\n";
