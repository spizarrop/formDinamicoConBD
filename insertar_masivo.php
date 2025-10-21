<?php
// Crear la conexión
$conexion = mysqli_connect("localhost", "root", "");

// Crear la base de datos si no existe
$conexion->query("CREATE DATABASE IF NOT EXISTS formulario_web");

// Seleccionar base de datos
$conexion->select_db("formulario_web");

// Crear tabla regiones
$sql = "CREATE TABLE IF NOT EXISTS regiones (
    id_region TINYINT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL
)";
echo $sql . "</br>";
$conexion->query($sql);

// Borrar datos si existe la tabla
$conexion->query("DELETE FROM regiones");

// Insertar datos
$regiones = [
    ['europa', 'Europa'],
    ['america', 'América'],
    ['asia', 'Asia'],
    ['africa', 'África'],
    ['oceania', 'Oceanía']
];

foreach ($regiones as $region) {
    $sql = "INSERT INTO regiones (codigo, nombre) VALUES ('" . $region[0] . "','" . $region[1] . "')";
    echo $sql . "</br>";
    $conexion->query($sql);
}

echo "Inserción masiva de regiones completada correctamente." . "</br>";

// Crear tabla acciones
$sql = "CREATE TABLE IF NOT EXISTS acciones (
    id_accion TINYINT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(150) NOT NULL
)";
echo $sql . "</br>";
$conexion->query($sql);

// Borrar datos si existe la tabla
$conexion->query("DELETE FROM acciones");

// Insertar datos
$acciones = [
    'Reciclo mi basura para que los materiales puedan ser reutilizados.',
    'Uso transporte sostenible (caminar, bicicleta o transporte público)',
    'Participo en acciones comunitarias que ayudan a proteger el medio ambiente.',
    'Consumo productos de temporada y esto disminuye la huella de carbono.'
];

foreach ($acciones as $accion) {
    $sql = "INSERT INTO acciones (descripcion) VALUES ('" . $accion . "')";
    echo $sql. "</br>";
    $conexion->query($sql);
}

echo "Inserción masiva de acciones completada correctamente." . "</br>";

$conexion->close();
?>