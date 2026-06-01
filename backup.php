<?php

date_default_timezone_set('America/Lima'); # Linux configurado 

$origen = __DIR__ . "/documentos"; # REntramos la ruta documentos txt1 - txt2

$fecha = date("Ymd_His"); # Formato Año - Mes y Dia

$destino = __DIR__ . "/backups/backup_" . $fecha . ".zip"; 

$zip = new ZipArchive();  

if($zip->open($destino, ZipArchive::CREATE) === TRUE){ # Se pregunta el Zip

    $archivos = scandir($origen); # Origen del zip

    foreach($archivos as $archivo){ #Recorre todos los archivos txt - comprimirlo en zip

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
