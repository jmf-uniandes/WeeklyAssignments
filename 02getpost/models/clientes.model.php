<?php
//TODO: Clase de clientes
require_once('../config/config.php');
class Clientes
{
    //TODO: Implementar los metodos de la clase

    public function todos() //select * from clientes
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `clientes`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idClientes) //select * from clientes id = $id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `clientes` WHERE `idClientes`=$idClientes";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    //insert into provedores (nombre, direccion, telefono, cedula, correo) values ($nombre, $direccion, $telefono,$cedula, $correo)
    public function insertar($Nombres, $Direccion, $Telefono, $Cedula, $Correo)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `clientes` ( `Nombres`, `Direccion`, `Telefono`, `Cedula`, `Correo`) VALUES ('$Nombres','$Direccion','$Telefono','$Cedula','$Correo')";
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
    public function actualizar($idClientes,$Nombres, $Direccion, $Telefono, $Cedula, $Correo) //update provedores set nombre = $nombre, direccion = $direccion, telefono = $telefono where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `clientes` SET `Nombres`='$Nombres',`Direccion`='$Direccion',`Telefono`='$Telefono',`Cedula`='$Cedula',`Correo`='$Correo' WHERE `idClientes` = $idClientes";
            if (mysqli_query($con, $cadena)) {
                return $idClientes;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function eliminar($idClientes) //delete from provedores where id = $id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `clientes` WHERE `idClientes`= $idClientes";
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
