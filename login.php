<?php
session_start();
if($_POST){
    include("./bd.php");
    $conexion = mysqli_connect("localhost", "root", "", "sabaticos");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo = $_POST["correo"];
        $password = $_POST["password"];

        // Validación de la contraseña
        if (!preg_match("/^.{8,}$/", $password)) {
            $mensaje_error = "La contraseña debe tener al menos 8 caracteres.";
        } else {
            $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
            if (!preg_match($pattern, $correo)) {
                $mensaje_error = "Formato de correo electrónico inválido.";
            }else{
      
                
                $consulta = "SELECT * FROM usuario WHERE correo = '$correo'";
                $resultado = mysqli_query($conexion, $consulta);
                $fila = mysqli_fetch_assoc($resultado);
          
                if ($fila) {
                    
                    if (password_verify($password, $fila['password'])) {
                        
                        $_SESSION["usuario"] = $fila["usuario"];
                        $_SESSION["password"] = $fila["password"];
                        $_SESSION["tipo"] = $fila["tipo"]; 
                        $_SESSION["id"] = $fila["id"];
                        $_SESSION["correo"] = $fila["correo"]; 
                        
                        $id_usuario = $fila["id"];
                        $_SESSION["id"] = $fila["id"];

                        // Obtener la idFichaInscripcion
                        $sentencia_ficha = $conexion->prepare("SELECT idFichaInscripcion FROM fichainscripcion WHERE id_usuario=?");
                        $sentencia_ficha->bind_param("i", $id_usuario);
                        $sentencia_ficha->execute();
                        $resultado_ficha = $sentencia_ficha->get_result();
                        $registro_ficha = $resultado_ficha->fetch_assoc();
                        $idFichaInscripcion = $registro_ficha['idFichaInscripcion'];

                        
                        if ($fila["tipo"] == "alumno") {
                            header("Location: index.php");
                            exit();
                        } elseif ($fila["tipo"] == "maestro") {
                            header("Location: index_M.php");
                            exit();
                        } elseif ($fila["tipo"] == "administrador") {
                            header("Location: index_A.php");
                            exit();
                        }
                    } else {
                        
                        $mensaje_error = "Correo o contraseña incorrectos";
                    }
                } else {
                    
                    $mensaje_error = "Correo o contraseña incorrectos";
                }
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="imagenes/">
    <link rel="stylesheet" href="estilos.css">

    
</head>
<body>
<style>
  body {
    background-color: #e4e4f3;
    background-color: #e4e4f3;
  }
</style>
<header>
        <div class="logo">
          <img src="imagenes/logo-universidad-tecnologica-santa-catarina-PhotoRoom.png" alt="Logotipo de la página">
        </div>
        <nav>
        <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="registrarse.php">Registrarse</a></li>
                <li><a href="login.php">Inicio de session</a></li>
                <li><a href="Faq.php">FAQ</a></li>
          </ul>
        </nav>
      </header>
  <main class="container">
<div class="row"><center></center>
<div class="col-md-4">   
        </div>  
        <div class="col-md-4">
</br></br>
<style>
    .card {
      background: linear-gradient(90deg, #ECF2FF 0%, #F1F6F9 100%);
    }
    .btn-primary {
      background-color: blue;
      color: white;
    }

    .btn-secondary {
      background-color: #696969;
      color: white;
    }
    .btn-warning {
      background-color: #FFD700 ;
      color: black;
    }
  </style>
  </br>
          <div class="card">
              <div class="card-header">
                    <a name="" id="" class="btn btn-primary" href="registrarse.php" role="button" style=" width: 150px; ;">Regístrate</a>
              </div>
                <div class="card-body">                    
                <?php if(isset($mensaje_error)){ ?>
                    <div id="mensaje-error" class="alert alert-danger" role="alert">
                        <strong><?php echo $mensaje_error; ?></strong> 
                    </div>
                <?php } ?>                  
                <form action="" method="post">
                    <div class="mb-3">
                      <label for="correo" class="form-label"><strong>Correo:</strong></label>
                      <input type="text" class="form-control" name="correo" id="correo" placeholder="Escriba su correo electronico" maxlength="16">
                    </div>
                    <div id="correo-error" class="invalid-feedback"></div>
                    <div class="mb-3">
                      <label for="password" class="form-label"><strong>Contraseña:</strong></label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Escriba su contraseña" maxlength="16">
                    </div>
                    <div id="password-error" class="invalid-feedback"></div>
                    <div class="space">
                    <div class="space">
                      <button type="submit" class="btn btn-warning" style="width: 100px; display: inline-block; margin: 0 0px;">Entrar</button>
                      <button type="button" class="btn btn-secondary" style="width: 160px; display: inline-block; margin: 0 10px;" onclick="limpiarCampos()">Limpiar campos</button>
                  </div>                   
                    </div>
                </form>
                </div>
            </div>
        </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>

<script>

    
    var valiCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    
    document.getElementById('correo').addEventListener('input', function() {
      var correoInput = this.value.trim();
      var correoError = document.getElementById('correo-error');
      if (!valiCorreo.test(correoInput)) {
        correoError.textContent = 'El formato del correo electrónico no es válido.';
        correoError.style.display = 'block';
      } else {
        correoError.style.display = 'none';
      }
    });

    
    document.getElementById('login-form').addEventListener('submit', function(event) {
      var correoInput = document.getElementById('correo').value.trim();
      var passwordInput = document.getElementById('password').value.trim();
      var correoError = document.getElementById('correo-error');
      var passwordError = document.getElementById('password-error');

      if (!valiCorreo.test(correoInput)) {
        correoError.textContent = 'El formato del correo electrónico no es válido.';
        correoError.style.display = 'block';
        event.preventDefault(); 
      } else {
        correoError.style.display = 'none';
      }

      if (passwordInput.length < 8) {
        passwordError.textContent = 'La contraseña debe tener al menos 8 caracteres.';
        passwordError.style.display = 'block';
        event.preventDefault(); 
      } else {
        passwordError.style.display = 'none';
      }
    });
  </script>

<script>
    function limpiarCampos() {
        document.getElementById('usuario').value = '';
        document.getElementById('password').value = '';
    }

    document.getElementById('usuario').addEventListener('input', function() {
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16);
        }
    });
    document.getElementById('password').addEventListener('input', function() {
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16);
        }
    });
</script>
<script>
    
    setTimeout(function() {
        var mensajeError = document.getElementById('mensaje-error');
        if (mensajeError) {
            mensajeError.style.display = 'none';
        }
    }, 4000);
</script>