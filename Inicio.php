     <?php 

     include_once("class/class_conexion.php");
     include_once("sesion.class.php"); 

     $session = new sesion();
     $usuario = $session->get("usuario");

     if (!$usuario) {
      header("Location: login.php");
    } else 
    {
      ?>

      <!DOCTYPE html>
      <html>
      <head>
       <!-- Bootstrap core CSS -->
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
       <link rel="stylesheet" href="css/style.css">  
       <link rel="stylesheet" type="text/css" href="css/load.css">    
       <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
       <script
       src="https://code.jquery.com/jquery-3.3.1.min.js"
       integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
       crossorigin="anonymous"></script>
       <script src="js/configuraciones.js" ></script>
       <script src="js/inicio.js"></script>
       <title>Linkedin</title>
     </head>
     <body>
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="#">
               <img src="img/square-linkedin-512.png" alt="Logo" style="width:40px;">
            </a>
            <!-- Buscador -->
            <form class="form-inline" action="/action_page.php">
               <input class="form-control mr-sm-2" type="text" placeholder="Search">
               <button class="btn btn-success" type="submit">
                  <i class="fas fa-search"></i>
               </button>
            </form>
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a href="Index.php" class="nav-link" id="inicio"><i class="fas fa-home "></i></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="contactos"><i class="fas fa-users"></i></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="mensajes"><i class="fas fa-envelope"></i></i></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="notificaciones"><i class="fas fa-bell"></i></i></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="empleos"><i class="fas fa-briefcase"></i></a>
               </li>
               <div>
                  <li>
                     <a href="logout.php" id="logout"><i class="fa fa-lock" aria-hidden="true"></i></i></a>
                  </li>
               </div>
            </ul>
         </nav>
       <!--Contenido de pagina--> 
       <div id="contenido">
        <div class="container">
         <div class="row" id="row1">
          <div class="col-sm">
           <!--Primera Cartas de la parte superior-->
           <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Header</div>
            <div class="card-body">
             <h5 class="card-title">Primary card title</h5>
             <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
           </div>
         </div>
       </div>
       <!--Segunda Cartas de la parte superior-->
       <div class="col-sm">
         <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
          <div class="card-header">Header</div>
          <div class="card-body">
           <h5 class="card-title">Primary card title</h5>
           <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
         </div>
       </div>
     </div>
     <!--Tercera Cartas de la parte superior-->
     <div class="col-sm">
       <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
        <div class="card-header">Header</div>
        <div class="card-body">
         <h5 class="card-title">Primary card title</h5>
         <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
       </div>
     </div>
   </div>
  </div>
  <div>
   <!--Cartas contenido-->
   <div class="row" id="row2">
    <!--Lateral Izquierda Cartas contenido-->
    <div class="col-sm-">
     <div class="card" style="width: 18rem;">
      <img class="card-img-top" src="http://lorempixel.com/output/food-q-c-286-180-2.jpg" alt="Card image cap">
      <div class="card-body">
       <h5 class="card-title">Card title</h5>
       <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
       <a href="#" class="btn btn-primary">Go somewhere</a>
     </div>
   </div>
  </div>
  <!--Centro Cartas contenido-->
  <!--Centro Posts-->
  <div class="col-sm-7">
   <div class="card text-center">
    <div class="card-header">
     <span class="posticon">
       <i class="fas fa-user fa-2x"></i>
     </span>
     <span class="posticon" style="font-size: 35px;">
       Usuario
     </span>
   </div>
   <div class="card-body">
     <div class="form-group" id="txt-post">
      <textarea class="form-control" id="contenidoPst" rows="3"></textarea>
    </div>
  </div>
  <div class="row">
   <div class="col-sm" id="btn-send">
    <span class="posticon" id="imgPost">
     <i class="fas fa-camera"></i>
   </span>
   <span class="posticon" id="postear">
    <i class="fas fa-paper-plane"></i>
  </span>
  </div>
  </div>
  </div>
  <div class="timeline-wrapper" style="display: none;">
   <div class="timeline-item">
    <div class="animated-background facebook">
     <div class="background-masker header-top"></div>
     <div class="background-masker header-left"></div>
     <div class="background-masker header-right"></div>
     <div class="background-masker header-bottom"></div>
     <div class="background-masker subheader-left"></div>
     <div class="background-masker subheader-right"></div>
     <div class="background-masker subheader-bottom"></div>
     <div class="background-masker content-top"></div>
     <div class="background-masker content-first-end"></div>
     <div class="background-masker content-second-line"></div>
     <div class="background-masker content-second-end"></div>
     <div class="background-masker content-third-line"></div>
     <div class="background-masker content-third-end"></div>
   </div>
  </div>
  </div>
  <span id="postSepara">
   <hr class="style1">
  </span>
  <!--Comienzo de tarjetas posts-->
  <!--Lateral Derecha Cartas contenido-->
  <!--Comienzo de tarjetas posts-->
  <?php 
  $conexion = new Conexion();
  if( $conexion ) 
  {
   $sqlUsuario = 
   "select c.idCuenta from Cuenta c
   where c.email="."'".$usuario."'";

   $idCuenta = $conexion->consultaSql($sqlUsuario);
   $row2 =  $conexion->obtenerFila($idCuenta);
   sqlsrv_free_stmt( $idCuenta);

   $sqlPost= 
   "select * from fn_posteo"."(".$row2['idCuenta'].")"."order by fechaPosteo desc ,horaPosteo desc";

   $posts = $conexion->consultaSql($sqlPost);

   if (!$sqlPost) {
     echo "Hubo un problema con la consultaSql";
     var_dump(sqlsrv_errors());
   }
   else
   {
          while($row = $conexion->obtenerFila($posts))
          {
           if (isset($row['urlimagen'])) {
            $horaPost=$row['horaPosteo'];
            echo '<div class="card mb-3">
            <img class="card-img-top" src="'.$row['urlimagen'].'">'.
            '<div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">'.$row['contenido'].'</p>'.
            '<p class="card-text"><small class="text-muted">'.$horaPost->format('Y-m-d H:i:s').'</small></p>
            </div>
            </div>';
          } 
          else 
              {
                $horaPost=$row['horaPosteo'];
                echo '<div class="card mb-3">'.
                '<div class="card-body">
                <p class="card-text">'.$row['contenido'].'</p>'.
                '<p class="card-text"><small class="text-muted">'.$horaPost->format('Y-m-d H:i:s').'</small></p>
                </div>
                </div>';
              }
        }
    } 
  } 

  ?>
  <div class="card mb-3">
   <img class="card-img-top" src="http://lorempixel.com/output/nature-q-c-780-180-8.jpg" alt="Card image cap">
   <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div>
  </div>
  <!--Lateral Derecha Cartas contenido-->
  </div>
  </div>

  </body>
  </html>
  <?php 
  }
  ?>