<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$tipo_vehiculo = $_POST["tipo_vehiculo_elegido"];

  #Pasamos la entrada a minuscula
  $tipo_vehiculo = strtolower($tipo_vehiculo);

  #Realizamos la consulta
 	$query = "SELECT * 
            FROM (SELECT id_unidad, COUNT(tipo) as cantidad_vehiculo
            FROM Vehiculos
            WHERE tipo LIKE '%$tipo_vehiculo%'
            GROUP BY id_unidad) as D
            WHERE cantidad_vehiculo = (
            SELECT MAX (cantidad_vehiculo)
            FROM (SELECT id_unidad, COUNT(tipo) as cantidad_vehiculo
            FROM Vehiculos
            WHERE tipo LIKE '%$tipo_vehiculo%'
            GROUP BY id_unidad) as D1);";
	$result = $db -> prepare($query);
	$result -> execute();
	$vehiculos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID Unidad</th>
      <th>Cantidad de vehiculos</th>
    </tr>
  <?php
	foreach ($vehiculos as $veh) {
      echo "<tr> <td>$veh[0]</td> <td>$veh[1]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
