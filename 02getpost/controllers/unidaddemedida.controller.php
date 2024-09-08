<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
TODO: controlador de UnidadDeMedida

require_once('../models/unidaddemedida.model.php');
error_reporting(0);
$unidaddemedida = new UnidadDeMedida;

switch ($_GET["op"]) {
        //TODO: operaciones de unidaddemedida

    case 'todos': //TODO: Procedimiento para cargar todos las datos de los unidad de medida
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase unidaddemedida.model.php
        $datos = $unidaddemedida->todos(); // Llamo al metodo todos de la clase unidaddemedida.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticon para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        //TODO: Procedimiento para obtener un registro de la base de datos
    case 'uno':
        $idUnidad_Medida = $_POST["idUnidad_Medida"];

        $datos = array();
        $datos = $unidaddemedida->uno($idUnidad_Medida);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        //TODO: Procedimiento para insertar una unidad de medida en la base de datos
    case 'insertar':
        $Detalle = $_POST["Detalle"];
        $Tipo = $_POST["Tipo"];


        $datos = array();
        $datos = $unidaddemedida->insertar($Detalle, $Tipo);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para actualziar una unidad de medida en la base de datos
    case 'actualizar':
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $Detalle = $_POST["Detalle"];
        $Tipo = $_POST["Tipo"];

        $datos = array();
        $datos = $unidaddemedida->actualizar($idUnidad_Medida, $Detalle, $Tipo);
        echo json_encode($datos);
        break;
        //TODO: Procedimiento para eliminar un proveedor en la base de datos
    case 'eliminar':
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $datos = array();
        $datos = $unidaddemedida->eliminar($idUnidad_Medida);
        echo json_encode($datos);
        break;
}
