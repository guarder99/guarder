<html>
  <head>
    <title>
      Launchaco - Name a Business.
    </title>
    <meta charSet="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/devices.css">
  </head>
  <body>
    <header class="header">
      <div class="container-lrg">
        <div class="col-12 spread">
          <div>
            <a class="logo">
              Guarder
            </a>
          </div>
          <div>
    <form action="controlador/controladorLogin.php" method="post">
    <input class="ctas-button"    name="fEmail" type="email" maxlength="60" placeholder="nombre@sucorreo.co" required aut>
    <input class="ctas-button"    name="fClave" type="password" placeholder="Password" required>
    <button class="ctas-button"  name="fEnviar" type="submit" value="Ingresar">Ingresar</button>
    </form>
    
    <?php
    @$mensaje = $_GET['mensaje'];
    if(isset($mensaje)){
        if($mensaje=='incorrecto'){
            echo '<div class="alert alert-danger" role="alert">Usuario o Clave incorrecto</div>';
        }
    }
    ?>
            <a class="nav-link" href="#">
              Twitter
            </a>
            <a class="nav-link" href="#">
              Facebook
            </a>
          </div>
        </div>
      </div>
      <div class="container-lrg flex">
        <div class="col-6 centervertical">
          <h1 class="heading">
            Sistema De Informacion Para Una Guarderia
          </h1>
          <h2 class="paragraph ">
            El sistema de infromacion Guarder le perimitira ingresar los datos de los padres, profesores y acudientes, tambien le permitira registrar los avances de los estudiantes, las mesualidades, las matriculas y las incidencias.
          </h2>
        </div>
        <div class="col-6 sidedevices">
          <div class="iphoneipad">
            <div class="iphone">
              <div class="mask">
                <img class="mask-img" src="img/Captura.JPG">
              </div>
            </div>
            <div class="ipad">
              <div class="mask">
                <img class="mask-img" src="img/descarga.jpg">
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="feature5">
      <div class="container-sml text-center">
        <div class="col-12">
          <h3 class="heading">
            Guarder
          </h3>
        </div>
      </div>
      <div class="container-lrg flex">
        <div class="col-5 centervertical">
          <div class="steps">
            <div class="emoji">
              <b>
                ✔️
              </b>
            </div>
            <h3 class="subheading">
              Regitra Avances
            </h3>
            <p class="paragraph">
              Launchaco instantly shows you the most relevant domain names. Followed by hundreds of new gtlds. Get your .gold domain name today!
            </p>
          </div>
          <div class="steps">
            <div class="emoji">
              <b>
                ✔️
              </b>
            </div>
            <h3 class="subheading">
              Registra Mesualidad
            </h3>
            <p class="paragraph">
              El sistema de informaciòn regitrar los avances: fisicos, verbal, matematico, psicologico, general que presenta cada estudiante.
            </p>
          </div>
          <div class="steps">
            <div class="emoji">
              <b>
                ✔️
              </b>
            </div>
            <h3 class="subheading">
              Registra Matricula y Cursos
            </h3>
            <p class="paragraph">
              El sistema de infromcion registrar todas la fecha de pago, valor del pago y el dia que lo cancelan.
            </p>
          </div>
        </div>
        <div class="col-1">
        </div>
        <div class="col-6">
          <div class="sidedevices">
            <div class="iphoneipad2">
              <div class="iphone">
                <div class="mask">
                  <img class="mask-img" src="img/Captura2.JPG">
                </div>
              </div>
              <div class="ipad">
                <div class="mask">
                  <img class="mask-img" src="img/descarga%20(1).jpg">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="socialproof">
      <div class="container-sml">
        <div class="flex text-center">
          <div class="col-12">
            <h4 class="subheading">
              Las matriculas se pueden realizar por internet padre de familia: Ana Maria Torrez<div><div>Es mas facil registrar los datos de los padres porfesores y estudiantes, llevar el control de los avances y mesualidades&nbsp;</div><div>Adiministracion: Directora Pilar Hernandez</div></div>
            </h4>
            <p class="paragraph">
              guarder1@gmail.com
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="container-sml">
        <div class="col-12 text-center">
          <div>
            <a class="nav-link">
              Twitter
            </a>
            <a class="nav-link">
              Facebook
            </a>
            <a class="nav-link">
              Contact
            </a>
            <a class="nav-link">
              TOS
            </a>
            <a class="nav-link">
              Privacy
            </a>
          </div>
          <br>
          <div>
            <span>
              © 2016 Compute Studios.
            </span>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>