<?php

session_start();
$url_base = "http://localhost/Sabatinos/";

// Verificar si el usuario ha iniciado sesión y si es un alumno
if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] === "alumno") {
  

} else {
  // El usuario no ha iniciado sesión o no es un alumno, redirige a la página de inicio de sesión
  header("Location: login.php");
  exit();
}
  
$dsn = "mysql:host=localhost;dbname=sabaticos;charset=utf8mb4";
$usuario = "root";
$contraseña = "";

try {
    $conexion = new PDO($dsn, $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
if (isset($_SESSION['idFichaInscripcion'])) {
    $idFichaInscripcion = $_SESSION['idFichaInscripcion'];
  
    // Resto de tu código para generar el PDF utilizando $idFichaInscripcion
  }
if (isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];

    $sentencia = $conexion->prepare("SELECT * FROM fichainscripcion WHERE idFichaInscripcion=:idFichaInscripcion");
    $sentencia->bindParam(":idFichaInscripcion", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($registro !== false) {
        $fechaAlta = $registro["fechaAlta"];
        $apellidopaterno = $registro["apellidopaterno"];
        $apellidomaterno = $registro["apellidomaterno"];
        $nombres = $registro["nombres"];
        $fecha_nac = $registro["fecha_nac"];
        $direccion = $registro["direccion"];
        $cd = $registro["cd"];
        $municipio = $registro["municipio"];
        $estado = $registro["estado"];
        $pais = $registro["pais"];
        $tel_fijo = $registro["tel_fijo"];
        $tel_mov = $registro["tel_mov"];
        $correo = $registro["correo"];
        $alumno = $registro["alumno"];
        $externo = $registro["externo"];
        // Resto del código para generar el PDF
        $nombre_curso=$registro["nombre_curso"];
        $horario_curso=$registro["horario_curso"];
        $re_de_con=$registro["re_de_con"];
        $correo_ut=$registro["correo_ut"];
        $pag_internet=$registro["pag_internet"];
        $pag_int_ut=$registro["pag_int_ut"];
        $prensa_escrita=$registro["prensa_escrita"];
        $otro=$registro["otro"];
    } else {
        echo "Registro no encontrado.";
    }
} else {
    echo "ID no proporcionado.";
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fichaNI.css">
    <title>Ficha de Inscripción</title>
</head>
<body>
<style>
    table, th, td {
        border-spacing: 0;
        border-top: 0px;
        border-right: 1px solid black;
        border-bottom: 1px solid black;
        border-left: 1px solid black;  
  }
  .th_borde {
    border-top: 1px solid black;
  }
  .th_border {
    
  }
  textarea{
    background: white;
    resize: none;
  }
</style>
<div class="container">
  <div class="izquierda">
    <div class="ut-grande">
      UT<br>
      <span class="ut-pequena">Santa Catarina</span>
    </div>
    <hr>
    <div class="texto-centralizado">
      Saber hacer para compartir
    </div>
    <hr>
  </div>
  <div class="derecha">
    <center><u><h2>CURSOS</h2></u></center>
    <center><strong><h2>REGISTRO DE INSCRIPCIÓN</h2></strong></center></br></br>
  </div>
  <div class="clear"></div>
</div>
<style>
@import url('https://fonts.googleapis.com/css2?family=Shrikhand&display=swap');
.container {
  text-align: center;
}

.izquierda {
  width: 25%;
  float: left;
}

.derecha {
  width: 75%;
  float: right;
}

.ut-grande {
  color: green;
  font-size: 74px;
  display: inline-block;
  font-weight: bold;
  font-family: 'Shrikhand', cursive;  
  font-style: italic;
}

.ut-pequena {
  color: green;
  font-size: 26px;
  display: block;
}

.texto-centralizado {
  text-align: center;
}

.clear {
  clear: both;
}
</style>
    <div style="text-align:center;">
            <table border="2" style="margin: 0 auto;" width="100%">
                <tr>
                    <th class="th_borde" width="100%" colspan="4" bgcolor="greenyellow">&nbsp;<strong>DATOS PERSONALES</strong></th>
                </tr>
                <tr>
                    <th width="70%" colspan="1" bgcolor="greenyellow"><strong>Fecha de Alta (DD/MM/AAAA)</strong></th>
                    <td width="10%" colspan="1"><?php echo date('d', strtotime($fechaAlta)); ?></td>
                    <td width="10%" colspan="1"><?php echo date('m', strtotime($fechaAlta)); ?></td>
                    <td width="10%" colspan="1"><?php echo date('Y', strtotime($fechaAlta)); ?></td>
                </tr>
            </table>

        <table border="2" style="margin: 0 auto;" width="100%">
            <tr>
                <th width="30%" colspan="1" bgcolor="greenyellow"><strong>Apellido Paterno</strong></th>
                <th width="30%" colspan="1" bgcolor="greenyellow"><strong>Apellido Materno </strong></th>
                <th width="40%" colspan="2" bgcolor="greenyellow"><strong>Nombre(s)</strong></th>
            </tr>
            <tr>
                <td width="30%"><?php echo $apellidopaterno; ?></td>
                <td width="30%"><?php echo $apellidomaterno; ?></td>
                <td width="40%"><?php echo $nombres; ?></td>
            </tr>
        </table>

        <table border="2" style="margin: 0 auto;" width="100%">
            <tr>
                <th width="70%" colspan="1" bgcolor="greenyellow"><strong>Fecha de Nacimiento</strong></th>
                <td width="10%" colspan="1"><?php echo date('d', strtotime($fecha_nac)); ?></td>
                <td width="10%" colspan="1"><?php echo date('m', strtotime($fecha_nac)); ?></td>
                <td width="10%" colspan="1"><?php echo date('Y', strtotime($fecha_nac)); ?></td>
            </tr>
        </table>

        <table border="2" style="margin: 0 auto;" width="100%">
            <tr>
                <th width="100%" colspan="4" bgcolor="greenyellow">&nbsp;<strong>Dirección (Calle, Número interior, Número exterior, Colonia)</strong></th>
            </tr>
            <tr>
                <td width="100%" colspan="4">&nbsp;<?php echo $direccion; ?></td>
            </tr>
        </table>
        <table border="2" style="margin: 0 auto;" width="100%">
            <tr>
                <th width="20%" colspan="1" bgcolor="greenyellow"><strong>Código Postal</strong></th>
                <th width="20%" colspan="1" bgcolor="greenyellow"><strong>Municipio o Delegación</strong></th>
                <th width="20%" colspan="1" bgcolor="greenyellow"><strong>Estado</strong></th>
                <th width="20%" colspan="1" bgcolor="greenyellow"><strong>País</strong></th>
            </tr>
            <tr>
                <td width="20%"><?php echo $cd; ?></td>
                <td width="20%"><?php echo $municipio; ?></td>
                <td width="20%"><?php echo $estado; ?></td>
                <td width="20%"><?php echo $pais; ?></td>
            </tr>
            </table>
            <table border="2" style="margin: 0 auto;" width="100%">
            <tr>
                <th width="35%" colspan="1" bgcolor="greenyellow"><strong>Teléfono fijo</strong></th>
                <td width="15%" colspan="1"><?php echo substr($tel_fijo, 0, 2); ?></td>
                <td width="50%" colspan="1"><?php echo substr($tel_fijo, 2); ?></td>
            </tr>
            <tr>
                <th width="35%" colspan="1" bgcolor="greenyellow"><strong>Teléfono Móvil</strong></th>
                <td width="15%" colspan="1"><?php echo substr($tel_mov, 0, 2); ?></td>
                <td width="50%" colspan="1"><?php echo substr($tel_mov, 2); ?></td>
            </tr>
            </table>
            <table border="2" style="margin: 0 auto;" width="100%">
            <tr>
                <th width="35%" colspan="1" bgcolor="greenyellow"><strong>Correo electrónico (e-mail)</strong></th>
                <td width="65%" colspan="1"><?php echo $correo; ?></td>
            </tr>
        </table>
    </div></br></br></br>
    <div style="text-align:center;">
            <table border="2" style="margin: 0 auto;" width="100%">
                <tr>
                    <th class="th_borde" width="100%" colspan="4" bgcolor="greenyellow">&nbsp;<strong>SOLICITUD DE ADMISIÓN</strong></th>
                </tr>
                <tr>
                    <th width="25%" bgcolor="greenyellow"><strong>Alumno UTSC/Exalumno UTSC</strong></th>
                    <th width="25%"><?php echo $alumno; ?></th>
                    <th width="25%" bgcolor="greenyellow"><strong>Externo</strong></th>
                    <th width="25%"><?php echo $externo; ?></td>
                </tr>
                <tr>
                    <th width="100%" colspan="4" bgcolor="greenyellow">&nbsp;<strong>DATOS CURSO</strong></th>
                </tr>
                <tr>
                    <th width="100%" colspan="4" bgcolor="greenyellow">&nbsp;<strong>NOMBRE DEL CURSO</strong></th>
                </tr>
                <tr>
                    <td width="100%" colspan="4"><?php echo $nombre_curso; ?></td>
                </tr>
                <tr>
                    <th width="100%" colspan="4" bgcolor="greenyellow">&nbsp;<strong>HORARIO DEL CURSO</strong></th>
                </tr>
                <tr>
                    <td width="100%" colspan="4"><?php echo $horario_curso; ?></td>
                </tr>
            </table>
        </div></br></br>
        <div style="text-align:center;">
            <table border="2" style="margin: 0 auto;" width="100%">
                <tr>
                    <th class="th_borde" width="100%" colspan="4" bgcolor="greenyellow">&nbsp;<strong>¿CÓMO SE ENTERÓ DEL CURSO</strong></th>
                </tr>
                <tr>
                    <td width="60%"></td>
                    <th class="th_border" width="40%" bgcolor="greenyellow"><strong>Marque aquí</strong></th>
                <tr>
                <tr>
                    <td width="60%"><strong>Recomendación de un conocido</strong></td>
                    <th class="th_border" width="40%" bgcolor="greenyellow"><strong><?php echo $re_de_con; ?></strong></th>
                <tr>
                <tr>
                    <td width="60%"><strong>Correo electrónico</strong></td>
                    <th class="th_border" width="40%" bgcolor="greenyellow"><strong><?php echo $correo_ut; ?></strong></th>
                <tr>
                <tr>
                    <td width="60%"><strong>Página de Internet</strong></td>
                    <th class="th_border" width="40%" bgcolor="greenyellow"><strong><?php echo $pag_internet; ?></strong></th>
                <tr>
                <tr>
                    <td width="60%"><strong>Página de Internet Universidad Tecnológica Santa Catarina</strong></td>
                    <th class="th_border" width="40%" bgcolor="greenyellow"><strong><?php echo $pag_int_ut; ?></strong></th>
                <tr>
                <tr>
                    <td width="60%"><strong>Prensa escrita</strong></td>
                    <th class="th_border" width="40%" bgcolor="greenyellow"><strong><?php echo $prensa_escrita; ?></strong></th>
                <tr>
                <tr>
                    <td width="60%"><strong>Otro (especifique)</strong></th>
                    <td class="th_border" width="40%" bgcolor="greenyellow"><strong><?php echo $otro; ?></strong></td>
                <tr>
            </table>
    </div></br></br></br>
    <div style="text-align:center;">
            <table border="2" style="margin: 0 auto;" width="100%">
                <tr>
                    <th class="th_borde" width="100%" colspan="4" bgcolor="greenyellow">&nbsp;<strong>EXCLUSIVO DE ADMINISTRACIÓN Y FINANZAS</strong></th>
                </tr>
                <tr>
                    <th width="30%" bgcolor="greenyellow"><strong>COSTO DEL CURSO</strong></th>
                    <th width="10%"><strong></strong></th>
                    <th width="15%" bgcolor="greenyellow"><strong>$</strong></th>
                    <th width="45%"><strong></strong></th>
                </tr>
                <tr>
                    <th width="30%" bgcolor="greenyellow"><strong>PAGOS: </strong></th>
                    <th width="10%"><strong></strong></th>
                    <th width="15%" bgcolor="greenyellow"><strong>$</strong></th>
                    <th width="45%"><strong></strong></th>
                </tr>
                <tr>
                    <th width="30%" bgcolor="greenyellow"><strong>INSCRIPCIÓN</strong></th>
                    <th width="10%"><strong></strong></th>
                    <th width="15%" bgcolor="greenyellow"><strong>$</strong></th>
                    <th width="45%"><strong></strong></th>
                </tr>
                <tr>
                    <th width="30%" bgcolor="greenyellow"><strong>PRIMER PAGO</strong></th>
                    <th width="10%"><strong></strong></th>
                    <th width="15%" bgcolor="greenyellow"><strong>$</strong></th>
                    <th width="45%"><strong></strong></th>
                </tr>
                <tr>
                    <th width="30%" bgcolor="greenyellow"><strong>SEGUNDO PAGO</strong></th>
                    <th width="10%"><strong></strong></th>
                    <th width="15%" bgcolor="greenyellow"><strong>$</strong></th>
                    <th width="45%"><strong></strong></th>
                </tr>
                <tr>
                    <th width="30%" bgcolor="greenyellow"><strong>TOTAL</strong></th>
                    <th width="10%"><strong></strong></th>
                    <th width="15%" bgcolor="greenyellow"><strong></strong></th>
                    <th width="45%"><strong></strong></th>
                </tr>
                </table>
                <div style="text-align:left;">
                    <table border="2" style="margin: 0 auto;" width="100%">
                    <tr>
                        <th width="100%" colspan="4" bgcolor="greenyellow">&nbsp;<strong></strong></th>
                    </tr>
                    <tr>
                        <td width="100%" ROWSPAN="4" >&nbsp;<strong>FIRMA Y SELLO DEL CAJERO: </br><textarea style="border: none;" class=area cols="100" rows="24"></textarea>
                        <textarea style="border: none;" class=area cols="100" rows="24"></textarea>
                        <textarea style="border: none;" class=area cols="100" rows="24"></textarea>
                        <textarea style="border: none;" class=area cols="100" rows="24"></textarea></strong></th>
                    </tr>
                </table>
                <div>
    </div></br></br> 
</body>
</html>
<?php
$HTML=ob_get_clean();
require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnabled" => true));
$dompdf->setOptions($opciones);

$dompdf->loadHTML($HTML);

$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));
?>