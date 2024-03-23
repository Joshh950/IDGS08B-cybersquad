<?php include("../../templates/header.php"); ?>

<?php
// Realizar la conexión a la base de datos
$conexion = mysqli_connect("db", "mariadb", "mariadb", "mariadb");
if (!$conexion) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// Obtener el ID del usuario actual basado en la información de sesión o autenticación
function obtenerIdUsuarioActual() {
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] === "alumno") {
        return $_SESSION['id']; // Asegúrate de que esta sesión exista
    } else {
        header("Location: login.php");
        exit();
    }
}

// Obtener el ID del usuario actual
$usuarioId = obtenerIdUsuarioActual();

// Verificar si se obtuvo el ID del usuario actual
if ($usuarioId !== false) {
    // Verificar si el usuario ha elegido no mostrar el mensaje
    $noMostrarMensaje = isset($_SESSION['noMostrarMensaje']) ? $_SESSION['noMostrarMensaje'] : false;

    // Realizar la consulta para obtener el valor de idFichaInscripcion del usuario actual
    $sql = "SELECT idFichaInscripcion FROM fichainscripcion WHERE id_usuario = '$usuarioId'";
    $resultado = mysqli_query($conexion, $sql);

    // Verificar si se obtuvo algún resultado
    if ($fila = mysqli_fetch_assoc($resultado)) {
        $idFichaInscripcion = $fila['idFichaInscripcion'];

        // Mostrar el mensaje solo si el usuario no ha elegido no mostrarlo
        if (!$noMostrarMensaje) {
            ?>
            <script>
                // Mostrar el mensaje de forma interactiva
                Swal.fire({
                    title: '¡Ficha de inscripción encontrada!',
                    text: 'Ya puedes editar tu información e igualmente puedes ver tu PDF para tu ficha de Inscripción, haz clic en el botón para continuar.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // El usuario ha hecho clic en "Aceptar"
                        // Realizar las acciones necesarias
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // El usuario ha hecho clic en "No volver a mostrar"
                        // Guardar la preferencia en una variable de sesión
                        // Esto evitará que se muestre el mensaje en el futuro
                        <?php $_SESSION['noMostrarMensaje'] = true; ?>;
                    }
                });
            </script>
            <?php
        }
    } else {
        // No se encontró ninguna ficha de inscripción para el usuario actual
        if (!$noMostrarMensaje) {
            ?>
            <script>
                // Mostrar el mensaje de forma interactiva
                Swal.fire({
                    title: '¡Ficha de inscripción no encontrada!',
                    text: 'Por favor llena el formulario de ficha de inscripción y poner el mismo correo que utilizaste cuando te registraste.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
            </script>
            <?php
        }
    }

    // Realizar la actualización de los registros
    $sql_update = "UPDATE fichainscripcion SET alumno = IF(alumno != 'x', '', alumno), externo = IF(externo != 'x', '', externo) WHERE id_usuario = '$usuarioId'";
    if (mysqli_query($conexion, $sql_update)) {
        echo "";
    } else {
        echo "Error al actualizar los registros: " . mysqli_error($conexion) . "<br>";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>


<title>Página dividida</title>
<style>
    body, html {
        height: 96%;
        margin: 0;
        padding: 0;
        background: rgb(61,255,97);
        background: linear-gradient(67deg, rgba(61,255,97,1) 21%, rgba(235,102,0,1) 71%);
    }
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }   
    .half {
        width: 50vw;
        padding: 2vw;
        text-align: center;
        height: 100%;
    }
    .half:nth-child(1) {
        background: linear-gradient(90deg, #f8ff00 0%, #3ad59f 100%);
    }
    .half:nth-child(2) {
        background: linear-gradient(90deg, #d53369 0%, #daae51 100%);
    }
    .section {
        margin-bottom: 2vw;
        font-size: 2vw;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 80%;
        background-color: white;
        border-radius: 10px;
        padding: 20px;
    }
    
    .section h2 {
        position: relative;
    }

    .section h2::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 8px;
    }

    .section h2:nth-of-type(1)::after {
        background: rgb(61,255,97);
        background: linear-gradient(37deg, rgba(61,255,97,1) 12%, rgba(235,102,0,1) 88%);
    }

    .rojo section h2:nth-of-type(2)::after {
        background-color: red;
        bottom: -5px; /* Restaura el valor original del bottom */
        height: 6px; /* Restaura el valor original del height */
    }

    .button {
        margin-top: 1vw;
        text-align: center;
    }
    .button a {
        display: inline-block;
        padding: 1vw 2vw;
        font-size: 2vw;
    }
</style>
</head>
<body>
<?php if (empty($idFichaInscripcion)): ?>
    <?php // Aquí se muestra el contenido solo si $idFichaInscripcion está vacío ?>
    <div class="half">
        <div class="section n">
            <h2 class="rojo">Entrar formulario para la ficha de inscripción</h2>
            <p>Aquí puedes llenar tu formulario para que se guarden tus datos y se generen cuando cargues el PDF:</p>
            <div class="button">
                <a href="form_ficha_Ins.php" class="btn btn-primary <?php echo !empty($idFichaInscripcion) ? 'd-none' : ''; ?>" role="button">Entrar al formulario</a>
            </div>
        </div>
    </div>
<?php endif; ?>
    <?php if (!empty($idFichaInscripcion)): ?>
    <div class="container">
        <div class="half">
            <div class="section">
                <h2 class="rojo">Editar formulario para ficha de inscripción</h2>
                <p>Aquí puedes editar tu formulario para que se guarden tus datos y se generen cuando cargues el PDF:</p>
                <div class="button">
                    <a href="form_ficha_Ins.php" class="btn btn-primary <?php echo !empty($idFichaInscripcion) ? 'd-none' : ''; ?>" role="button">Entrar al formulario</a>
                <div class="button">
                <?php if (!empty($idFichaInscripcion)): ?>
                    <a href="editar.php?txtID=<?php echo $idFichaInscripcion; ?>" class="btn btn-warning" role="button">Editar ficha Inscripción</a>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
        <div class="half">
            <?php if (!empty($idFichaInscripcion)): ?>
                <div class="section">
                    <h2 class="rojo">Ver PDF para poder imprimir tu ficha de inscripción</h2>
                    <p>Al seleccionar el botón se generará la ficha de inscripción en donde podrás ver tu PDF y poder descargarlo o también si lo deseas imprimirlo:</p>
                    <div class="button">
                    <?php if (!empty($idFichaInscripcion)): ?>
                        <a href="fichainscripcion.php?txtID=<?php echo isset($idFichaInscripcion) ? $idFichaInscripcion : ''; ?>" class="btn btn-danger" role="button">Ver PDF</a>
                    <?php endif; ?>
                    </div>
                </div>
        <?php endif; ?>
        </div>
    </div>
<?php include("../../templates/footer.php"); ?>
