<?php
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");

// Obtener datos por GET
if (isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];

    $sentencia = $conexion->prepare("SELECT * FROM usuario WHERE id = ?");
    $sentencia->bind_param("i", $txtID);
    $sentencia->execute();

    $resultado = $sentencia->get_result();
    $registro = $resultado->fetch_assoc();

    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];
}

// Procesar el formulario de editar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $usuario = (isset($_POST["usuario"])) ? $_POST["usuario"] : "";
  $password = (isset($_POST["password"])) ? $_POST["password"] : "";
  $correo = (isset($_POST["correo"])) ? $_POST["correo"] : "";
  $sentencia = $conexion->prepare("UPDATE usuario SET 
      usuario = ?,
      password = ?,
      correo = ? 
      WHERE id = ? ");

  $sentencia->bind_param("sssi", $usuario, $password, $correo, $txtID);
  if ($sentencia->execute()) {
      // Actualizar el correo en la tabla "fichainscripcion"
      $sentencia_ficha = $conexion->prepare("UPDATE fichainscripcion SET correo = ? WHERE id_usuario = ?");
      $sentencia_ficha->bind_param("si", $correo, $txtID);
      $sentencia_ficha->execute();

      $mensaje = "Registro actualizado";
      header("Location: index.php?mensaje=" . $mensaje);
      exit;
  } else {
      $error = "Error al actualizar el registro: " . $sentencia->error;
  }
}
include("templates/header.php");
?>
<br>
<div class="card">
    <div class="card-header">
        Registro de usuario
    </div>
    <div class="card-body">
        <?php if (isset($mensaje_error)) { ?>
            <div class="alert alert-danger"><?php echo $mensaje_error; ?></div>
        <?php } ?>
        <?php if (isset($mensaje_exito)) { ?>
            <div class="alert alert-success"><?php echo $mensaje_exito; ?></div>
        <?php } ?>
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="txtID" value="<?php echo $txtID; ?>">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario</label>
                <input type="text" value="<?php echo $usuario; ?>" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" value="<?php echo $password; ?>" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" value="<?php echo $correo; ?>" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar información</button>
            <button type="button" class="btn btn-success" onclick="window.location.href = 'index.php';">Cancelar edición</button> 
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("templates/footer.php"); ?>




