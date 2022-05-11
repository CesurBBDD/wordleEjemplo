<?php
	//Crear la conexión
	$srv="sqlserver";
	$opc=array("Database"=>"wordle", "UID"=>"sa", "PWD"=>"12345Ab##");
	$con=sqlsrv_connect($srv,$opc) or die(print_r(sqlsrv_errors(), true));
	$sql="select dbo.DimePalabraDeHoy() as palabra";
	$res=sqlsrv_query($con,$sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
        td,th   {border:1px solid  blue;}

		.Piano { background-color: green}
	</style>
</head>
<body>
<?php
  $row=sqlsrv_fetch_array($res);
?>
		
	<H1 class="<?php 	echo $row['palabra'];
 ?>">

<?php
				    sqlsrv_close($con);
					?>

hola
</h1>
</body>
</html>