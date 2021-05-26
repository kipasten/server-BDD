<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">App Entrega 2 </h1>
  <p style="text-align:center;">A continuación se podrá encontrar información de la empresa de despachos.</p>

  <br>


<!-- Consulta 1 -->
  <h3 align="center"> Clickea aquí para ver las direcciones de todas las unidades</h3>

  <form align="center" action="consultas/consulta_1.php" method="post">
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>


<!-- Consulta 2 -->
  <h3 align="center"> Escribe una comuna para ver todos los vehículos de las unidades ubicadas en ella</h3>

  <form align="center" action="consultas/consulta_2.php" method="post">
    Comuna:
    <input type="text" name="comuna_elegida">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>


<!-- Consulta 3 -->
  <h3 align="center"> Escribe una comuna y selecciona un año para ver los vehículos que realizaron despachos
  a dicha comuna en ese año</h3>

  <?php
  #Obtenemos todos los años en que se hayan hecho despachos
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT date_part('year', fecha) as año FROM Despachos ORDER BY año;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_3.php" method="post">
    Comuna:
    <input type="text" name="comuna_elegida">
    <br/><br/>
    Seleccionar un año:
    <select name="año_elegido">
      <?php
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>


<!-- Consulta 4 -->
  <h3 align="center"> Escribe un tipo de vehículo y selecciona dos edades para ver los despachos 
  realizados por un vehículo de ese tipo por un repartidor de edad en el rango seleccionado</h3>

  <?php
  #Obtenemos todos los años en que se hayan hecho despachos
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT edad FROM Personal ORDER BY edad;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_4.php" method="post">
    Tipo de vehículo:
    <input type="text" name="tipo_vehiculo_elegido">
    <br/><br/>
    Seleccionar primera edad:
    <select name="edad_1_elegida">
      <?php
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    Seleccionar segunda edad:
    <select name="edad_2_elegida">
      <?php
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>


<!-- Consulta 5 -->
  <h3 align="center"> Escribe dos comunas para ver los jefes de las unidades que realizan despachos a ambas</h3>

  <form align="center" action="consultas/consulta_5.php" method="post">
    Primera comuna:
    <input type="text" name="primera_comuna_elegida">
    <br/>
    Segunda comuna:
    <input type="text" name="segunda_comuna_elegida">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>


<!-- Consulta 6 -->
  <h3 align="center"> Escribe un tipo de vehículo para ver la unidad que maneja la mayor cantidad de estos</h3>

  <form align="center" action="consultas/consulta_6.php" method="post">
    Tipo de vehículo:
    <input type="text" name="tipo_vehiculo_elegido">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

</body>
</html>
