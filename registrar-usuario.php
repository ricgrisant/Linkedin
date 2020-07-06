<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<title>Registro usuario</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
<!------ Include the above in your HEAD tag ---------->

</head>
<body>




<?php

	include_once("class/class_conexion.php");

	$nombre;
	$nombres=array();
	$apellido;
	$apellidos=array();


	if( isset($_POST["Iniciar"]) )
	{
		
		$correo = $_POST["correo"];
		
		
		if(existeUsuario($correo) == true)
		{			
			echo '<div class="alert alert-danger">
					El usuario <strong>'.$correo.'</strong> ya existe
				  </div>';
			

		}
		else 
		{


			$nombre  = $_POST['username1'];
			$nombres = explode(" ", $nombre);


			$apellido  = $_POST['username2'];
			$apellidos = explode(" ", $apellido);

			
			$conex2 = new Conexion();
		

			if( count($nombres)==1 )
				$nombres[1]='';

			if( count($nombres)==3 )
				$nombres[1]=$nombres[1].' '.$nombres[2];

			if( count($apellidos)==1 )
				$apellidos[1]='';

				$query = "exec sp_registroUsuario '$_POST[correo]','$_POST[contrasenia]','$nombres[0]','$nombres[1]','$apellidos[0]','$apellidos[1]','$_POST[nacimiento]';";
			
			

			$conex2->consultaSql($query);


			echo '<div class="alert alert-success">
  					Usuario ingresado.
				</div>';



		}
	}
	
	function existeUsuario($usuario)
	{
		$conexion = new Conexion();

        if( $conexion ) {

        }else{
             echo "Conexión no se pudo establecer.<br />";
             die( print_r( sqlsrv_errors(), true));
        }



			$sql = "select email from cuenta where email = '$usuario';";


			
			$result = $conexion->consultaSql($sql);




			$row = $conexion->obtenerFila($result);
		if( strcmp($usuario,$row["email"]) == 0 )
			return true;						
		else
			return false;
	
	}


?>


<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">
        <div class="card card-container">




            <img class="profile-img-card" src="https://i.pinimg.com/originals/8a/13/10/8a13104f4575edff41d7d89fba93a229.png" alt="" /> 

          
            <p id="profile-name" class="profile-name-card"></p>
            <form class="frmLogin form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text"  class="form-control" placeholder="Nombre" name="username1" required autofocus id="inputNombre">

                <input type="text"  class="form-control" placeholder="Apellido" name="username2" required autofocus id="inputApellido">
         
 				<input type="date" class="form-control" placeholder="Fecha de nacimiento" name="nacimiento" required autofocus id="inputFecha">

				<input type="email"  class="form-control" placeholder="Correo electrónico" name="correo" maxlength="32" required autofocus id="inputEmail">

				<input type="password" class="form-control" name="contrasenia"  placeholder="Contraseña" maxlength="32" required autofocus id="inputPassword">


                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit"  name ="Iniciar" value="Iniciar Sesion">Registrarse</button>
            </form><!-- /form -->
            <a href="login.php" class="forgot-password">
                Iniciar sesión
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/login.js" ></script>

</body>
</html>
