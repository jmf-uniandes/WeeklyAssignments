<?php
//TODO: Clase de DetalleFactura
require_once('../config/config.php');
class Detalle_Factura
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from detalle_factura
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `detalle_factura`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idDetalle_Factura) //select * from detalle_factura where id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `detalle_factura` WHERE `idDetalle_Factura`=$idDetalle_Factura";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Cantidad, $Factura_idFactura, $Kardex_idKardex, $Precio_Unitario, $Sub_Total_item)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `detalle_factura` ( `Cantidad`, `Factura_idFactura`, `Kardex_idKardex`, `Precio_Unitario`, `Sub_Total_item`) VALUES ('$Cantidad', '$Factura_idFactura', '$Kardex_idKardex', '$Precio_Unitario', '$Sub_Total_item')";
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
    public function actualizar($idDetalle_Factura, $Cantidad, $Factura_idFactura, $Kardex_idKardex, $Precio_Unitario, $Sub_Total_item)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `detalle_factura` SET `Cantidad`='$Cantidad',`Factura_idFactura`='$Factura_idFactura',`Kardex_idKardex`='$Kardex_idKardex',`Precio_Unitario`='$Precio_Unitario',`Sub_Total_item`='$Sub_Total_item' WHERE `idDetalle_Factura` = $idDetalle_Factura";
            if (mysqli_query($con, $cadena)) {
                return $idDetalle_Factura;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idDetalle_Factura) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `detalle_factura` WHERE `idDetalle_Factura`= $idDetalle_Factura";
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
