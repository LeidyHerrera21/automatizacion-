<?php

date_default_timezone_set('America/Lima');

$origen = __DIR__ . "/documentos";

$fecha = date("Ymd_His");

$destino = __DIR__ . "/backups/backup_" . $fecha . ".zip";

$zip = new ZipArchive();

if($zip->open($destino, ZipArchive::CREATE) === TRUE){

    $archivos = scandir($origen);

    foreach($archivos as $archivo){

        if($archivo != "." && $archivo != ".."){

            $zip->addFile(
                $origen . "/" . $archivo,
                $archivo
            );
        }
    }

    $zip->close();

    echo "Backup generado";
}
else{

    echo "Error al crear backup";
}
?>
