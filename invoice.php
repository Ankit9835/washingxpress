<?php
//import pdf
require('fpdf/fpdf.php');

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//$pdf->SetFillColor(123,255,234);

$pdf->SetFont('Arial','B',16);
$pdf->cell(80,10,'Prachi Enterprise.',0,0,'');

$pdf->SetFont('Arial','B',13);
$pdf->cell(112,10,'Invoice',0,1,'C');


$pdf->SetFont('Arial','',8);
$pdf->cell(80,5,'Address : ShivPuri,Boring Rd,  Patna-800020',0,0,'');

$pdf->SetFont('Arial','',10);
$pdf->cell(112,5,'Invoice : #12345',0,1,'C');


$pdf->SetFont('Arial','',8);
$pdf->cell(80,5,'Phone Number : 12345',0,0,'');


$pdf->SetFont('Arial','',10);
$pdf->cell(112,5,'Date : 12-02-19',0,1,'C');


$pdf->SetFont('Arial','',8);
$pdf->cell(80,5,'Email Id : test@gmail.com',0,1,'');
$pdf->cell(80,5,'Website : test@gmail.com',0,1,'');

//Line Method

// (x1,y1,x2,y2)

$pdf->Line(5,45,205,45);
$pdf->Line(5,46,205,46);

//Line Break

$pdf->Ln(10);

$pdf->SetFont('Arial','BI',12);
$pdf->cell(20,10,'Bill To :',0,0,'');

$pdf->SetFont('Courier','BI',12);
$pdf->cell(50,10,'Ankit Sinha',0,1,'');

$pdf->cell(50,5,'',0,1,'');

$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(205,205,205);
$pdf->cell(100,10,'PRODUCT',1,0,'C',true);
$pdf->cell(20,10,'QTY',1,0,'C',true);
$pdf->cell(30,10,'PRICE',1,0,'C',true);
$pdf->cell(40,10,'TOTAL',1,1,'C',true);

$pdf->SetFont('Arial','B',12);
$pdf->cell(100,10,'Laptop',1,0,'L');
$pdf->cell(20,10,'2',1,0,'C');
$pdf->cell(30,10,'50000',1,0,'C');
$pdf->cell(40,10,'50000',1,1,'C');


$pdf->SetFont('Arial','B',12);
$pdf->cell(100,10,'Bag',1,0,'L');
$pdf->cell(20,10,'1',1,0,'C');
$pdf->cell(30,10,'500',1,0,'C');
$pdf->cell(40,10,'500',1,1,'C');


$pdf->SetFont('Arial','B',12);
$pdf->cell(100,10,'Mouse',1,0,'L');
$pdf->cell(20,10,'1',1,0,'C');
$pdf->cell(30,10,'5000',1,0,'C');
$pdf->cell(40,10,'5000',1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(205,205,205);
$pdf->cell(100,10,'',0,'L');
$pdf->cell(20,10,'',0,'C');
$pdf->cell(30,10,'SubTotal',1,0,'C',true);
$pdf->cell(40,10,'5000',1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(205,205,205);
$pdf->cell(100,10,'',0,'L');
$pdf->cell(20,10,'',0,'C');
$pdf->cell(30,10,'Tax',1,0,'C',true);
$pdf->cell(40,10,'50',1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(205,205,205);
$pdf->cell(100,10,'',0,'L');
$pdf->cell(20,10,'',0,'C');
$pdf->cell(30,10,'Discount',1,0,'C',true);
$pdf->cell(40,10,'0',1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(205,205,205);
$pdf->cell(100,10,'',0,'L');
$pdf->cell(20,10,'',0,'C');
$pdf->cell(30,10,'GrandTotal',1,0,'C',true);
$pdf->cell(40,10,'5000',1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(205,205,205);
$pdf->cell(100,10,'',0,'L');
$pdf->cell(20,10,'',0,'C');
$pdf->cell(30,10,'Paid',1,0,'C',true);
$pdf->cell(40,10,'5000',1,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(205,205,205);
$pdf->cell(100,10,'',0,'L');
$pdf->cell(20,10,'',0,'C');
$pdf->cell(30,10,'Due',1,0,'C',true);
$pdf->cell(40,10,'50',1,1,'C');

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(205,205,205);
$pdf->cell(100,10,'',0,'L');
$pdf->cell(20,10,'',0,'C');
$pdf->cell(30,10,'Payment Type',1,0,'C',true);
$pdf->cell(40,10,'Cash',1,1,'C');


$pdf->cell(50,10,'',0,1,'');


$pdf->SetFont('Arial','B',10);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(32,10,'Important Notice :',0,0,'',true);


$pdf->SetFont('Arial','B',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(148,10,'No Item Will Be Replaced Or Refunded.',0,0,'');




$pdf->Output();



?>