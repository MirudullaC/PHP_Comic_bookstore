<?php
//Use FPDF library to prepare an invoice in PDF

//include files
require_once('fpdf184/fpdf.php');
require_once ("../Aleena/user.php");
require_once("invoice_helper.php");

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo        
        $this->Image('../assets/img/logo_comic.png',10,15,40);
        // Line break
       // $this->Ln(20);
        $this->SetFont('Arial','',10);
        // Move to the right
        $this->SetX(140); 
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(242, 129, 35);
        // Title
        $this->Cell(160,6,'Comic Store',0,0,'L');   
        $this->SetFont('Arial','',10);   
        $this->SetTextColor(0, 0, 0);  
        // Line break
        $this->Ln();
        $this->SetX(140); 
        $this->Cell(160,6,'Kitchener, Ontario, N2L 3T6',0,0,'L');
        // Line break
        $this->Ln();
        $this->SetX(140); 
        $this->Cell(160,6,'support@comicstore.com',0,0,'L');
        // Line break
        $this->Ln();
        $this->SetX(140); 
        $this->Cell(160,6,'Phone: +00 111 222 3333',0,0,'L');
        // Line break
        $this->Ln();
        $this->Line(15, 42, 185, 42);
    }

    // Page footer
    function Footer()
    {
        $this->Line(15, 250, 185, 250);
        $this->Ln();
        $this->SetFont('Arial','B',9);
        $this->SetTextColor(0, 0, 128);
        $this->SetY(-45);
        $this->Cell(160,6,'Terms & conditons',0,0,'L');
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial','',8);
        $this->Ln();
        $this->SetX(20);
        $this->Cell(160,6,'We accept returns for damaged or defective items within 3 days of receipt.',0,0,'L');
        $this->Ln();
        $this->SetX(20);
        $this->Cell(160,6,'Refunds will be issued to the original form of payment upon receipt and inspection of returned items.',0,0,'L');
        $this->Ln();
        $this->SetX(20);
        $this->Cell(160,6,'For inquiries or assistance, please contact our customer support team at support@comicstore.com or +00 111 222 3333.',0,0,'L');
        
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial Bold 9
        $this->SetFont('Arial','B',9);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'C');
    }
}
$_SESSION['userID'] =1;
$user = InvoiceHelper::getUserDetails($_SESSION['userID']);
$ord_details = InvoiceHelper::getOrderDetails($_SESSION['userID']);
// create PDF instance


if($user != null)
{
    $pdf = new PDF();
    
    // //footer page
    $pdf->AliasNbPages(); 
    //Add new page 
    $pdf->AddPage();   
    $pdf->SetFont('Arial','B',11);
    // Line break
    $pdf->Ln();
    $pdf->Ln();
    // Position at 2 cm from left
    $pdf->SetX(20);
    $pdf->SetTextColor(0, 0, 128);
    $pdf->Cell(60,7,"Bill To: ",0,0,'L');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetX(20);
    $pdf->SetFont('Arial','',10);
    $pdf->Ln();
    $pdf->SetX(20);
    $pdf->Cell(60,7,$user->getFirstName()." ".$user->getLastName(),0,0,'L');
    $pdf->SetX(140); 
    $pdf->SetFont('Arial','B',10);
    $randomNumber = rand(100, 999);
    $pdf->Cell(60,7,"Invoice No: #INV00".$randomNumber,0,0,'L');
    $pdf->Ln();
    $pdf->SetX(20);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(60,7,$user->getAddr1().", ".$user->getCity(),0,0,'L');
    $pdf->SetX(140);
    $pdf->SetFont('Arial','B',10);
    date_default_timezone_set('America/Toronto');
    $pdf->Cell(60,7,"Invoice Date: ".date('F d, Y'),0,0,'L');
    $pdf->Ln();
    $pdf->SetX(20);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(60,7,"Email: ".$user->getEmail(),0,0,'L');
    $pdf->Ln();
    $pdf->SetX(20);
    $pdf->Cell(60,7,"Phone: ".$user->getPhone(),0,0,'L');
    $pdf->Ln();
    $pdf->Ln();

    $pdf->SetFont('Arial','B',11); 
    
    // Table header
    $pdf->SetX(20); 
    $pdf->SetFillColor(250, 150, 67); // Set fill color for header
    $pdf->Cell(20, 10, 'Sl No', 1, 0, 'C', true); 
    $pdf->Cell(80, 10, 'Book Name', 1, 0, 'C', true); 
    $pdf->Cell(20, 10, 'Unit Price', 1, 0, 'C', true); 
    $pdf->Cell(20, 10, 'Quantity', 1, 0, 'C', true); 
    $pdf->Cell(20, 10, 'Total', 1, 1, 'C', true); 
     $sl_no = 1;
     $total = 0;
     $pdf->SetFont('Arial','',11); 
    foreach ($ord_details as $Item) {
        $pdf->Ln(0);
        $pdf->SetX(20);         
        $pdf->Cell(20, 10, $sl_no, 1, 0, 'C'); 
        $pdf->Cell(80, 10, $Item['bookTitle'], 1, 0, 'C'); 
        $pdf->Cell(20, 10, $Item['price'], 1, 0, 'C'); 
        $pdf->Cell(20, 10, $Item['quantity'], 1, 0, 'C'); 
        $pdf->Cell(20, 10, $Item['price']*$Item['quantity'], 1, 1, 'C'); 
        $sl_no++;
        $total = $total + ($Item['price']*$Item['quantity']);

    }
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetX(120);
    $pdf->SetFont('Arial','B',11);   
    $pdf->Cell(60,8,"Total Amount Payable: $".$total,0,0,'L');
    
    $pdf->Ln(30);
    $pdf->SetTextColor(242, 129, 35);
    $pdf->SetX(80); 
    $pdf->Cell(60,10,"Thank you for the purchase.",0,0,'L');
}


$pdf->Output();
?>
