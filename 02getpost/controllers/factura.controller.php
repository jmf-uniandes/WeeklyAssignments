<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
TODO: controlador de factura

require_once('../models/factura.model.php');
error_reporting(0);
$factura = new Factura;

switch ($_GET["op"]) {
        //TODO: operaciones de factura

    case 'todos': //TODO: Procedimiento para cargar todos las datos de los factura
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase factura.model.php
        $datos = $factura->todos(); // Llamo al metodo todos de la clase factura.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: Procedimiento para obtener un registro de la base de datos
    case 'uno':
        $idFactura = $_POST["idFactura"];
        $datos = array();
        $datos = $factura->uno($idFactura);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimiento para insertar un proveedor en la base de datos
    case 'insertar':
        $Fecha = $_POST["Fecha"];
        $Sub_total = $_POST["Sub_total"];
        $Sub_total_iva = $_POST["Sub_total_iva"];
        $Valor_IVA = $_POST["Valor_IVA"];
        $Clientes_idClientes = $_POST["Clientes_idClientes"];

        $datos = array();
        $datos = $factura->insertar($Fecha, $Sub_total, $Sub_total_iva, $Valor_IVA, $Clientes_idClientes);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para actualziar un proveedor en la base de datos
    case 'actualizar':
        $idFactura = $_POST["idFactura"];
        $Fecha = $_POST["Fecha"];
        $Sub_total = $_POST["Sub_total"];
        $Sub_total_iva = $_POST["Sub_total_iva"];
        $Valor_IVA = $_POST["Valor_IVA"];
        $Clientes_idClientes = $_POST["Clientes_idClientes"];
        
        $datos = array();
        $datos = $factura->actualizar($idFactura, $Fecha, $Sub_total, $Sub_total_iva, $Valor_IVA, $Clientes_idClientes);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar un proveedor en la base de datos
    case 'eliminar':
        $idFactura = $_POST["idFactura"];
        $datos = array();
        $datos = $factura->eliminar($idFactura);
        echo json_encode($datos);
        break;
}
