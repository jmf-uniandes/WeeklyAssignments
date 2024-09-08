<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
TODO: controlador de productos

require_once('../models/proveedores.model.php');
error_reporting(0);
$proveedores = new Productos;

switch ($_GET["op"]) {
        //TODO: operaciones de proveedores

    case 'todos': //TODO: Procedimiento para cargar todos las datos de los proveedores
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase proveedores.model.php
        $datos = $proveedores->todos(); // Llamo al metodo todos de la clase proveedores.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: Procedimiento para obtener un registro de la base de datos
    case 'uno':
        $idProductos = $_POST["idProductos"];
        $datos = array();
        $datos = $proveedores->uno($idProductos);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimiento para insertar un proveedor en la base de datos
    case 'insertar':
        $Codigo_Barras = $_POST["Codigo_Barras"];
        $Nombre_Producto = $_POST["Nombre_Producto"];
        $Graba_IVA = $_POST["Graba_IVA"];


        $datos = array();
        $datos = $proveedores->insertar($Codigo_Barras, $Nombre_Producto, $Graba_IVA);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para actualziar un proveedor en la base de datos
    case 'actualizar':
        $idProductos = $_POST["idProductos"];
        $Codigo_Barras = $_POST["Codigo_Barras"];
        $Nombre_Producto = $_POST["Nombre_Producto"];
        $Graba_IVA = $_POST["Graba_IVA"];
      
        $datos = array();
        $datos = $proveedores->actualizar($idProductos, $Codigo_Barras, $Nombre_Producto, $Graba_IVA);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar un proveedor en la base de datos
    case 'eliminar':
        $idProductos = $_POST["idProductos"];
        $datos = array();
        $datos = $proveedores->eliminar($idProductos);
        echo json_encode($datos);
        break;
}
