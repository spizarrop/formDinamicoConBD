<?php
// Incluimos la conexión
require 'config.php';

// Crear la base de datos si no existe
$conexion->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conexion->select_db($dbname);

// Crear tabla
$sql = "CREATE TABLE IF NOT EXISTS regiones (
    id_region TINYINT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL
)";
echo $sql;
$conexion->query($sql);

// Borrar datos previos (opcional para pruebas)
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
    $sql = "INSERT INTO regiones (codigo, nombre) VALUES ('".$region[0]."','".$region[1]."')";
    echo $sql;
    $conexion->query($sql);
}

echo "Inserción masiva completada correctamente.";
$conexion->close();
?>