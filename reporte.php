<?php
// Empezamos con el listado vacio y los contadores en cero ya luego conferme realizamos las pruebas vamos creando datos
$archivo = __DIR__ . "/exportaciones.txt";
$lotes = [];
$totalAcumulado = 0;
$altaExportacion = 0;
$destinosEspeciales = 0;

// Primero revisamos si el usuario quiere ver un pais en particular.
$paisFiltro = $_GET["pais"] ?? "Todos";
$paises = ["Todos", "Chile", "Bolivia", "EE.UU.", "Alemania", "Japon"];

// Solo aceptaremos los paises que aparecen en nuestro formulario.
if (!in_array($paisFiltro, $paises, true)) {
    $paisFiltro = "Todos";
}

// Leemos las lineas guardadas en nuestro archivo de exportaciones.
if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lineas !== false) {
        foreach ($lineas as $linea) {
            $datos = str_getcsv($linea);

            // Antes de calcular, revisamos que el registro tenga los 4 datos
            if (count($datos) != 4 || !is_numeric($datos[1]) || !is_numeric($datos[2])) {
                continue;
            }

            // Ordenamos los datos del lote en nuestro array asociativo
            $lote = [
                "producto" => $datos[0],
                "cantidad" => (float) $datos[1],
                "precio" => (float) $datos[2],
                "pais" => $datos[3]
            ];

            // Si elegimos un pais, ignoramos los registros de otros destinos
            if ($paisFiltro != "Todos" && $lote["pais"] != $paisFiltro) {
                continue;
            }

            // Multiplicamos los kilos por el precio y sumamos al total.
            $lote["total"] = $lote["cantidad"] * $lote["precio"];
            $totalAcumulado += $lote["total"];

            // Si supera los 1000 kg, contamos una alta exportacion
            $lote["alta"] = $lote["cantidad"] > 1000;
            if ($lote["alta"]) {
                $altaExportacion++;
            }

            // Tambien revisamos si el destino es EE.UU. o Alemania.
            $lote["especial"] = $lote["pais"] == "EE.UU." || $lote["pais"] == "Alemania";
            if ($lote["especial"]) {
                $destinosEspeciales++;
            }

            $lotes[] = $lote;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de Exportaciones</title>
    <?php include "estilo.php"; ?>
</head>
<body>

<main class="pagina">
    <header class="cabecera">
        <p class="empresa">AndesPeru Export S.A.C.</p>
        <h1>Reporte de Exportacion Agricola</h1>
        <p>Consulta de lotes registrados y valores acumulados.</p>
        <a class="boton" href="index.php">Registrar nuevo lote</a>
    </header>

    <section class="panel no-imprimir">
        <h2>Filtrar exportaciones</h2>
        <!-- Usamos GET porque solo queremos consultar los registros. -->
        <form method="GET" action="reporte.php">
            <div class="filtro">
                <div>
                    <label for="pais">Pais de destino</label>
                    <select id="pais" name="pais">
                        <?php foreach ($paises as $pais) { ?>
                            <option value="<?php echo $pais; ?>" <?php echo $paisFiltro == $pais ? "selected" : ""; ?>>
                                <?php echo $pais; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button class="boton" type="submit">Aplicar filtro</button>
                <a class="boton boton-claro" href="reporte.php">Mostrar todos</a>
            </div>
        </form>
        <p class="nota">Para guardar el reporte en PDF, presiona Ctrl + P y elige Guardar como PDF.</p>
    </section>

    <h2>Resumen<?php if ($paisFiltro != "Todos") { echo " - " . htmlspecialchars($paisFiltro, ENT_QUOTES, "UTF-8"); } ?></h2>
    <section class="resumen">
        <div class="dato">
            <span>Total de lotes</span>
            <strong><?php echo count($lotes); ?></strong>
        </div>
        <div class="dato">
            <span>Valor total exportado</span>
            <strong>S/ <?php echo number_format($totalAcumulado, 2); ?></strong>
        </div>
        <div class="dato">
            <span>Alta exportacion (+1000 kg)</span>
            <strong><?php echo $altaExportacion; ?></strong>
        </div>
        <div class="dato">
            <span>Destinos especiales</span>
            <strong><?php echo $destinosEspeciales; ?></strong>
        </div>
    </section>

    <section class="panel">
        <h2>Detalle de lotes</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        <th>Producto</th>
                        <th>Cantidad (kg)</th>
                        <th>Precio (S/)</th>
                        <th>Pais</th>
                        <th>Valor del lote (S/)</th>
                        <th>Alta exportacion</th>
                        <th>Destino especial</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($lotes) == 0) { ?>
                    <tr><td colspan="8">No encontramos registros para este pais.</td></tr>
                    <?php } ?>
                    <?php foreach ($lotes as $numero => $lote) { ?>
                    <tr>
                        <td><?php echo $numero + 1; ?></td>
                        <td><?php echo htmlspecialchars($lote["producto"], ENT_QUOTES, "UTF-8"); ?></td>
                        <td><?php echo number_format($lote["cantidad"], 2); ?></td>
                        <td><?php echo number_format($lote["precio"], 2); ?></td>
                        <td><?php echo htmlspecialchars($lote["pais"], ENT_QUOTES, "UTF-8"); ?></td>
                        <td><?php echo number_format($lote["total"], 2); ?></td>
                        <td><?php echo $lote["alta"] ? "Si" : "No"; ?></td>
                        <td><?php echo $lote["especial"] ? "Si" : "No"; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

</body>
</html>
