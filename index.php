<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Exportaciones</title>
    <?php include "estilo.php"; ?>
</head>
<body>

<main class="pagina">
    <header class="cabecera">
        <p class="empresa">AndesPeru Export S.A.C.</p>
        <h1>Registro de Exportacion Agricola</h1>
        <p>Ingresamos los datos de cada lote antes de exportarlo.</p>
    </header>

    <section class="panel">
        <h2>Datos del lote</h2>

        <!-- Usamos este formulario para mandar los datos a registrar.php. -->
        <form action="registrar.php" method="POST">
            <div class="campos">
                <div>
                    <label for="producto">Producto</label>
                    <select id="producto" name="producto" required>
                        <option value="Quinua">Quinua</option>
                        <option value="Maiz morado">Maiz morado</option>
                        <option value="Papa nativa">Papa nativa</option>
                        <option value="Tarwi">Tarwi</option>
                    </select>
                </div>
                
                <div>
                    <label for="pais">Pais de destino</label>
                    <select id="pais" name="pais" required>
                        <option value="Chile">Chile</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="EE.UU.">EE.UU.</option>
                        <option value="Alemania">Alemania</option>
                        <option value="Japon">Japon</option>
                    </select>
                </div>

                <div>
                    <label for="cantidad">Cantidad exportada (kg)</label>
                    <input id="cantidad" type="number" name="cantidad" min="0.01" step="0.01" required>
                </div>

                <div>
                    <label for="precio">Precio por kilo (S/)</label>
                    <input id="precio" type="number" name="precio" min="0.01" step="0.01" required>
                </div>
            </div>

            <div class="acciones">
                <button class="boton" type="submit">Registrar lote</button>
                <a class="boton boton-claro" href="reporte.php">Ver reporte</a>
            </div>
        </form>
    </section>
</main>

</body>
</html>
