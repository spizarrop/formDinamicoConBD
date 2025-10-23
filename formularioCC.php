<?php
// Conexión
require 'configDB.php';

// Consulta a la tabla regiones
$sql = "SELECT codigo, nombre FROM regiones";
$resultado = $conexion->query($sql);

// Creamos un array para las regiones (select)
$region = [];
if ($resultado->num_rows > 0) {
  while ($fila = $resultado->fetch_assoc()) {
    $region[$fila['codigo']] = $fila['nombre'];
  }
}

// Consulta a la tabla acciones
$sql = "SELECT id_accion, descripcion FROM acciones";
$resultado = $conexion->query($sql);

// Creamos un array para las acciones (checkbox)
$acciones = [];
if ($resultado->num_rows > 0) {
  while ($fila = $resultado->fetch_assoc()) {
    $acciones[$fila['id_accion']] = $fila['descripcion'];
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario Cambio Climático</title>
  <link rel="stylesheet" href="formularioCC.css">
</head>

<body>
  <form action="formularioCCResu.php" method="GET" enctype="multipart/form-data">
    <fieldset>
      <legend>Encuesta sobre el Cambio Climático</legend>

      <!-- Input de texto -->
      <label for="nombre"><strong>Email:</strong></label>
      <input type="text" name="nombre">

      <!-- Checkboxes -->
      <p><strong>¿Qué acciones realizas para cuidar el medio ambiente?</strong></p>
      <?php
      echo '<label>';
      foreach ($acciones as $key => $value) {
        echo '<input type="checkbox" name="acciones[]" value="' . $key . '"> 
        ' . $value . '<br><br>';
      }
      echo '</label>';
      ?>

      <!-- Radios -->
      <p><strong>¿Cual de estos problemas del cambio climático te parece más grave?</strong></p>
      <label>
        <input type="radio" name="problema" value="fenomenos meteorologicos extremos">
        Fenómenos meteorológicos extremos (olas de calor, sequías, inundaciones)
      </label>
      <label>
        <input type="radio" name="problema" value="aumento del nivel del mar">
        Aumento del nivel del mar
      </label>

      <!-- Textarea -->
      <label for="opinion"><strong>¿Qué opinas sobre las medidas actuales?</strong></label>
      <textarea name="opinion" rows="4" cols="40"></textarea>

      <!-- Select -->
      <label for="region"><strong>¿De qué región eres?</strong></label>
      <select name="region">
        <?php
        foreach ($region as $key => $value) {
          echo '<option value="' . $key . '">' . $value . '</option>';
        }
        ?>
      </select>

      <!-- Subir archivo -->
      <label for="archivo"><strong>Sube una imagen o documento relacionado:</strong></label>
      <input type="file" name="archivo">

      <!-- Checkbox final -->
      <label>
        <input type="checkbox" name="consentimiento">
        Acepto el uso de la información proporcionada
      </label>

      <!-- Botón de enviar -->
      <button type="submit">Enviar</button>

      <!-- Botón de reset -->
      <button type="reset">Restablecer</button>
    </fieldset>
  </form>
</body>

</html>