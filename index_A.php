<?php include("templates/header2.php");?>
<style>
    .custom-bg {
        background-color: #76FF7A; /* Reemplaza "your-color" con el color deseado */
    }
</style>
    <br>
    <div class="L">
        <div class="p-5 mb-4 custom-bg rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Bienvenido al sistema de cursos sabatinos de inglés.</h1>
                <p class="col-md-8 fs-4">Administrador : <strong><?php echo $_SESSION['usuario']; ?>.</strong></p>
                <p class="col-md-8 fs-4">Correo: <strong><?php echo $_SESSION['correo']; ?>.</strong></p>
                <button class="btn btn-primary btn-lg" type="button" onclick="location.href='editarinfoadministrador.php?txtID=<?php echo $id_usuario; ?>'">Editar información</button>
            </div>
        </div>
    </div>
<?php include("templates/footer2.php");?>