<?php
$conexion = mysqli_connect("db", "mariadb", "mariadb", "mariadb");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $fechaAlta = $_POST["fechaAlta"];
  $apellidopaterno = $_POST["apellidopaterno"];
  $apellidomaterno = $_POST["apellidomaterno"];
  $nombres = $_POST["nombres"];
  $fecha_nac = $_POST["fecha_nac"];
  $direccion = $_POST["direccion"];
  $cd = $_POST["cd"];
  $municipio = $_POST["municipio"];
  $estado = $_POST["estado"];
  $pais = $_POST["pais"];
  $tel_fijo = $_POST["tel_fijo"];
  $tel_mov = $_POST["tel_mov"];
  $correo = $_POST["correo"];
  $alumno = $_POST["alumno"];
  $externo = $_POST["externo"];
  $nombre_curso = $_POST["nombre_curso"];
  $horario_curso = $_POST["horario_curso"];
  $re_de_con = $_POST["re_de_con"];
  $correo_ut = $_POST["correo_ut"];
  $pag_internet = $_POST["pag_internet"];
  $pag_int_ut = $_POST["pag_int_ut"];
  $prensa_escrita = $_POST["prensa_escrita"];
  $otro = $_POST["otro"];

 // Verificar si el usuario ya existe
  $sqlUsuario = "SELECT id FROM usuario WHERE correo = '$correo'";
  $resultadoUsuario = mysqli_query($conexion, $sqlUsuario);

  if ($resultadoUsuario && mysqli_num_rows($resultadoUsuario) > 0) {
    // El usuario ya existe, obtener su ID
    $filaUsuario = mysqli_fetch_assoc($resultadoUsuario);
    $idUsuario = $filaUsuario['id'];

    // Verificar si el correo coincide con el de la tabla de usuarios
    $sqlVerificarCorreo = "SELECT correo FROM usuario WHERE id = '$idUsuario'";
    $resultadoVerificarCorreo = mysqli_query($conexion, $sqlVerificarCorreo);
    $filaVerificarCorreo = mysqli_fetch_assoc($resultadoVerificarCorreo);
    $correoTabla = $filaVerificarCorreo['correo'];

    if ($correo !== $correoTabla) {
      // El correo no coincide, mostrar mensaje de error y redireccionar
      $mensajeError = "El correo ingresado no coincide con el registrado en el sistema.";
      header("Location: form_ficha_Ins.php?error=" . urlencode($mensajeError));
      exit();
    }
  } else {
    // El correo no existe en la tabla de usuarios, mostrar mensaje de error y redireccionar
    $mensajeError = "El correo ingresado no está registrado en el sistema.";
    header("Location: form_ficha_Ins.php?error=" . urlencode($mensajeError));
    exit();
  }

  // Crear la consulta SQL para agregar la ficha de inscripción
  $sqlFichaInscripcion = "INSERT INTO fichainscripcion (fechaAlta, apellidopaterno, apellidomaterno, nombres, fecha_nac, direccion, cd, municipio, estado, pais, tel_fijo, tel_mov, correo, alumno, externo, nombre_curso, horario_curso, re_de_con, correo_ut, pag_internet, pag_int_ut, prensa_escrita, otro, id_usuario) 
                          VALUES ('$fechaAlta', '$apellidopaterno', '$apellidomaterno', '$nombres', '$fecha_nac', '$direccion', '$cd', '$municipio', '$estado', '$pais', '$tel_fijo', '$tel_mov', '$correo', '$alumno', '$externo', '$nombre_curso', '$horario_curso', '$re_de_con', '$correo_ut', '$pag_internet', '$pag_int_ut', '$prensa_escrita', '$otro', '$idUsuario')";

  if (mysqli_query($conexion, $sqlFichaInscripcion)) {
    // Ficha de inscripción agregada correctamente

    // Obtener el valor para el campo "alumnoextranjero"
    // Obtener los datos del formulario
    $alumno = $_POST["alumno"];
    $externo = $_POST["externo"];

    // Validar y asignar valores a los campos "alumno" y "externo"
    if ($alumno == 'x') {
      $alumnoextranjero = 'alumno';
      $externo = ''; // Vaciar el valor de "externo"
    } elseif ($externo == 'x') {
      $alumnoextranjero = 'externo';
      $alumno = ''; // Vaciar el valor de "alumno"
    } else {
      // En caso de no haber ingresado ninguna "x" en ambos campos, mostrar un mensaje de error o realizar la acción que consideres adecuada.
    }

    // Insertar los datos en la tabla "nuevoingreso"
    $sqlNuevoIngreso = "INSERT INTO nuevoingreso (apellidopaterno, apellidomaterno, nombres, alumnoextranjero, id_usuario)
                        VALUES ('$apellidopaterno', '$apellidomaterno', '$nombres', '$alumnoextranjero', '$idUsuario')";
    if (mysqli_query($conexion, $sqlNuevoIngreso)) {
      $mensaje = "Registro actualizado";
      header("Location: index.php?mensaje=" . $mensaje);
      exit;
    } else {
      echo "Error al agregar los datos de nuevo ingreso: " . mysqli_error($conexion);
    }
  } else {
    echo "Error al agregar la ficha de inscripción: " . mysqli_error($conexion);
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conexion);
}
?>
<?php include("../../templates/header.php");?>
<br>
<div class="card">
    <div class="card-header">
        Formulario para ficha de inscripción
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validarOpcion()">
    <h2 style="color: red;"></strong>DATOS PERSONALES</strong></h2>
    <div class="mb-3">
        <strong><label for="fechaAlta" class="form-label">Fecha de Alta</label></strong>
        <input type="date" class="form-control" name="fechaAlta" id="fechaAlta" aria-describedby="emailHelpId" placeholder="Fecha de alta" onfocus="(this.type='date')" onblur="formatDate(this)" required>
    </div>
    <div class="mb-3">
    <strong><label for="apellidopaterno" class="form-label">Apellido Paterno</label></strong>
      <input type="text"
        class="form-control" name="apellidopaterno" id="apellidopaterno" aria-describedby="helpId" placeholder="Escriba su apellido paterno" maxlength="10" required>
    </div>
    <div class="mb-3">
    <strong><label for="apellidomaterno" class="form-label">Apellido Materno</label></strong>
      <input type="text"
        class="form-control" name="apellidomaterno" id="apellidomaterno" aria-describedby="helpId" placeholder="Escriba su apellido materno" maxlength="10" required>
    </div>
    <div class="mb-3">
    <strong><label for="nombres" class="form-label">Nombre(s)</label></strong>
      <input type="text"
        class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Escriba su nombre o nombres" maxlength="30" required>
    </div>
    <div class="mb-3">
    <strong><label for="fecha_nac" class="form-label">Fecha de Nacimiento</label></strong>
        <input type="date" class="form-control" name="fecha_nac" id="fecha_nac" aria-describedby="emailHelpId" placeholder="Fecha de nacimiento" onfocus="(this.type='date')" onblur="formatDate(this)" required>
    </div>
    <div class="mb-3">
    <strong><label for="direccion" class="form-label">Dirección (Calle, Número interior, Número exterior, Colonia)</label></strong>
      <input type="text"
        class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Escriba su dirección" maxlength="60" required>
    </div>
    <div class="mb-3">
    <strong><label for="cd" class="form-label">Código Postal</label></strong>
      <input type="number"
        class="form-control" name="cd" id="cd" aria-describedby="helpId" placeholder="Escriba su código postal" maxlength="5" required>
    </div>
    <div class="mb-3">
    <strong><label for="municipio" class="form-label">Municipio o Delegación</label></strong>
      <input type="text"
        class="form-control" name="municipio" id="municipio" aria-describedby="helpId" placeholder="Escriba su municipio o delegación" maxlength="20" required>
    </div>
    <div class="mb-3">
    <strong><label for="estado" class="form-label">Estado</label></strong>
      <input type="text"
        class="form-control" name="estado" id="estado" aria-describedby="helpId" placeholder="Escriba su estado" maxlength="20" required>
    </div>
    <div class="mb-3">
    <strong><label for="pais" class="form-label">País</label></strong>
      <input type="text"
        class="form-control" name="pais" id="pais" aria-describedby="helpId" placeholder="Escriba su país" maxlength="20" required>
    </div>
    <div class="mb-3">
    <strong><label for="tel_fijo" class="form-label">Teléfono fijo</label></strong>
      <input type="number"
        class="form-control" name="tel_fijo" id="tel_fijo" aria-describedby="helpId" placeholder="Escriba su teléfono fijo" maxlength="10">
    </div>
    <div class="mb-3">
    <strong><label for="tel_mov" class="form-label">Teléfono Móvil</label></strong>
      <input type="number"
        class="form-control" name="tel_mov" id="tel_mov" aria-describedby="helpId" placeholder="Escriba su teléfono móvil" maxlength="10" required>
    </div>
    <div class="mb-3">
    <strong><label for="correo" class="form-label">Correo:</label></br></strong>
    <strong><label style="color: blue;" for="correo" class="form-label">Por favor utiliza el mismo correo que has puesto en el login</label></strong>
      <input type="email"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo" maxlength="30" required>
    </div>
    <h2 style="color: red;"></strong>DATOS DE SOLICITUD DE ADMISIÓN</strong></h2>
    <strong><label style="color: blue;" class="form-label">Por favor ponga una x si es alumno o exalumno de la UTSC o si es una persona externa.</label></strong>
    <div class="mb-3">
    <strong><label for="alumno" class="form-label">Alumno UTSC/Exalumno UTSC</label></strong>
      <input type="text"
        class="form-control" name="alumno" id="alumno" aria-describedby="helpId" placeholder="Escriba una x si es alumno o exalumno de la UTSC" maxlength="1" >
    </div>
    <div class="mb-3">
    <strong><label for="externo" class="form-label">Externo</label></strong>
      <input type="text"
        class="form-control" name="externo" id="externo" aria-describedby="helpId" placeholder="Escriba una x si eres una persona externa de la UTSC" maxlength="1" >
    </div>
    <div class="mb-3">
    <strong><label for="nombre_curso" class="form-label">Nombre del curso</label></strong>
      <input type="text"
        class="form-control" name="nombre_curso" id="nombre_curso" aria-describedby="helpId" placeholder="Escriba el nombre del curso a ingresar" maxlength="10" required>
    </div>
    <div class="mb-3">
    <strong><label for="horario_curso" class="form-label">Horario del curso</label></strong>
      <input type="text"
        class="form-control" name="horario_curso" id="horario_curso" aria-describedby="helpId" placeholder="Escriba el horario del curso" maxlength="20" required>
    </div>
    <h2 style="color: red;"></strong>¿CÓMO SE ENTERÓ DEL CURSO</strong></h2>
    <strong><label style="color: blue;" class="form-label">Escriba x si se entero por ese medio por los cursos sabáticos de inglés.</label></strong>
    <div class="mb-3">
    <strong><label for="re_de_con" class="form-label">Recomendación de un conocido</label></strong>
      <input type="text"
        class="form-control" name="re_de_con" id="re_de_con" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por recomendación de un conocido" maxlength="1" >
    </div>
    <div class="mb-3">
    <strong><label for="correo_ut" class="form-label">Correo electrónico</label></strong>
      <input type="text"
        class="form-control" name="correo_ut" id="correo_ut" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por correo electrónico" maxlength="1" >
    </div>
    <div class="mb-3">
    <strong><label for="pag_internet" class="form-label">Página de Internet</label></strong>
      <input type="text"
        class="form-control" name="pag_internet" id="pag_internet" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por mediante página de Internet" maxlength="1" >
    </div>
    <div class="mb-3">
    <strong><label for="pag_int_ut" class="form-label">Página de Internet Universidad Tecnológica Santa Catarina</label></strong>
      <input type="text"
        class="form-control" name="pag_int_ut" id="pag_int_ut" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por la página de Internet UT Santa Catarina" maxlength="1" >
    </div>
    <div class="mb-3">
    <strong><label for="prensa_escrita" class="form-label">Prensa escrita</label></strong>
      <input type="text"
        class="form-control" name="prensa_escrita" id="prensa_escrita" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por prensa escrita" maxlength="1" >
    </div>
    <div class="mb-3">
    <strong><label for="otro" class="form-label">Otro: </label></strong>
      <input type="text"
        class="form-control" name="otro" id="otro" aria-describedby="helpId" placeholder="Escriba si conoció de otra forma sobre los cursos sabáticos de inglés" maxlength="90" >
    </div>
    <button type="submit" class="btn btn-success">Enviar formulario</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Regresar al apartado de Ficha de Inscripción</a>
    </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<script>
  document.getElementById("tel_mov").addEventListener("input", function() {
    if (this.value.length > 10) {
      this.value = this.value.slice(0, 10); // Limitar a 10 dígitos
    }
  });
  document.getElementById("tel_fijo").addEventListener("input", function() {
    if (this.value.length > 10) {
      this.value = this.value.slice(0, 10); // Limitar a 10 dígitos
    }
  });
  document.getElementById("cd").addEventListener("input", function() {
    if (this.value.length > 5) {
      this.value = this.value.slice(0, 5); // Limitar a 10 dígitos
    }
  });
  

  function validarOpcion() {
    var alumno = document.getElementById('alumno').value;
    var externo = document.getElementById('externo').value;

    if (alumno.toLowerCase() === 'x' && externo.toLowerCase() === 'x') {
      alert("No puedes seleccionar ambas opciones en DATOS DE SOLICITUD DE ADMISIÓN. Por favor, elige solo una opción.");
      return false; // Evita que el formulario se envíe
    } else if (alumno.toLowerCase() === 'x') {
      alert("Seleccionaste la opción de alumno o exalumno de la UTSC.");
    } else if (externo.toLowerCase() === 'x') {
      alert("Seleccionaste la opción de persona externa de la UTSC.");
    } else {
      alert("Debes seleccionar una opción en DATOS DE SOLICITUD DE ADMISIÓN. Por favor, elige si eres Alumno UTSC/Exalumno UTSC o Externo.");
      return false; // Evita que el formulario se envíe
    }

    // Si todo está validado, el formulario se enviará
    return true;
  }
</script>
<?php
    if (isset($_GET['error'])) {
        $mensajeError = urldecode($_GET['error']);
        echo "<script>
                Swal.fire({
                  title: 'Error',
                  text: '$mensajeError',
                  icon: 'error',
                  confirmButtonText: 'Aceptar'
                });
              </script>";
    }
    ?>
<?php include("../../templates/footer.php");?>