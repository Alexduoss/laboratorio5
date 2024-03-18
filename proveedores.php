<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de proveedores por nombre de producto</title>
</head>
<body>
    <h1>Búsqueda de proveedores</h1>
    <form action="proveedores.php" method="GET">
        Nombre del producto:
        <input type="text" name="nombre_producto">
        <input type="submit" value="Buscar">
    </form>
    <?php
        $dbuser = 'root';
        $dbpassword = "";

        // Establecer conexión a la base de datos
        $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=registro", $dbuser, $dbpassword);

        // Consultar y mostrar todas las filas de la tabla proveedores antes de la consulta
        $consultaInicial = $conn->query("SELECT * FROM proveedores");
    ?>
    <h2>Tabla de proveedores</h2>
    <table border="1">
        <tr>
            <th>Nombre Empresa</th>
            <th>Contacto Persona</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Dirección</th>
        </tr>
        <?php
        while ($row = $consultaInicial->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php echo $row["nombre_empresa"]; ?></td>
            <td><?php echo $row["contacto_persona"]; ?></td>
            <td><?php echo $row["telefono"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["direccion"]; ?></td>
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
        $consultaSQL = "SELECT * FROM proveedores WHERE nombre_empresa IN (SELECT proveedor FROM inventario_farmacia WHERE nombre_producto = '$nombre_producto')";
        $consultaSQL = $conn->query($consultaSQL);
    ?>
    <h2>Resultados de la búsqueda</h2>
    <table border="1">
        <tr>
            <th>Nombre Empresa</th>
            <th>Contacto Persona</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Dirección</th>
        </tr>
        <?php
        // Mostrar los resultados de la consulta en forma de tabla
        while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php echo $row["nombre_empresa"]; ?></td>
            <td><?php echo $row["contacto_persona"]; ?></td>
            <td><?php echo $row["telefono"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["direccion"]; ?></td>
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

