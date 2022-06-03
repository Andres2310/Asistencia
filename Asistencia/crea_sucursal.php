<?php

$conectar= pg_connect("host=127.0.0.1 dbname=cualquiera port=5432 user=postgres password=**********") or die ("Error de Conexion".pg_last_error());

if(!$conectar){
echo "No se pudo conectar con el servidor";
}


$ver_turno = "SELECT * FROM sucursal WHERE id_sucursal = '$_POST[sucursalNumero]' OR suc_nombre ='$_POST[sucursalNombre]'; ";

$verificar = pg_query($ver_turno);

// Variable $count hold the result of the query
$total_col = pg_num_rows($verificar);
//ID TEMPORAL



//añade turno
if($total_col>=1){
  echo"numero de sucursal o nombre ya existente";
}else {

  $query="INSERT INTO sucursal (id_sucursal, id_empresa, suc_nombre, direccion,numero_sucursal) VALUES ('$_POST[sucursalNumero]','$_GET[empresa]','$_POST[sucursalNombre]','$_POST[sucursalDireccion]','$_POST[sucursalNumero]');";
  pg_query($conectar, $query);

}

$horarios=$_POST['idHorario'];

//Array horario

for ($i=0;$i<count($horarios);$i++)
{
  $query="INSERT INTO horario_sucursal (id_horario,id_sucursal) VALUES ('$horarios[$i]','$_POST[sucursalNumero]');";
  pg_query($conectar, $query);
}
pg_close($conectar);
header("Location: sucursal.php?empresa=1");
 ?>
