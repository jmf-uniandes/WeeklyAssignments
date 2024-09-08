<?php
//TODO: Clase de Kardex
require_once('../config/config.php');
class Provedores
{
    //TODO: Implementar los metodos de la clase

    public function todos() //SELECT * FROM `kardex`
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `kardex`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idkardex)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `kardex` WHERE `idKardex`=$idKardex";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Estado, $Fecha_Transaccion, $Cantidad,$Valor_Compra, $Valor_Venta, $Unidad_Medida_idUnidad_Medida, $Unidad_Medida_idUnidad_Medida1, $Unidad_Medida_idUnidad_Medida2, $Valor_Ganacia, $IVA, $IVA_idIVA, $Proveedores_idProveedores, $Productos_idProductos, $Tipo_Transaccion)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `kardex` ( `Estado`, `Fecha_Transaccion`, `Cantidad`, `Valor_Compra`, `Valor_Venta`, `Unidad_Medida_idUnidad_Medida`, `Unidad_Medida_idUnidad_Medida1`, `Unidad_Medida_idUnidad_Medida2`, `Valor_Ganacia`, `IVA`, `IVA_idIVA`, `Proveedores_idProveedores`, `Productos_idProductos`, `Tipo_Transaccion`) VALUES ('$Estado', '$Fecha_Transaccion', '$Cantidad','$Valor_Compra', '$Valor_Venta', '$Unidad_Medida_idUnidad_Medida', '$Unidad_Medida_idUnidad_Medida1', '$Unidad_Medida_idUnidad_Medida2', '$Valor_Ganacia', '$IVA', '$IVA_idIVA', '$Proveedores_idProveedores', '$Productos_idProductos', '$Tipo_Transaccion')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function actualizar($idKardex,$Estado, $Fecha_Transaccion, $Cantidad,$Valor_Compra, $Valor_Venta, $Unidad_Medida_idUnidad_Medida, $Unidad_Medida_idUnidad_Medida1, $Unidad_Medida_idUnidad_Medida2, $Valor_Ganacia, $IVA, $IVA_idIVA, $Proveedores_idProveedores, $Productos_idProductos, $Tipo_Transaccion)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `kardex`
            SET `Estado`=`$Estado`, `Fecha_Transaccion`=`$Fecha_Transaccion`, `Cantidad`=`$Cantidad`,`Valor_Compra`=`$Valor_Compra`, `Valor_Venta`=`$Valor_Venta`, `Unidad_Medida_idUnidad_Medida`=`$Unidad_Medida_idUnidad_Medida`, `Unidad_Medida_idUnidad_Medida1`=`$Unidad_Medida_idUnidad_Medida1`, `Unidad_Medida_idUnidad_Medida2`=`$Unidad_Medida_idUnidad_Medida2`, `Valor_Ganacia`=`$Valor_Ganacia`, `IVA`=`$IVA`, `IVA_idIVA`=`$IVA_idIVA`, `Proveedores_idProveedores`=`$Proveedores_idProveedores`, `Productos_idProductos`=`$Productos_idProductos`, `Tipo_Transaccion`=`$Tipo_Transaccion`
            WHERE `idKardex` = $idKardex";
            if (mysqli_query($con, $cadena)) {
                return $idKardex;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idkardex)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `kardex` WHERE `idkardex`= $idkardex";
            // echo $cadena;
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
