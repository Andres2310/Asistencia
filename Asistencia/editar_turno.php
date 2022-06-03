<?php $conectar= pg_connect("host=127.0.0.1 dbname=cualquiera port=5432 user=postgres password=**********") or die ("Error de Conexion".pg_last_error());
//verifica la conexion

if(!$conectar){
echo "No se pudo conectar con el servidor";
}


  // Variable $count hold the result of the query
  //ID TEMPORAL
  //añade turno

    $turno=$_POST['nombre_turno'];
    $query="UPDATE turno
            SET nombre_turno = '$_POST[nombre_turno]'
            WHERE id_turno='$_GET[turnoId]';";
    pg_query($conectar, $query);



    //horarios

    $entrada1=$_POST['horaIn1'];
    $salida1=$_POST['horaOut1'];

    $gracia=$_POST['min_gracia'];
    if(isset($_POST['hora2'])){
      $entrada2=$_POST['horaIn2'];
      $salida2=$_POST['horaOut2'];
      $query="UPDATE horario
              SET ingreso_1 = '$entrada1', salida_1 = '$salida1',ingreso_2 = '$entrada2',salida_2 = '$salida2',minutos_gracia = '$gracia'
              WHERE id_horario='$_GET[horario]';";
    }else{
      $query="UPDATE horario
              SET ingreso_1 = '$entrada1', salida_1 = '$salida1',minutos_gracia = '$gracia'
              WHERE id_horario='$_GET[horario]';";
    }

    pg_query($conectar, $query);



pg_close($conectar);
header("Location: turnos.php?empresa=1");
 ?>
