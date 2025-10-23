<?php
// Conexión
require 'configDB.php';

// Inserción de datos
if (isset($_GET['consentimiento'])) { 
  // Insercion de la encuesta
  $sql = "INSERT INTO encuestas (correo, problema, opinion) VALUES ('" . $_GET['correo'] . "', '" . $_GET['problema'] . "', '" . $_GET['opinion'] . "');";
  $conexion->query($sql);

  $resultado = $conexion->query("SELECT id_encuesta FROM encuestas WHERE correo = '" . $_GET['correo'] . "';");
  $fila = $resultado->fetch_assoc();
  $id_encuesta = $fila['id_encuesta'];

  // Insercion de acciones
  foreach ($_GET['acciones'] as $accion) {
    $id_accion = $accion;

    $sql = "INSERT INTO encuesta_accion VALUES (" . $id_encuesta . ", " . $id_accion . ");";
    $conexion->query($sql);
  }

  $id_region = $_GET['region'];

  // Insercion de region
  $sql = "INSERT INTO encuesta_region VALUES (" . $id_encuesta . ", " . $id_region . ")";
  $conexion->query($sql);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Resultados del Formulario</title>
  <link rel="stylesheet" href="formularioCC.css">
  </style>
</head>

<body>
  <h1>Resultados del Formulario</h1>
  <div class="resultado">
    <p><strong>Nombre:</strong> <?php echo $_GET['nombre'] ?? 'No enviado'; ?></p>

    <p><strong>Acciones realizadas:</strong><br>
      <?php
      if (!empty($_GET['acciones'])) {
        foreach ($_GET['acciones'] as $accion) {
          echo "- " . $accion . "<br>";
        }
      } else {
        echo "Ninguna seleccionada";
      }
      ?>
    </p>

    <p><strong>¿Cual de estos problemas del cambio climático te parece más grave?:</strong>
      <?php echo $_GET['problema'] ?? 'No respondido'; ?>
    </p>

    <p><strong>Opinión:</strong><br>
      <?php echo nl2br($_GET['opinion'] ?? 'No escrita'); ?>
    </p>

    <p><strong>Región:</strong>
      <?php echo $_GET['region'] ?? 'No seleccionada'; ?>
    </p>

    <p><strong>Consentimiento:</strong>
      <?php echo isset($_GET['consentimiento']) ? "Aceptado" : "No aceptado"; ?>
    </p>
  </div>
</body>

</html>