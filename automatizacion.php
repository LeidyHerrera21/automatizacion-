<?php

date_default_timezone_set('America/Lima');

$origen = __DIR__ . "/documentos";

$fecha = date("Ymd_His");

$backup = __DIR__ .
"/backups/backup_" .
$fecha .
".zip";

$zip = new ZipArchive();

if($zip->open($backup, ZipArchive::CREATE) === TRUE){

    foreach(scandir($origen) as $archivo){

        if($archivo != "." && $archivo != ".."){

            $zip->addFile(
                $origen . "/" . $archivo,
                $archivo
            );
        }
    }

    $zip->close();

    $log =
    date("Y-m-d H:i:s")
    ." - Backup generado: "
    .$backup
    .PHP_EOL;

    file_put_contents(
        __DIR__ . "/logs/eventos.log",
        $log,
        FILE_APPEND
    );

    echo "Proceso completado";
}
?>
