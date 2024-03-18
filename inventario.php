<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de productos por día de vencimiento</title>
</head>
<body>
    <h1>Búsqueda de productos por día de vencimiento</h1>
    <form action="inventario.php" method="GET">
        Día de vencimiento a buscar:
        <input type="date" name="fecha_vencimiento">
        <input type="submit" value="Buscar">
    </form>

    <?php
        $dbuser = 'root';
        $dbpassword = "";

        // Establecer conexión a la base de datos
        $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=registro", $dbuser, $dbpassword);

        // Consultar y mostrar todas las filas de la tabla inventario_farmacia antes de la consulta
        $consultaInicial = $conn->query("SELECT * FROM inventario_farmacia");
    ?>
    <h2>Tabla de inventario</h2>
    <table border="1">
        <tr>
            <th>Nombre del Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Fecha de Vencimiento</th>
            <th>Proveedor</th>
            <th>Ubicación</th>
        </tr>
        <?php
        while ($row = $consultaInicial->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php echo $row["nombre_producto"]; ?></td>
            <td><?php echo $row["descripcion"]; ?></td>
            <td><?php echo $row["cantidad"]; ?></td>
            <td><?php echo $row["precio_unitario"]; ?></td>
            <td><?php echo $row["fecha_vencimiento"]; ?></td>
            <td><?php echo $row["proveedor"]; ?></td>
            <td><?php echo $row["ubicacion"]; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php

    if(isset($_GET["fecha_vencimiento"])){
        $fecha_vencimiento = $_GET["fecha_vencimiento"];
        echo "Búsqueda por día de vencimiento: $fecha_vencimiento";

        // Ejecutar consulta sin preparar
        $consultaSQL = "SELECT * FROM inventario_farmacia WHERE fecha_vencimiento = '$fecha_vencimiento'";
        $consultaSQL = $conn->query($consultaSQL);
    ?>
    <h2>Resultados de la búsqueda</h2>
    <table border="1">
        <tr>
            <th>Nombre del Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Fecha de Vencimiento</th>
            <th>Proveedor</th>
            <th>Ubicación</th>
        </tr>
        <?php
        // Mostrar los resultados de la consulta en forma de tabla
        while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php echo $row["nombre_producto"]; ?></td>
            <td><?php echo $row["descripcion"]; ?></td>
            <td><?php echo $row["cantidad"]; ?></td>
            <td><?php echo $row["precio_unitario"]; ?></td>
            <td><?php echo $row["fecha_vencimiento"]; ?></td>
            <td><?php echo $row["proveedor"]; ?></td>
            <td><?php echo $row["ubicacion"]; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
    }
    ?>
</body>
</html>

