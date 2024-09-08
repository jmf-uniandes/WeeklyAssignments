<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
TODO: controlador de IVA

require_once('../models/iva.model.php');
error_reporting(0);
$iva = new Provedores;

switch ($_GET["op"]) {
        //TODO: operaciones de iva

    case 'todos': //TODO: Procedimiento para cargar todos las datos de los iva
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase iva.model.php
        $datos = $iva->todos(); // Llamo al metodo todos de la clase iva.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: Procedimiento para obtener un registro de la base de datos
    case 'uno':
        $idIVA = $_POST["idIVA"];
        $datos = array();
        $datos = $iva->uno($idIVA);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimiento para insertar un proveedor en la base de datos
    case 'insertar':
        $Detalle = $_POST["Detalle"];
        $Direccion = $_POST["Direccion"];
        $Estado = $_POST["Estado"];
        $Valor = $_POST["Valor"];

        $datos = array();
        $datos = $iva->insertar($Detalle, $Direccion, $Estado, $Valor, $Teleofno_Contacto);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para actualziar un proveedor en la base de datos
    case 'actualizar':
        $idIVA = $_POST["idIVA"];
        $Detalle = $_POST["Detalle"];
        $Direccion = $_POST["Direccion"];
        $Estado = $_POST["Estado"];
        $Valor = $_POST["Valor"];

        $datos = array();
        $datos = $iva->actualizar($idIVA, $Detalle, $Direccion, $Estado, $Valor, $Teleofno_Contacto);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar un proveedor en la base de datos
    case 'eliminar':
        $idIVA = $_POST["idIVA"];
        $datos = array();
        $datos = $iva->eliminar($idIVA);
        echo json_encode($datos);
        break;
}
