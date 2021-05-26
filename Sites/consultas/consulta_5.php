<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$comuna_1 = $_POST["primera_comuna_elegida"];
	$comuna_2 = $_POST["segunda_comuna_elegida"];

  #Pasamos las entradas a minuscula
  $comuna_1 = strtolower(string $comuna_1)
  $comuna_2 = strtolower(string $comuna_2)

  #Realizamos la consulta
 	$query = "SELECT U.id_unidad, P.nombre, P.rut, P.sexo
            FROM Personal as P, Unidades as U, CoberturaUnidades as CU
            WHERE P.id_personal = U.jefe_id
            AND U.id_unidad = CU.id_unidad
            AND CU.comuna LIKE '%$comuna_1%'
            INTERSECT 
            SELECT U.id_unidad, P.nombre, P.rut, P.sexo
            FROM Personal as P, Unidades as U, CoberturaUnidades as CU
            WHERE P.id_personal = U.jefe_id
            AND U.id_unidad = CU.id_unidad
            AND CU.comuna = LIKE '%$comuna_2%';";
	$result = $db -> prepare($query);
	$result -> execute();
	$jefes = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID Unidad</th>
      <th>Nombre jefe</th>
      <th>Rut jefe</th>
      <th>Sexo</th>
    </tr>
  <?php
	foreach ($jefes as $jef) {
      echo "<tr> <td>$jef[0]</td> <td>$jef[1]</td> <td>$jef[2]</td> <td>$jef[3]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
