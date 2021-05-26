<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Realizamos la consulta
 	$query = "SELECT U.id_unidad, D.nombre_direccion FROM Unidades as U, Direccions as D WHERE U.id_direccion = D.id_direccion;";
	$result = $db -> prepare($query);
	$result -> execute();
	$direcciones = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID Unidad</th>
      <th>Dirección</th>
    </tr>
  <?php
	foreach ($direcciones as $dir) {
  		echo "<tr> <td>$dir[0]</td> <td>$dir[1]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
