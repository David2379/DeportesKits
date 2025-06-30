
<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $action = $_POST["action"] ?? '';

  if ($action === "register") {
    // Capturar y sanitizar los datos
    $nombre    = trim($_POST["nombre"]);
    $email     = trim($_POST["email"]);
    $telefono  = trim($_POST["telefono"]);
    $direccion = trim($_POST["direccion"]);
    $ciudad    = trim($_POST["ciudad"]);
    $password  = $_POST["password"];
    $confirm   = $_POST["confirm_password"];

    if ($password !== $confirm) {
      echo "⚠️ Las contraseñas no coinciden.";
      exit;
    }

    // Encriptar contraseña
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO clientes (nombre, email, telefono, direccion, ciudad, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $email, $telefono, $direccion, $ciudad, $hashed);

    if ($stmt->execute()) {
      $_SESSION["nombre"] = $nombre;
      header("Location: bienvenida.php");
      exit;
    } else {
      echo "❌ El usuario o correo ya está registrado.";
    }

    $stmt->close();

  } elseif ($action === "login") {
    if (isset($_POST["nombre"])) {
    $nombre = $_POST["nombre"];
    $contraseña = $_POST["contraseña"];
    // Continúa con el uso...
} else {
    echo "El campo 'nombre' no fue enviado.";
}
 // Verificar existencia del usuario
    $stmt = $conn->prepare("SELECT contraseña FROM usuarios WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $stmt->bind_result($stored_hash);
      $stmt->fetch();

      if (contraseña_verify($contraseña, $stored_hash)) {
        $_SESSION["nombre"] = $nombre;
        header("Location: bienvenida.php");
        exit;
      } else {
        echo "❌ Contraseña incorrecta.";
      }
    } else {
      echo "❌ Usuario no encontrado.";
    }
    $stmt->close();
  }
}
?>

