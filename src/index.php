
<?php
$a = session_id();
if(empty($a)) session_start();
$a = session_id();
//echo "<br />session_id(): " . $a
?>

<?php
	//Crear la conexión
	$srv="wordlecesur.database.windows.net";
	$opc=array("Database"=>"wordle", "UID"=>"wordle", "PWD"=>"12345Ab##");
	$con=sqlsrv_connect($srv,$opc) or die(print_r(sqlsrv_errors(), true));
	$sql="select
	substring(palabraintentada,1,1) as pal1,
	substring(palabraintentada,2,1) as pal2,
	substring(palabraintentada,3,1) as pal3,
	substring(palabraintentada,4,1) as pal4,
	substring(palabraintentada,5,1) as pal5,
	substring(resultado,1,1) as res1,
	substring(resultado,2,1) as res2,
	substring(resultado,3,1) as res3,
	substring(resultado,4,1) as res4,
	substring(resultado,5,1) as res5 from intentos i
	 inner join jugadores j on j.id=i.idjugador
	inner join palabras p on i.idpalabra=p.id
	where j.nombre = '" . $a . "' and fecha = cast(getdate() as date) ";
	$res=sqlsrv_query($con,$sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wordle de Bernat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />

	<style>

.A {
	background-color:#c9b458;
}

.G {
	background-color:#787c7e;
}

.V {
	background-color:#6aaa64;
}
.wordle {
  width:400px;
 
}
.cuadrado {
	width:70px;
	height:70px;
	font-size:40px;
	float:left;
	margin: 5px;
    border: 2px solid #787c7e;
  	text-align: center;
  	text-transform: uppercase;
  	color:white;
  	font: sans-serif;
  	font-weight: bold;
}
.linea {
    width:100%;
	float:left;

	
}
	</style>
</head>
<body>
<div class="container">
  <div class="abs-center">
    
 

	<h1 >Wordle de Bernat</h1>
	<div class ="wordle ">
	<?php 

	$contador = 1;

	while($row=sqlsrv_fetch_array($res))
	{
			?>
        <div class="linea">
			<div class="cuadrado <?php echo $row['res1'];?>" > <?php echo $row['pal1'];?></div>
			<div class="cuadrado <?php echo $row['res2'];?>" > <?php echo $row['pal2'];?></div>
			<div class="cuadrado <?php echo $row['res3'];?>" > <?php echo $row['pal3'];?></div>
			<div class="cuadrado <?php echo $row['res4'];?>" > <?php echo $row['pal4'];?></div>
			<div class="cuadrado <?php echo $row['res5'];?>" > <?php echo $row['pal5'];?></div>
    	</div>
	<?php
	$contador++;
}
sqlsrv_close($con);
$palabrasintentadas=$contador;
while ($contador <=6)
{
	?>
		<div class="linea">
			<div class="cuadrado" ></div>
			<div class="cuadrado" ></div>
			<div class="cuadrado" ></div>
			<div class="cuadrado" ></div>
			<div class="cuadrado" ></div>
		</div>
	<?php
	$contador++;
}
?>


		<form  class="border p-3 form" method="post" action="./guardarintento.php">
    	  	<div class="form-group">
        		<input type="text" name="palabra" id="palabra" class="form-control" maxlength="5" autofocus <?php 
		if($palabrasintentadas >6)
			echo "disabled"
		?>>
      		</div>
       	 	<button type="submit" class="btn btn-primary" style="display:none;" >enviar</button>
    	</form>
	

	</div>

  </div>
</div>

</body>
</html>
