<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$comuna = $_POST["comuna_elegida"];
	$año = $_POST["año_elegido"];

  #Pasamos las entradas a minuscula o ajustamos tipo de dato
  $comuna = strtolower($comuna);
  $año = intval($año);

  #Realizamos la consulta
 	$query = "SELECT DISTINCT D.comuna, V.id_vehiculo, V.tipo, V.patente, V.estado
            FROM Vehiculos as V, Despachos as De, Direcciones as D
            WHERE De.id_direccion_destino = D.id_direccion
            AND De.id_vehiculo = V.id_vehiculo
            AND D.comuna LIKE '%$comuna%'
            AND date_part('year', De.fecha) = '$año';";
	$result = $db -> prepare($query);
	$result -> execute();
	$vehiculos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Comuna</th>
      <th>ID Vehiculo</th>
      <th>Tipo</th>
      <th>Patente</th>
      <th>Estado</th>
    </tr>
  <?php
	foreach ($vehiculos as $veh) {
      echo "<tr> <td>$veh[0]</td> <td>$veh[1]</td> <td>$veh[2]</td> <td>$veh[3]</td> <td>$veh[4]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
