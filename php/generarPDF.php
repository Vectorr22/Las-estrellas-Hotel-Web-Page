<?php
session_start();
require('../fpdf/fpdf.php');
include("functions.php");
$pdf = new FPDF();
$pdf->AddPage();

$reservation_data = $_SESSION['reservation'];
$pdf->SetFillColor(253,169,79);
$pdf->Rect(10,10,190,5,'F');
$pdf->SetY(20);
// Header
$pdf->SetFont('Arial','B',24);
$pdf->Cell(0,10,"Hotel Las estrellas",0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,10,'Recibo de pago',0,0,'M');
$pdf->Ln();
$pdf->SetFont('Arial','',14);
$date = date('d/m/Y');

$pdf->Ln();
$pdf->Ln();



// Customer details
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'ENVIAR A',0,0,'L');
$pdf->SetX(140);
$pdf->Cell(0,10,'Datos de pedido',0,0,'R');
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$name = $_SESSION['user_data']['user_name'];
$pdf->Cell(0,10,"Cliente: $name",0,0,'L');
$pdf->SetX(140);
$ticket = generarIdentificador(7);
$pdf->Cell(0,10,"Ticket: $ticket",0,0,'R');
$pdf->Ln();
$email = $_SESSION['user_data']['user_email'];
$tel = $_SESSION['user_data']['user_phone'];
$pdf->Cell(0,10,"Tel: $tel",0,0,'L');
$pdf->SetX(140);
$pdf->SetFont('Arial','',12);

// Crear un objeto DateTime con la fecha actual
$fechaAux = DateTime::createFromFormat('d/m/Y', $date);
$fechaAux->modify('+2 weeks');
$fechaVencimiento = $fechaAux->format('d/m/Y');

$pdf->Cell(0,10,"Fecha de pago: $date",0,0,'R');

$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,"Correo: $email",0,0,'L');
$pdf->SetX(140);
$pdf->Cell(0,10,"Fecha Vencimiento: $fechaVencimiento",0,0,'R');
$pdf->Ln();



$prices = get_prices($reservation_data);


$pdf->Ln();
$pdf->SetDrawColor(0,0,0); // Color negro
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal
$pdf->Ln();
$pdf->SetFont('Arial','B',22);
$total = $prices['total'];
$pdf->Cell(0,10,"TOTAL:",0,0,'L');
$pdf->Cell(0,10,"$ $total",0,0,'R');
$pdf->Ln(20); // Espacio después de la línea
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal
$pdf->Ln();
$pdf->Ln();



// Items
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'CANT.',0,0,'L');
$pdf->Cell(60,10,'DESCRIPCION',0,0,'L');
$pdf->Cell(60,10,'PRECIO POR NOCHE',0,0,'L');
$pdf->Cell(40,10,'IMPORTE',0,0,'L');
$pdf->Ln();

$pdf->SetFont('Arial','',12);
$numHabitaciones = $reservation_data['noHabitaciones'];
$pdf->Cell(40,10,"$numHabitaciones",0,0,'L');
$descripcion = $reservation_data['tipo_Habitacion'];
$pdf->Cell(60,10,"Habitacion $descripcion",0,0,'L');
$precio_noche = $prices['precio_noche'];
$pdf->Cell(60,10,"$ $precio_noche",0,0,'L');
$coste_habitaciones = $prices['coste_habitaciones'];
$pdf->Cell(40,10,"$ $coste_habitaciones",0,0,'L');
$pdf->Ln(30);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'Estadia',0,0,'L');
$pdf->SetFont('Arial','',12);
$noches = $prices['noches'];
$dias = $noches+1;
$pdf->Cell(40,10,"$noches noches, $dias dias",0,0,'L');


$pdf->Ln(30);



$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'Subtotal',0,0,'L');
$pdf->SetFont('Arial','',12);
$subtotal_habitaciones = $prices['subtotal_habitaciones'];
$pdf->Cell(10,10,"$ $subtotal_habitaciones",0,0,'L');
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'IVA',0,0,'L');
$pdf->SetFont('Arial','',12);
$iva = $prices['iva'];
$pdf->Cell(40,10,"$ $iva",0,0,'L');
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,"TOTAL",0,0,'L');
$total = $prices['total'];
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,"$ $total",0,0,'L');

//$pdf->Rect(10,10,190,5,'F');
$pdf->Rect(10, 280, 190, 5, 'F');



$pdf->Output();