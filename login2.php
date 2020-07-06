



<?php
	require_once("sesion.class.php");
	include_once("class/class_conexion.php");

	$sesion = new sesion();
	
	if( isset($_POST["iniciar"]) )
	{
		
		$usuario = $_POST["usuario"];
		$password = $_POST["contrasenia"];
		
		if(validarUsuario($usuario,$password) == true)
		{			
			$sesion->set("usuario",$usuario);
			
			header("location: Index.php");
		}
		else 
		{
			echo '<div class="alert alert-danger">
  					Correo o contraseña invalidos.
				</div>';
		}
	}
	
	function validarUsuario($usuario, $password)
	{

		$conexion = new Conexion();
        if( $conexion ) {
             echo "Conexión establecida.<br />";
        }else{
             echo "Conexión no se pudo establecer.<br />";
             die( print_r( sqlsrv_errors(), true));
        }

		$sql = "select contrasenia from cuenta where email = '$usuario';";
		
		$result = $conexion->consultaSql($sql);

		if(1 > 0)
		{
			$row =  $conexion->obtenerFila($result);
			if( strcmp($password,$row["contrasenia"]) == 0 )
				return true;						
			else					
				return false;
		}
		else
				return false;
		sqlsrv_free_stmt( $stmt);

	}

?>


<link rel="icon" type="image/png" href="img/favicon.png" />	
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<title>Iniciar sesión</title>
<!------ Include the above in your HEAD tag ---------->

<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">
        <div class="card card-container">
            <img class="profile-img-card" src="https://i.pinimg.com/originals/8a/13/10/8a13104f4575edff41d7d89fba93a229.png" alt="" /> 
          
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" placeholder="Correo electrónico" name="usuario" required autofocus>
               
                <input type="password" id="inputPassword" name="contrasenia" class="form-control" placeholder="Contraseña" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Recordarme
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit"  name ="iniciar" value="Iniciar Sesion">Iniciar sesión</button>
            </form><!-- /form -->
            <a href="registrar-usuario.php" class="forgot-password">
                Crear nueva cuenta
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/login.js" ></script>