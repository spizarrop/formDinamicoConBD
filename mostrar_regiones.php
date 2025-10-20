<?php
// Conexión
require 'config.php';

// Consulta a la tabla regiones
$sql = "SELECT codigo, nombre FROM regiones";
$resultado = $conexion->query($sql);

// Mostramos el contenido
/* if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_array()) {
        foreach ($fila as $key => $value) {
            echo "" . $key . " - " . $value . "</br></br>";
        }
    }
} */

// Mostrar el contenido
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "" . $fila['codigo'] . " - " . $fila['nombre'] . "</br></br>";
    }
}

?>