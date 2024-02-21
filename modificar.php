
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Almacen de productos</title>
</head>

<body>

  <h1>Almacen de productos</h1>
  <h2>Seccion para modificar los datos de un producto</h2>
  <form action="index.php" action="GET">
    Nombre (No se puede modificar):
    <input type="text" name="nombre" value="<?= $_GET['nombre'] ?>">
    Descripcion Nueva: 
    <input type="text" name="descripcion" value="<?= $_GET['descripcion'] ?>">
    ID nuevo: 
    <input type="text" name="id" value="<?= $_GET['id'] ?>">
    Precio nuevo: 
    <input type="text" name="precio" value="<?= $_GET['precio'] ?>">
    <input type="hidden" name="idantiguo" value="<?= $_GET['id'] ?>">
    <input type="hidden" name="accion" value="modificar">
    <br><br>
    <input type="submit" value="Aceptar">
    <a href="index.php">
      <button type="button">Cancelar</button>
    </a>
  </form>
</body>

</html>