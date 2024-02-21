<?php
//Funcion que conecta a la base de datos, no me deja porque no defino $conn y no puedo arreglarlo
function conectarbd($conn){
$conn = mysqli_connect("db", "root", "test", "Almacen");
}
//Borrar un producto
function delproducto($conn){
    if (isset($_GET['accion']) && $_GET['accion'] == 'borrar') {
      $id = $_GET['id'];
      $statement = $conn->stmt_init();
      $statement->prepare('DELETE FROM producto WHERE id= ? ');
      $statement -> bind_param('s',$id);
      $statement->execute();
      echo "Se ha borrado exitosamente la fila con ID: " .$id;
     // $query = mysqli_query($conn, $statement);
     // if(!$query){
       // echo "No se pudo borrar datos.";
     // }
    }
  }
// Modificar un producto
function modproducto ($conn){
    if (isset($_GET['accion']) && $_GET['accion'] == 'modificar') {
      $descripcionnueva = $_GET['descripcion'];
      $idnuevo = $_GET['id'];
      $precionuevo = $_GET['precio'];
      $idantiguo = $_GET['idantiguo'];
      $statement = "UPDATE producto SET  descripcion = '$descripcionnueva', id = '$idnuevo', precio = '$precionuevo' WHERE id = '$idantiguo'";
      $query = mysqli_query($conn, $statement);
      if(!$query){
        echo "No se pudo modificar los datos.";
      }
      else{
        echo "Se modificó: Nueva Descripcion: $descripcionnueva, Nuevo id: $idnuevo, Nuevo Precio: $precionuevo.";
      }
  }
}


//Añadir un producto
      function addproducto($conn){
        if (isset($_GET['accion']) && $_GET['accion'] == 'crear') { 
            $id = $_GET['id'];
            $nombre = $_GET['nombre'];
            
            // Verificar si el nombre del producto ya existe
            $verificar = "SELECT COUNT(*) FROM producto WHERE nombre = ?";
            $statement = $conn->prepare($verificar);
            $statement->bind_param('s', $nombre);
            $statement->execute();
            $count = $statement->get_result()->fetch_row()[0];
           // Si existe el producto con el nombre que diga que ya existe
            if ($count > 0) {
                echo "El producto con Nombre: $nombre ya existe en la base de datos.";
            } else {
              // Introducimos los datos si no existe el producto con ese nombre
                $add = "INSERT INTO producto(nombre, descripcion, id, precio) VALUES (?,?,?,?)";
                $statement = $conn->prepare($add);
                $statement->bind_param('ssss', $_GET['nombre'], $_GET['descripcion'], $_GET['id'], $_GET['precio']);
                $statement->execute();
                echo "Se ha añadido: Nombre: {$_GET['nombre']}, Descripcion: {$_GET['descripcion']}, ID: {$_GET['id']}, Precio: {$_GET['precio']}";
            }
            $statement->close();
          //  $query = mysqli_query($conn, $statement);
           // if(!$query){
            //  echo "No se pudo añadir datos.";
           // }
        }
    }

?>
