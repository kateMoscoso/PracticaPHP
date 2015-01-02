<?php // auxiliar/altaUsuarios

require __DIR__ . '/../src/config.php';
require __DIR__ . '/../src/model.php';

use \MiW\PracticaPHP\Model\datosLocales;

datosLocales::borrar_usuario('u5');
