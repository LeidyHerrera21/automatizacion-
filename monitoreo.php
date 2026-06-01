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
    <style>
        /* ==========================================================================
           RESET & CONFIGURACIÓN GLOBAL
           ========================================================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #060913;
            /* Fondo con animación de matriz/flujo de datos vertical sutil */
            background-image: linear-gradient(rgba(16, 185, 129, 0.04) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(16, 185, 129, 0.04) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: flujoFondo 8s linear infinite;
            color: #e2e8f0;
            font-family: 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 800px;
        }

        /* ==========================================================================
           ANIMACIÓN DEL TÍTULO (GLITCH / NEÓN EFFECT)
           ========================================================================== */
        h2 {
            text-align: center;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #10b981; /* Verde esmeralda */
            margin-bottom: 50px;
            text-shadow: 0 0 10px rgba(16, 185, 129, 0.5),
                         0 0 20px rgba(16, 185, 129, 0.3);
            animation: glitchTitulo 3s infinite alternate;
            position: relative;
        }

        /* ==========================================================================
           CONTENEDOR DE TARJETAS Y HOVERS LLAMATIVOS
           ========================================================================== */
        .grid-archivos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .card-archivo {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        /* Hover llamativo: Se eleva, cambia borde a rosa neón y genera doble brillo exterior */
        .card-archivo:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: #f43f5e; /* Cambio a rosa neón */
            box-shadow: 0 15px 30px rgba(244, 63, 94, 0.25), 
                        -5px 0 15px rgba(6, 182, 212, 0.2);
        }

        /* Línea de escaneo láser que cruza la tarjeta en el hover */
        .card-archivo::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 50%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
            transform: skewX(-25deg);
            transition: none;
        }
        .card-archivo:hover::before {
            left: 150%;
            transition: 0.6s ease-in-out;
        }

        /* Estilos del texto interno */
        .archivo-titulo {
            font-size: 1.2rem;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .archivo-info {
            font-size: 0.9rem;
            color: #94a3b8;
            margin-bottom: 6px;
            font-family: 'Courier New', Courier, monospace; /* Toque técnico */
        }

        .archivo-info strong {
            color: #38bdf8; /* Azul claro para las etiquetas */
        }

        .alerta-vacio {
            text-align: center;
            grid-column: 1 / -1;
            padding: 40px;
            background: rgba(30, 41, 59, 0.4);
            border-radius: 12px;
            border: 1px dashed rgba(148, 163, 184, 0.3);
            color: #94a3b8;
        }

        /* ==========================================================================
           KEYFRAMES (ANIMACIONES)
           ========================================================================== */
        @keyframes flujoFondo {
            0% {
                background-position: 0px 0px;
            }
            100% {
                background-position: 0px 300px; /* Movimiento continuo hacia abajo */
            }
        }

        @keyframes glitchTitulo {
            0%, 95%, 100% {
                text-shadow: 0 0 10px rgba(16, 185, 129, 0.5), 0 0 20px rgba(16, 185, 129, 0.3);
                transform: skew(0deg);
            }
            96% {
                text-shadow: -3px 0 #f43f5e, 3px 0 #06b6d4;
                transform: skew(-3deg);
            }
            97% {
                text-shadow: 3px 0 #f43f5e, -3px 0 #06b6d4;
                transform: skew(3deg);
            }
            98% {
                text-shadow: -2px 0 #f43f5e, 2px 0 #10b981;
                transform: skew(-1deg);
            }
        }
    </style>
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