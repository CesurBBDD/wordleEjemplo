<?php
echo $_POST["palabra"];
$a = session_id();
if(empty($a)) session_start();
$a = session_id();

$srv="wordlecesur.database.windows.net";
$opc=array("Database"=>"wordle", "UID"=>"wordle", "PWD"=>"12345Ab##");
$con=sqlsrv_connect($srv,$opc) or die(print_r(sqlsrv_errors(), true));
$sql="exec wordle '". $a. "','".$_POST["palabra"]."'";
$res=sqlsrv_query($con,$sql);
sqlsrv_close($con);



header('Location: ./');
exit;
?>