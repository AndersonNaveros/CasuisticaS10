<?php
// Primero revisamos que los datos lleguen desde el formulario.
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

// Guardamos los datos recibidos en variables
$producto = $_POST["producto"] ?? "";
$cantidad = $_POST["cantidad"] ?? "";
$precio = $_POST["precio"] ?? "";
$pais = $_POST["pais"] ?? "";

// Ahora comprobamos que los datos sean validos antes de guardarlos
$productos = ["Quinua", "Maiz morado", "Papa nativa", "Tarwi"];
$paises = ["Chile", "Bolivia", "EE.UU.", "Alemania", "Japon"];

if (!in_array($producto, $productos) || !in_array($pais, $paises) ||
    !is_numeric($cantidad) || !is_numeric($precio) ||
    $cantidad <= 0 || $precio <= 0) {
    exit('Los datos no son validos. <a href="index.php">Volver al formulario</a>');
}

// Ya revisamos los datos, asi que organizamos el lote en un array
$lote = [
    "producto" => $producto,
    "cantidad" => (float) $cantidad,
    "precio" => (float) $precio,
    "pais" => $pais
];

// Separamos los datos con comas para guardarlos en formato CSV.
$registro = implode(",", $lote) . PHP_EOL;

// Agregamos el nuevo lote sin borrar los que ya tenemos
$archivo = __DIR__ . "/exportaciones.txt";
$guardado = file_put_contents($archivo, $registro, FILE_APPEND | LOCK_EX);

if ($guardado === false) {
    exit('No pudimos guardar el lote. Revisemos los permisos del archivo.');
}

// Si todo salio bien, pasamos al reporte actualizado
header("Location: reporte.php");
exit;
