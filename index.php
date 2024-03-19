<?php include("templates/header.php"); ?>
<style>
    .custom-bg {
      background: rgb(255,211,61);
      background: linear-gradient(90deg, rgba(255,211,61,1) 0%, rgba(238,255,21,1) 36%, rgba(255,161,111,1) 100%);
    }
</style>
<br>
<div class="p-5 mb-4 custom-bg rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Bienvenido a cursos sabatinos de inglés.</h1>
    <p class="col-md-8 fs-4">Usuario: <strong><?php echo $_SESSION['usuario']; ?></strong></p>
      <p class="col-md-8 fs-4">Correo: <strong><?php echo $_SESSION['correo']; ?></strong></p>
      <button class="btn btn-primary btn-lg" type="button" onclick="location.href='editarinfoalumno.php?txtID=<?php echo $id_usuario; ?>'">Editar información</button>
    </div>
</div>
<?php include("templates/footer.php"); ?>

