<?php
include_once("../sesion.class.php"); 
include_once("../class/class_conexion.php");

$session = new sesion();
$usuario = $session->get("usuario");

/*Hay una sesion activa y se envian parametros(minimo el post)*/
if (isset($_POST['txt-post']) && isset($usuario)) 
{
	/*Si el post contiene una imagen*/
	if (isset($_POST['pst-img'])) 
	{
		echo "Aqui va los datos a ser enviados a la BD con url de imagen de usuario";
	} 
	else
	{
		/*Se carga el post en la BD*/
		$conexion = new Conexion();
		if( $conexion ) 
		{
			echo "Conexión establecida a la BD";
			$sqlUsuario = 
			"select c.idCuenta from Cuenta c
			where c.email="."'".$usuario."'";

			$idCuenta = $conexion->consultaSql($sqlUsuario);
			$row =  $conexion->obtenerFila($idCuenta);
			$_SESSION["idCuentaActual"] = $row['idCuenta'];
			sqlsrv_free_stmt( $idCuenta);

			$txtPost=$_POST['txt-post'];
			$mes= $_POST['pst-mes'];
			$fechaPosteo=$_POST['pst-anio'].'-'.$mes.'-'.$_POST['pst-dia'];
			$horaPosteo=$_POST['pst-hora'].':'.$_POST['pst-minutos'].':'.$_POST['pst-segundos'];

			echo $fechaPosteo.' Hora '.$horaPosteo;
			$sqlInsertPost=
			"INSERT INTO [LinkedinF].[dbo].[Posteo]
			           ([Cuenta_idCuenta]
			           ,[contenido]
			           ,[fechaPosteo]
			           ,[horaPosteo])
			     VALUES"."("
			           .$_SESSION["idCuentaActual"].
			           ","."'".$txtPost."'".
			           ","."'".$fechaPosteo."'".
			           ","."'".$horaPosteo."'".")";
			$insertPost=$conexion->consultaSql($sqlInsertPost);


			if (!$insertPost) {
				echo "Hubo un problema con el insert";
				var_dump(sqlsrv_errors());
			}
		}
		else
		{
			echo "Conexión no se pudo establecer.<br />";
			die( print_r( sqlsrv_errors(), true));
		}

	}

		} 
		else 
		{
			echo "No se ha recibido contenido";
		}
		
		?>

