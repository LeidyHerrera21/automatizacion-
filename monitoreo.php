<?php
date_default_timezone_set('America/Lima'); # Idioma 
$carpeta = __DIR__ . "/documentos";  # Ruta de la carpeta
$archivos = scandir($carpeta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoreo de Archivos</title>
    <link rel="stylesheet" href="css/monitoreo.css">
</head>
<body>

<div class="container">
    <h2>Monitoreo de Archivos</h2>

    <div class="grid-archivos">
        <?php
        $tiene_archivos = false;

        foreach($archivos as $archivo){ 
            if($archivo != "." && $archivo != ".."){
                $tiene_archivos = true;
                $ruta = $carpeta . "/" . $archivo;
                
                // Formateamos los datos para inyectarlos limpiamente en el HTML
                $tamano = filesize($ruta);
                $fecha = date("d/m/Y H:i:s", filemtime($ruta));
                ?>
                
                <div class="card-archivo">
                    <div class="archivo-titulo">
                        📄 <?php echo htmlspecialchars($archivo); ?>
                    </div>
                    <div class="archivo-info">
                        <strong>TAMAÑO:</strong> <?php echo $tamano; ?> bytes
                    </div>
                    <div class="archivo-info">
                        <strong>FECHA:</strong> <?php echo $fecha; ?>
                    </div>
                </div>

                <?php
            }
        }

        // Si la carpeta de documentos está completamente vacía
        if (!$tiene_archivos) {
            echo "<div class='alerta-vacio'>📂 La carpeta 'documentos' está vacía o no contiene archivos válidos.</div>";
        }
        ?>
    </div>
</div>

</body>
</html>