<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="imagenes/">
    <link rel="stylesheet" href="estilos.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>FAQ</title>
    <style type="text/css">
        .faq-item{
          margin-bottom: 40px;
          margin-top: 50px;
          margin-left: 20px;
          margin-right: 30px;
        }
        .faq-body{
          display: none;
          margin-top: 30px;
        }
        .faq-wrapper{
          width: 50%;
          margin: 10px auto;
        }
        .faq-plus{
          float: right;
          font-size: 1.4em;
          line-height: 1em;
          cursor: pointer;
        }
  </style>
</head>
<body>
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
  <div class="caja">
    <div class="faq-item">
        <h3>
        ¿Que dia inician los cursos?
        <span class="faq-plus">&plus;</span>
        </h3>
        <div class="faq-body">
        Sabado 20 de Mayo del 2024
        </div>
        </div>
        <hr>
        <div class="faq-item">
        <h3>
        ¿Que fecha terminan los cursos?
        <span class="faq-plus">&plus;</span>
        </h3>
        <div class="faq-body">
        Sabado 26 de Agosto del 2023
        </div>
        </div>
        <hr>
        <div class="faq-item">
        <h3>
        ¿Que horario tienen los cursos?
        <span class="faq-plus">&plus;</span>
        </h3>
        <div class="faq-body">
        De 9:00 a 12:00 hrs
        </div>
        </div>
        <hr>
        <div class="faq-item">
        <h3>
        ¿Que duracion tienen los cursos y que incluye?
        <span class="faq-plus">&plus;</span>
        </h3>
        <div class="faq-body">
        12 sábados incluyendo un examen de medio término y uno final para aprobar el módulo.
        </div>
        </div>
        <hr>
        <div class="faq-item">
        <h3>
        ¿Los cursos son presencial o en linea?
        <span class="faq-plus">&plus;</span>
        </h3>
        <div class="faq-body">
        presencial, cupo máximo por salón 17 personas, respetando las medidas
        </div>
        </div>
        <hr>
        <div class="faq-item">
        <h3>
        <h3>
        ¿Que costo tienen los cursos?
        <span class="faq-plus">&plus;</span>
        </h3>
        <div class="faq-body">
        a.  PÚBLICO EN GENERAL $1,500 </br>
        b.  MIEMBROS DE LA COMUNIDAD UTSC $1000 EL MÓDULO
        En ambos casos, el costo es por el cuatrimestral completo, por adelantado, pagado en una  sola exhibición.
        </div>
        </div>
        <hr>
        <div class="faq-item">
        <h3>
        ¿Cual es el metodo de pago de los cursos?
        <span class="faq-plus">&plus;</span>
        </h3>
        <div class="faq-body">
          a.  Para miembros de la Comunidad UTSC el pago se hace en la caja, en la Universidad, </br>
          b.  Para el público en general, el pago se hará vía depósito bancario o SPEI BANCA AFIRME (se anexa información por separado) Para poder realizar el pago, favor de esperar a que se le envíe la ficha de inscripción para llenar con sus datos y luego proceder a hacer el pago.  (guardar el comprobante y enviarlo por los medios señalados) </br>
          c.  En cualquiera de los casos, es necesario el llenado previo de la ficha de inscripción con sus datos.
            </div>
        </div>
        <hr>
        <div class="faq-item">
        <h3>
        ¿Cuando inician las inscripciones?
        <span class="faq-plus">&plus;</span>
        </h3>
        <div class="faq-body">
        Martes 2 de Mayo del 2023
        </div>
        </div>
        <hr>
        <div class="faq-item">
         <h3>
          Para mas informacion Mandar correo idiomas@utsc.edu.mx
            <script type="text/javascript">
              $(".faq-plus").on('click',function(){
                $(this).parent().parent().find('.faq-body').slideToggle();
              });
         </script>
  </div>
  <footer>
    <div class="container">
        <p>&copy; 2023 Cursos Profesionales. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>