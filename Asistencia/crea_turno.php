<?php

$conectar= pg_connect("host=127.0.0.1 dbname=cualquiera port=5432 user=postgres password=**********") or die ("Error de Conexion".pg_last_error());
//verifica la conexion

if(!$conectar){
echo "No se pudo conectar con el servidor";
}



  $ver_turno = "SELECT * FROM turno WHERE nombre_turno = '$_POST[nombre_turno]'; ";

  // Variable $result hold the connection data and the query
  $verificar = pg_query($ver_turno);

  // Variable $count hold the result of the query
  $total_col = pg_num_rows($verificar);
  //ID TEMPORAL



  //añade turno
  if($total_col==1){
    echo"nombre ya esta registrado";
  }else{

    $turno=$_POST['nombre_turno'];
    $query="INSERT INTO turno (nombre_turno) VALUES ('$_POST[nombre_turno]');";
    pg_query($conectar, $query);
    $buscar = pg_query($conectar,"SELECT id_turno FROM turno WHERE nombre_turno='$_POST[nombre_turno]';");
    $id_turno = pg_fetch_assoc($buscar);
    echo $id_turno['id_turno'];

    //horarios

    $entrada1=$_POST['horaIn1'];
    $salida1=$_POST['horaOut1'];

    $gracia=$_POST['min_gracia'];
    if(isset($_POST['hora2'])){
      $entrada2=$_POST['horaIn2'];
      $salida2=$_POST['horaOut2'];
      $query="INSERT INTO horario (id_turno, ingreso_1, salida_1 ,ingreso_2, salida_2, minutos_gracia) VALUES ('$id_turno[id_turno]', '$entrada1', '$salida1', '$entrada2', '$salida2', '$gracia');";
    }else{
      $query="INSERT INTO horario (id_turno, ingreso_1, salida_1, minutos_gracia) VALUES ('$id_turno[id_turno]', '$entrada1', '$salida1', '$gracia');";
    }

    pg_query($conectar, $query);
  }

pg_close($conectar);
header("Location: turnos.php?empresa=1");
 ?>
