<?php
// Conexión
require 'configDB.php';

// Activar excepciones de mysqli (driver)
$controlador = new mysqli_driver();
$controlador->report_mode = MYSQLI_REPORT_ALL | MYSQLI_REPORT_STRICT;

try {

  // Inicio de una stransaccion por si ocurriese algun fallo
  $conexion->begin_transaction();

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

  // Guardamos con un commit si hemos llegado a este punto sin errores
  $conexion->commit();

} catch (mysqli_sql_exception $e) {

  // Si ha saltado cualquier error y no hemos llegado al commit hacemos un rollback
  $conexion->rollback();
  
  switch ($e->getCode()) {
    case 1062:
      // Error 1062 → valor duplicado
      echo "Ya existe una encuesta registrada con ese correo.";
      break;
    case 1452:
      // Error 1452 → violación de clave foránea
      echo "La acción o región seleccionada no existe en la base de datos.";
      break;
    case 1048:
      // Error 1048 → columna no puede ser NULL
      echo "Falta algún campo obligatorio en el formulario.";
      break;
    case 1054:
      // Error 1054 → columna desconocida
      echo "Se está intentando usar un campo que no existe.";
      break;
    default:
      // Mensaje genérico por si aparece otro error
      echo "Error en la base de datos (" . $e->getCode() . "): " . $e->getMessage();
      break;
  }
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
    <p><strong>Correo:</strong> <?php echo $_GET['correo'] ?? 'No enviado'; ?></p>

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