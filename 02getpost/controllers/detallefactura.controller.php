<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
TODO: controlador de Detalle_Factura

require_once('../models/detallefactura.model.php');
error_reporting(0);
$Detalle_Factura = new Detalle_Factura;

switch ($_GET["op"]) {
        //TODO: operaciones de Detalle_Factura

    case 'todos': //TODO: Procedimiento para cargar todos las datos de los Detalle_Factura
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase Detalle_Factura.model.php
        $datos = $Detalle_Factura->todos(); // Llamo al metodo todos de la clase Detalle_Factura.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: Procedimiento para obtener un registro de la base de datos
    case 'uno':
        $idDetalle_Factura = $_POST["idDetalle_Factura"];
        $datos = array();
        $datos = $Detalle_Factura->uno($idDetalle_Factura);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimiento para insertar un proveedor en la base de datos
    case 'insertar':
        $Cantidad = $_POST["Cantidad"];
        $Factura_idFactura = $_POST["Factura_idFactura"];
        $Kardex_idKardex = $_POST["Kardex_idKardex"];
        $Precio_Unitario = $_POST["Precio_Unitario"];
        $Sub_Total_item = $_POST["Sub_Total_item"];

        $datos = array();
        $datos = $Detalle_Factura->insertar($Cantidad, $Factura_idFactura, $Kardex_idKardex, $Precio_Unitario, $Sub_Total_item);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para actualziar un proveedor en la base de datos
    case 'actualizar':
        $idDetalle_Factura = $_POST["idDetalle_Factura"];
        $Cantidad = $_POST["Cantidad"];
        $Factura_idFactura = $_POST["Factura_idFactura"];
        $Kardex_idKardex = $_POST["Kardex_idKardex"];
        $Precio_Unitario = $_POST["Precio_Unitario"];
        $Sub_Total_item = $_POST["Sub_Total_item"];
        
        $datos = array();
        $datos = $Detalle_Factura->actualizar($idDetalle_Factura, $Cantidad, $Factura_idFactura, $Kardex_idKardex, $Precio_Unitario, $Sub_Total_item);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar un proveedor en la base de datos
    case 'eliminar':
        $idDetalle_Factura = $_POST["idDetalle_Factura"];
        $datos = array();
        $datos = $Detalle_Factura->eliminar($idDetalle_Factura);
        echo json_encode($datos);
        break;
}
