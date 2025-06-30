<?php
session_start();

// Verifica que el usuario esté autenticado
if (!isset($_SESSION["nombre"])) {
  header("Location: index.html");
  exit;
}

$nombre = $_SESSION["nombre"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bienvenido</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      background-color: #0d0d0d;
      color: #00ffff;
      text-align: center;
      padding-top: 10%;
      font-family: 'Segoe UI', sans-serif;
    }
    .bienvenida {
      font-size: 2rem;
      text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff80;
      animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
      from { text-shadow: 0 0 10px #00ffff; }
      to { text-shadow: 0 0 20px #00ffff, 0 0 40px #00ffff88; }
    }
  </style>
</head>
<body>
  <div class="bienvenida">
    🛸 ¡Hola, <strong><?= htmlspecialchars($nombre) ?></strong>!<br>
    Bienvenido a Deportes Kids.
    <a href="../html/index.html">REGRESAR</a>
  </div>
</body>
</html>
