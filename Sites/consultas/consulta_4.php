<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$tipo_vehiculo = $_POST["tipo_vehiculo_elegido"];
	$edad_1 = $_POST["edad_1_elegida"];
  $edad_2 = $_POST["edad_2_elegida"];

  #Pasamos las entradas a minuscula o ajustamos tipo de dato
  $tipo_vehiculo = strtolower(string $tipo_vehiculo)
  $edad_1 = intval($edad_1)
  $edad_2 = intval($edad_2)

  #Aqui ordenamos las edades en caso de que entreguen una edad mas grande primero
  if ($edad_1 > $edad_2)
    $edad_3 = $edad_1;
    $edad_1 = $edad_2;
    $edad_2 = $edad_3;

  #Realizamos la consulta
 	$query = "SELECT De.id_despacho, De.fecha, De.id_compra, De.id_vehiculo, De.id_repartidor
            FROM Despachos as De, Vehiculos as V, Personal as P
            WHERE De.id_vehiculo = V.id_vehiculo
            AND De.id_repartidor = P.id_personal
            AND V.tipo LIKE '%$tipo_vehiculo%'
            AND P.edad BETWEEN '$edad_1' AND '$edad_2';";
	$result = $db -> prepare($query);
	$result -> execute();
	$despachos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID Despacho</th>
      <th>Fecha</th>
      <th>ID Compra</th>
      <th>ID Vehículo</th>
      <th>ID Repartidor</th>
    </tr>
  <?php
	foreach ($despachos as $des) {
      echo "<tr> <td>$des[0]</td> <td>$des[1]</td> <td>$des[2]</td> <td>$des[3]</td> <td>$des[4]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
