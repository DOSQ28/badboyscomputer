<?php
require '../backend/config/Conexion.php';

if (isset($_POST['login'])) {
  $errMsg = '';

  // Get data from FORM
  $username = $_POST['username'];

  $password = MD5($_POST['password']);

  $ip = $_SERVER['REMOTE_ADDR'];
  $captcha = $_POST['g-recaptcha-response'];
  $secretkey = "6LfvexcpAAAAADcVyp752V6UsnfZeYwZOaz6GVD7";

  $respuestac = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");

  $atributos = json_decode($respuestac, TRUE);
  if (!$atributos["success"]) {
    $errMsg = 'Verifique el captcha';
  }

  if ($username == '')
    $errMsg = 'Digite su usuario';
  if ($password == '')
    $errMsg = 'Digite su contraseña';

  if ($errMsg == '') {
    try {
      $stmt = $connect->prepare('SELECT id, nombre, username,correo,password, rol, state FROM usuarios WHERE username = :username');


      $stmt->execute(
        array(
          ':username' => $username


        )
      );
      $data = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($data == false) {
        $errMsg = "El usuario: $username no se encuentra , puede solicitarlo con el administrador.";
      } else {
        if ($password == $data['password']) {

          $_SESSION['id'] = $data['id'];
          $_SESSION['nombre'] = $data['nombre'];
          $_SESSION['username'] = $data['username'];
          $_SESSION['password'] = $data['password'];
          $_SESSION['correo'] = $data['correo'];
          $_SESSION['rol'] = $data['rol'];
          $_SESSION['state'] = $data['state'];


          if ($_SESSION['rol'] == 1) {
            header('Location: administrador/escritorio.php');
          }
          exit;
        } else
          $errMsg = 'Contraseña incorrecta.';
      }
    } catch (PDOException $e) {
      $errMsg = $e->getMessage();
    }
  }
}
?>



<!-- 6LcC3xcpAAAAADU1YKOUnGdX7EyjyYGtrJ1TsBWe -->