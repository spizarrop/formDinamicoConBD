<?php
// Conexión
require 'configDB.php';

// Inserción de datos
if (isset($_GET['consentimiento']) == "Aceptado") {
  $sql = "INSERT INTO encuesta (" . $_GET['nombre'] . ", " . $_GET['acciones'] . ", " . $_GET['problema'] . ", " . $_GET['opinion'] . ", " . $_GET['region'] . ")";
  $resultado = $conexion->query($sql);
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

    <p><strong>Archivo subido:</strong>
      <?php echo !empty($_GET['archivo']) ? $_GET['archivo'] : 'No disponible con GET'; ?>
    </p>

    <p><strong>Consentimiento:</strong>
      <?php echo isset($_GET['consentimiento']) ? "Aceptado" : "No aceptado"; ?>
    </p>
  </div>
</body>

</html>