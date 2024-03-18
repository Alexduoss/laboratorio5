<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de ventas por nombre de producto</title>
</head>
<body>
    <h1>Búsqueda de ventas</h1>
    <form action="ventas.php" method="GET">
        Nombre del producto:
        <input type="text" name="nombre_producto">
        <input type="submit" value="Buscar">
    </form>
    <?php
        $dbuser = 'root';
        $dbpassword = "";

        // Establecer conexión a la base de datos
        $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=registro", $dbuser, $dbpassword);

        // Consultar y mostrar todas las filas de la tabla ventas antes de la consulta
        $consultaInicial = $conn->query("SELECT * FROM ventas");
    ?>
    <h2>Tabla de ventas</h2>
    <table border="1">
        <tr>
            <th>Nombre del Producto</th>
            <th>Cantidad Vendida</th>
            <th>Precio Total</th>
            <th>Fecha de Venta</th>
        </tr>
        <?php
        while ($row = $consultaInicial->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td>
                <?php
                    // Obtener el nombre del producto utilizando el ID del producto
                    $id_producto = $row["id_producto"];
                    $consulta_producto = $conn->query("SELECT nombre_producto FROM inventario_farmacia WHERE id = $id_producto");
                    $producto = $consulta_producto->fetch(PDO::FETCH_ASSOC);
                    echo $producto["nombre_producto"];
                ?>
            </td>
            <td><?php echo $row["cantidad_vendida"]; ?></td>
            <td><?php echo $row["precio_total"]; ?></td>
            <td><?php echo $row["fecha_venta"]; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php

    if(isset($_GET["nombre_producto"])){
        $nombre_producto = $_GET["nombre_producto"];
        echo "Búsqueda por nombre de producto: $nombre_producto";

        // Ejecutar consulta sin preparar
        $consultaSQL = "SELECT * FROM ventas WHERE id_producto = (SELECT id FROM inventario_farmacia WHERE nombre_producto = '$nombre_producto')";
        $consultaSQL = $conn->query($consultaSQL);
    ?>
    <h2>Resultados de la búsqueda</h2>
    <table border="1">
        <tr>
            <th>Nombre del Producto</th>
            <th>Cantidad Vendida</th>
            <th>Precio Total</th>
            <th>Fecha de Venta</th>
        </tr>
        <?php
        // Mostrar los resultados de la consulta en forma de tabla
        while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td>
                <?php
                    // Obtener el nombre del producto utilizando el ID del producto
                    $id_producto = $row["id_producto"];
                    $consulta_producto = $conn->query("SELECT nombre_producto FROM inventario_farmacia WHERE id = $id_producto");
                    $producto = $consulta_producto->fetch(PDO::FETCH_ASSOC);
                    echo $producto["nombre_producto"];
                ?>
            </td>
            <td><?php echo $row["cantidad_vendida"]; ?></td>
            <td><?php echo $row["precio_total"]; ?></td>
            <td><?php echo $row["fecha_venta"]; ?></td>
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
