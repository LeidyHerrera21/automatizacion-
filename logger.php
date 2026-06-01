<?php

date_default_timezone_set('America/Lima');

$archivoLog = __DIR__ . "/logs/eventos.log";

$mensaje =
date("Y-m-d H:i:s")
. " - Backup ejecutado correctamente"
. PHP_EOL;

file_put_contents(
    $archivoLog,
    $mensaje,
    FILE_APPEND
);

echo "Log registrado";
?>
