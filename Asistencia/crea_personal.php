<?php

$conectar= pg_connect("host=127.0.0.1 dbname=cualquiera port=5432 user=postgres password=*******") or die ("Error de Conexion".pg_last_error());
//verifica la conexion

if(!$conectar){
echo "No se pudo conectar con el servidor";
}

$verCarner = "SELECT ci FROM personal WHERE ci = '$_POST[CI]'; ";

// Variable $result hold the connection data and the query
$verificar = pg_query($verCarner);

// Variable $count hold the result of the query
$total_col = pg_num_rows($verificar);
//ID TEMPORAL

//añade turno
if($total_col==1 && !isset($_POST['EXT'])){
  echo "CI repetido verifique si tiene extension";
}else {

  $sucursal=$_COOKIE['sucursal'];
  echo $sucursal;
  $nombre= $_POST['nombrePersona'];

  $apellidoP =$_POST['apellidoPaterno'];

  $apellidoM =$_POST['apellidoMaterno'];

  $sucursalHorario= $_POST['sucursal_horarioElegida'];
  echo $sucursalHorario;
  $correo= $_POST['sucursalMail'];

  $carnet=$_POST['CI'];

  $puesto= $_POST['puestoElegido'];

  $telefono= $_POST['personaTelefono'];

  if (isset($_POST['EXT'])) {

    $extension=$_POST['extensionCI'];;
    $query="INSERT INTO personal (id_sucursal, id_puesto, nombres ,apellido_paterno, apellido_materno, ci, ext_ci, email, telefono,id_horario_sucursal)
                    VALUES ('$sucursal', '$puesto', '$nombre', '$apellidoP', '$apellidoM', '$carnet', '$extension', '$correo', '$telefono', '$sucursalHorario');";
  }else {
    $query="INSERT INTO personal (id_sucursal, id_puesto, nombres ,apellido_paterno, apellido_materno, ci, email, telefono,id_horario_sucursal)
                    VALUES ('$sucursal', '$puesto', '$nombre', '$apellidoP', '$apellidoM', '$carnet', '$correo', '$telefono', '$sucursalHorario');";
  }

  pg_query($conectar, $query);

  echo"hecho";

}
pg_close($conectar);

header("Location: personal.php");

 ?>
