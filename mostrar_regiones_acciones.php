<?php
// Conexión
require 'configDB.php';

// Consulta a la tabla regiones
$sql = "SELECT codigo, nombre FROM regiones";
$resultado = $conexion->query($sql);

// Mostrar el contenido de la tabla regiones
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "" . $fila['codigo'] . " - " . $fila['nombre'] . "</br>";
    }
}

echo "</br>";

// Consulta a la tabla acciones
$sql = "SELECT id_accion, descripcion FROM acciones";
$resultado = $conexion->query($sql);

// Mostrar el contenido de la tabla acciones
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "" . $fila['id_accion'] . " - " . $fila['descripcion'] . "</br>";
    }
}

?>