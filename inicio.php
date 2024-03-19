<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="imagenes/">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="splide.js">
<style>
 /*Inicio*/
 /* Estilos generales */
 body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #e4e4f3;
  }
  
  /* Estilos del encabezado */
  header {
    background-color: #333;
    color: #fff;
    padding: 10px;
    display: flex;
    align-items: center;
  }
  
  .logo {
    margin-right: 20px;
  }
  
  .logo img {
    max-width: 100px;
  }
  
  nav ul {
    list-style-type: none;
    margin: 0;
    padding: 10px;
   
  }
  
  nav ul li {
    display: inline-block;
    margin-right: 10px;
  }
  
  nav ul li a {
    color: #fff;
    text-decoration: none;
  }
  
  nav ul li a:hover {
    background-color: #666;
    padding: 10px;
    border-radius: 5px;
  }

  .hero {
    background-image: url("marketing.png");
    background-size: cover;
    background-position: center;
    color: #fff;
    text-align: center;
    padding: 100px 0;
 }

 .hero h2 {
    font-size: 36px;
    margin-bottom: 20px;
    color: #fff;
 }

 .hero p {
    font-size: 18px;
    margin-bottom: 30px;
 }

 .btn {
    display: inline-block;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 4px;
 }

  footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 20px 0;
 }

       .cursos {
      margin-top: 40px;
      text-align: center;
     }

     .cursos h3 {
      font-size: 24px;
      margin-bottom: 20px;
     }

     .curso {
      display: inline-block;
      width: 1000px;
      margin: 20px;
     }

     .curso img {
      width: 100%;
      max-height: 500px;
      object-fit: cover;
      border-radius: 4px;
     }

     .curso h4 {
      font-size: 18px;
      margin: 10px 0;
     }

     .curso p {
      font-size: 14px;
      margin-bottom: 10px;
      text-align: justify;
     }
    </style>
    <title>Inicio</title>
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

  <main>
    <section class="hero">
        <div class="container">
            <h2>Aprende nuevas habilidades con nuestros cursos profesionales</h2>
            <p>Explora nuestra selección de cursos y amplía tus conocimientos en el campo que desees.</p>
            <a href="Cursos.html" class="btn">Ver Cursos</a>
        </div>
    </section>

    <section class="cursos">
      <div class="container">
          <h3>Cursos Destacados</h3>
          <div class="curso">
              <img src="imagenes/curso_ingles_web.jpg" alt="Curso 1">
              <h4>Curso de Ingles</h4>
              <p>Nuestro curso de inglés conversacional está diseñado para ayudarte a adquirir las habilidades lingüísticas necesarias para comunicarte de manera efectiva en inglés Ya sea que seas principiante o tengas conocimientos previos del idioma, este curso te mejorará las herramientas y la práctica necesaria para mejorar tus habilidades de habla, comprensión auditiva, lectura y escritura.</p>
              <a href="registrarse.php" class="btn">Detalles</a>
          </div>
         <!---
          <div class="curso">
              <img src="curso2.jpg" alt="Curso 2">
              <h4>Curso 2</h4>
              <p>Descripcion de curso.</p>
              <a href="cursos.php" class="btn">Detalles</a>
          </div>
      </div>
      --->


  </main>


  <footer>
    <div class="container">
        <p>&copy; 2023 Cursos Profesionales. Todos los derechos reservados.</p>
    </div>
</footer>



</body>
</html>
