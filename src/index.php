
<?php
$a = session_id();
if(empty($a)) session_start();
$a = session_id();
echo "<br />session_id(): " . $a
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
	<style>

td,th   {border:1px solid  green;}

.A {
	background-color:yellow;
}

.G {
	background-color:grey;
}

.V {
	background-color:green;
}

.cuadrado {
	width:60px;
	height:60px;
	border:1px solid black;
	margin: 10px;
    float:left;
}
.linea {
    width:100%;
    float:left;
}
	</style>
</head>
<body>
<h1>Wordle de Bernat</h1>
<div class ="wordle">
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
while ($contador <6)
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



</div>
<form action="./guardarintento.php" method="POST">
<input type="text" name="palabra" />
<input type="submit" />
</form>
	

</body>
</html>
