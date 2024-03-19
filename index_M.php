<?php include("templates/header1.php");?>
<style>
    .custom-bg {
        background-color: #AFEEEE; /* Reemplaza "your-color" con el color deseado */
    }
</style>
  <br>
  <div class="p-5 mb-4 custom-bg rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Bienvenido al sistema maestr@</h1>
    <p class="col-md-8 fs-4">Maestro: <strong><?php echo $_SESSION['usuario']; ?>.</strong></p>
    <p class="col-md-8 fs-4">Correo: <strong><?php echo $_SESSION['correo']; ?>.</strong></p>
    <button class="btn btn-primary btn-lg" type="button" onclick="location.href='editarinfomaestro.php?txtID=<?php echo $id_usuario; ?>'">Editar información</button>
  </div>
</div>
<?php include("templates/footer1.php");?>