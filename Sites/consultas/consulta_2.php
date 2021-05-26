<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$comuna = $_POST["comuna_elegida"];
  #Pasamos lo ingresado a miniscula
  $comuna = strtolower($comuna);

  #Realizamos la consulta
 	$query = "SELECT D.comuna, V.id_vehiculo, V.tipo, V.patente, V.estado
            FROM Unidades as U, Direcciones as D, Vehiculos as V
            WHERE U.id_direccion = D.id_direccion
            AND V.id_unidad = U.id_unidad
            AND D.comuna LIKE '%$comuna%';";
	$result = $db -> prepare($query);
	$result -> execute();
	$vehiculos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID Vehículo</th>
      <th>Tipo</th>
      <th>Patente</th>
      <th>Estado</th>
    </tr>
  <?php
	foreach ($vehiculos as $veh) {
  		echo "<tr> <td>$veh[0]</td> <td>$veh[1]</td> <td>$veh[2]</td> <td>$veh[3]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
