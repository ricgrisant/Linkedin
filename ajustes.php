<!DOCTYPE html>

<html lang="en">

<head>
 <title>Ajustes</title>
 <meta charset = "utf-8">
 <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>
<div class="container">

<?php

	include_once("class/class_conexion.php");

	
	if( isset($_POST["Modificar"]) )
	{
		
		$correo = $_POST["correo"];
		$contrasenia = $_POST["contrasenia"];
		
		
		if(existeUsuario($correo, $contrasenia) == true)
		{	
			$conex2 = new Conexion();
			$query = "exec sp_actualizarUsuario '$_POST[correo]','$_POST[contrasenia]','$_POST[username1]','$_POST[username2]','$_POST[username3]','$_POST[username4]','$_POST[nacimiento]'";


			$conex2->consultaSql($query);		

			echo '<div class="alert alert-success">
					Cambios guardados exitosamente
				  </div>';
			
		}
		else 
		{

			echo '<div class="alert alert-danger">
  					Usuario o contraseña invalidos.
				</div>';		
		}
	}
	
	function existeUsuario($usuario, $contrasenia)
	{
		$conexion = new Conexion();

        if( $conexion ) {
             //echo "Conexión establecida.<br />";
        }else{
             echo "Conexión no se pudo establecer.<br />";
             die( print_r( sqlsrv_errors(), true));
        }



			$sql = "select contrasenia from cuenta where email = '$usuario';";


			
			$result = $conexion->consultaSql($sql);




			$row = $conexion->obtenerFila($result);
		if( strcmp($contrasenia,$row["contrasenia"]) == 0 )
			return true;						
		else
			return false;


	}

?>

 <header>
 <h1>Ajustes</h1>
 </header> 
 <form class="container" name="frmAjustes" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

 <hr />
 <h3>Modificar datos de usuario</h3>

 <!--Primer nombre-->
 <label for="nombre">Primer nombre:</label><br>
 <input class="form-control" type="text" name="username1" maxlength="32" required>
 <br/><br/>

  <!--Segundo Nombre-->
 <label for="nombre">Segundo nombre:</label><br>
 <input class="form-control" type="text" name="username2" maxlength="32" >
 <br/><br/>
  <!--Primer apellido-->
 <label for="nombre">Primer apellido:</label><br>
 <input class="form-control" type="text" name="username3" maxlength="32" required>
 <br/><br/>
  <!--Segundo apellido-->
 <label for="nombre">Segundo apellido:</label><br>
 <input class="form-control" type="text" name="username4" maxlength="32" >
 <br/><br/>
   <!--Fecha de nacimiento-->
 <label for="nombre">Fecha de nacimiento:</label><br>
 <input class="form-control" type="date" name="nacimiento" maxlength="32" >
 <br/><br/>

  <h3>Ingrese su correo y contraseña para efectuar los cambios</h3>
  <!--Correo electronico-->
 <label for="nombre">Correo electrónico:</label><br>
 <input class="form-control" type="text" name="correo" maxlength="32" >
 <br/><br/>
 <!--Password-->
 <label for="pass">Contraseña:</label><br>
 <input class="form-control" type="password" name="contrasenia" maxlength="8" required>

 <br/><br/>
 <input class="btn btn-info" type="submit" name="Modificar" value="Guardar Cambios">
 <input class="btn" class="btn" type="reset" name="clear" value="Limpiar">

 </form>

<hr /><br />

</div>

 </body>
 	<!-- End #  Form -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</html>