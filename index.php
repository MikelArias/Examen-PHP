<?php session_start();

//Hacemos que seleccione funciones.php para que use las funciones que hay dentro
require_once("funciones.php");

//Conexion a la base de datos Almacen
$conn = mysqli_connect("db", "root", "test", "Almacen");

// Borrar producto llama a la funcion delproducto si es accionado el boton borrar
if (isset($_GET['accion']) && $_GET['accion'] == 'borrar') {
  delproducto($conn);
}
// Añadir producto llama a la funcion addproducto si es accionado el boton crear
if (isset($_GET['accion']) && $_GET['accion'] == 'crear') {
  addproducto($conn);
}
//Modificar producto llama a la funcion modproducto si es accionado el boton modificar
  if (isset($_GET['accion']) && $_GET['accion'] == 'modificar') {
  modproducto($conn);
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestclient</title>
  
</head>

<body>

  <div style="background-color: lightgreen;">
    <div >
      <h1 >Base de datos de Almacén</h1>
      <h2>Gestión de productos del Almacén </h2>
      
      <table >
        <tr>
          <th>Nombre</th>
          <th>Descripcion</th>
          <th>ID (En decimal)</th>
          <th>Precio (Un digito)</th>
          <th></th>
        </tr>

        <form action="index.php" method="GET">
          <tr>
            <td><input type="text" name="nombre"></td>
            <td><input type="text" name="descripcion"></td>
            <td><input type="text" name="id"></td>
            <td><input type="text" name="precio"></td>
            <input type="hidden" name="accion" value="crear">
            <td><input type="submit" value="Añadir"></td>
          </tr>
        </form>
        <?php
        // Conexion a la base de datos para que se muestre los datos que hay en la tabla de productos
            $statement = $conn->stmt_init();
            $statement->prepare("SELECT * from producto");
            $statement->execute();
            $resultado = $statement->get_result();

            // Si hay resultados los muestra en forma de tabla
            while ($registro = $resultado->fetch_assoc()) {
                echo "<tr>
                    <td>".$registro['nombre']." </td>
                    <td>". $registro['descripcion']." </td>
                    <td>". $registro['id']." </td>
                    <td>". $registro['precio']." </td>
                    <td>
                      <a href=\"modificar.php?&nombre=". $registro['nombre'] ."&descripcion=". $registro['descripcion'] ."&id=". $registro['id'] . "&precio=". $registro['precio']." \">
                        <button >Modificar</button>
                      </a>
                    </td>
                    <td>
                      <a href=\"index.php?accion=borrar&id=". $registro['id']."\">
                        <button>
                          Borrar
                        </button>
                      </a>
                    </td>
                  </tr>"; 

                }
                
        ?>
