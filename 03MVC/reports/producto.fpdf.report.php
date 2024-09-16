<?php
require('./fpdf/fpdf.php');

define('iva_value', 0.13);
define('InvoiceNumber', 'No. 001-001-000000001');

class PDF extends FPDF
{
    // Header page
    function Header()
    {
        // Invoice SRI info
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 6, 'Factura', 0, 1, 'R');  // Title
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, InvoiceNumber, 0, 1, 'R');  // # invoice
        $this->Cell(0, 6, iconv('UTF-8', 'windows-1252', 'Fecha de Emisión: ') . date('Y-m-d'), 0, 1, 'R');  // date
        $this->Ln(8); // space

        // Company info
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 8, 'Empresa XYZ', 0, 1, 'L');  //Nam
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 6, 'RUC : 0000000001', 0, 1, 'L');  // RUC
        $this->Cell(0, 6, iconv('UTF-8', 'windows-1252', 'Dirección: 132 Calle A y Calle B, Quito-Ecuador') , 0, 1, 'L');  // Address
        $this->Cell(0, 6, iconv('UTF-8', 'windows-1252', 'Teléfono: +(593) 123-456-7890') , 0, 1, 'L');  // phone 
        $this->Cell(0, 6, 'e-mail: contact@company.com.ec', 0, 1, 'L');  // email
        $this->Ln(5); // space
        
        // Datos del cliente
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 6, 'Datos del Cliente', 0, 1, 'L');  // Encabezado de cliente
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 6, iconv('UTF-8', 'windows-1252', 'Nombre: Jhon Doe') , 0, 1, 'L');  // Client
        $this->Cell(0, 6, iconv('UTF-8', 'windows-1252', 'Cédula | RUC: 1234567890') , 0, 1, 'L');  // ID
        $this->Cell(0, 6, iconv('UTF-8', 'windows-1252', 'Dirección: Calle C ABC, Cuenca-Ecuador') , 0, 1, 'L');  // Address
        $this->Cell(0, 6, iconv('UTF-8', 'windows-1252', 'Teléfono: +(593) 123-456-7890') , 0, 1, 'L');  // phone
        $this->Cell(0, 6, 'e-mail: contact@company.com.ec', 0, 1, 'L');  // email
        $this->Ln(15); // Salto de línea
    }

    // Footer
    function Footer() {
        
        $this->SetY(-70); // front end to up

        // get the info
        global $sub_total, $total_iva, $total_a_pagar;

        // Subtotal
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 6, 'Subtotal: $' . number_format($sub_total, 2), 0, 1, 'R');

        // SUB TOTAL IVA
        $this->Cell(0, 6, 'Sub Total con IVA (13%): $' . number_format($sub_total * iva_value, 2), 0, 1, 'R');
        
        // IVA (13%)
        $this->Cell(0, 6, 'IVA (13%): $' . number_format($total_iva, 2), 0, 1, 'R');
        
        // Total a Pagar
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 6, 'Total a Pagar: $' . number_format($total_a_pagar, 2), 0, 1, 'R');

        // Espacio
        $this->Ln(5);

        // Información de la forma de pago
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 6, 'Forma de pago: Transferencia Bancaria', 0, 1, 'L');
        $this->Cell(0, 6, 'Cuenta Bancaria: Banco de Guayaquil, Cta: 001357934', 0, 1, 'L');

        // Nota
        $this->Ln(5); // Espacio en blanco
        $this->Cell(0, 6, 'Nota: Gracias por preferirnos', 0, 1, 'C');
    }

    // description invoice
    function ProductosTable($header, $data) {
        // header
        $this->SetFont('Arial', 'B', 12);
        foreach ($header as $col) {
            $this->Cell(32, 7, $col, 1,0,'C');
        }
        $this->Ln();

        // info
        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(32, 7, $col, 1);
            }
            $this->Ln();
        }
    }
}

// Crear PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Products selected (sample)
$productos = [
    ['Descripcion' => 'Producto A', 'Cantidad' => 2, 'Precio' => 1000, 'Subtotal' => 2000, 'IVA' => 13, 'Total' => 2000],
    ['Descripcion' => 'Producto B', 'Cantidad' => 4, 'Precio' => 2000, 'Subtotal' => 8000, 'IVA' => 13, 'Total' => 8000],
    ['Descripcion' => 'Producto C', 'Cantidad' => 6, 'Precio' => 3500, 'Subtotal' => 21000, 'IVA' => 13, 'Total' => 21000]
];

// 
$sub_total = 31000;
$valor_iva = iva_value; // from global
$total_iva = ($sub_total * $valor_iva) / 100;
$total_a_pagar = $sub_total + $total_iva;

// Detalles de la factura
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 7, 'Detalles de la Factura:', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, 'Fecha: ' . date('Y-m-d'), 0, 1);
$pdf->Cell(0, 7, 'Sub-total: $' . number_format($sub_total, 2), 0, 1);
$pdf->Cell(0, 7, 'IVA (' . $valor_iva . '%): $' . number_format($total_iva, 2), 0, 1);
$pdf->Cell(0, 7, 'Total a Pagar: $' . number_format($total_a_pagar, 2), 0, 1);
$pdf->Ln(8);

// Encabezados de la tabla
$header = ['Descripcion', 'Cantidad', 'Precio', 'Subtotal', 'IVA', 'Total'];

// Llamar a la función para crear la tabla
$pdf->ProductosTable($header, $productos);

// Guardar el archivo PDF
$pdf->Output('I', 'factura_' . InvoiceNumber . '.pdf');
?>