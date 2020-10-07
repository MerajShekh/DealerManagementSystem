<?php
// Fetch Data
$con = mysqli_connect("localhost","root","","cargo_honda");
$invoiceno = $_GET['Invoice_No'];
if ($con) {
  $query = "SELECT * FROM Invoice i INNER JOIN Booking b ON i.Booking_No = b.Booking_No INNER JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN dse ON dse.DSE_Id = e.DSE_Id INNER JOIN Customer c ON e.Customer_Id = c.Customer_Id LEFT JOIN financier f ON e.F_Id = f.F_Id INNER JOIN Product p ON p.Product_Id = e.Product_Id INNER JOIN color ON color.Color_Id = p.Color_Id INNER JOIN Vehicle v ON v.Product = CONCAT(p.Model_Code,p.Model_Type,color.Color_Code) WHERE Invoice_No = '$invoiceno'";
  $result = mysqli_query($con,$query);
  $data = mysqli_fetch_assoc($result);
  $invoicedata = $data['Invoice_Date'];

  // echo json_encode($data);

}


// Include the main TCPDF library (search for installation path).
require_once('assets/TCPDF-master/tcpdf.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle("Invoice Copy");
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'B', 14);

// add a page
$pdf->AddPage();

$pdf->setX(90);
$pdf->setY(28,false);
$pdf->Cell(30, 5, 'Tax Invoice');
// Draw Line
$pdf->SetFont('times', 'B', 10);
$pdf->setX(12);
$pdf->setY(37,false);
$pdf->Line(10,36,200,36);
$pdf->Line(10,36,10,261);
$pdf->Line(200,36,200,261);
$pdf->Line(10,44,200,44);
$pdf->Line(100,36,100,136);
$pdf->Line(10,96,200,96);
$pdf->Line(10,136,200,136);
$pdf->Line(10,143,200,143);
// $pdf->Line(10,261,200,261);
// Dealer name
$pdf->Cell(30, 5, 'Dealer Name:');
$pdf->Cell(0, 5,"CARGO MOTORS PVT LTD",0);

$pdf->Ln();
$pdf->setX(12);
$pdf->setY(44,false);
$pdf->Cell(30, 5, 'Address :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"PLOT NO.351, SECTOR 12B,\nTAGORE ROAD, GANDHIDHAM\nGujarat 370201",0,"L");
// $pdf->Ln();
$pdf->setX(12);
// $pdf->setY(32,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Phone :');
// set font
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"2836227594",0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Email :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"hondagdm@cargomotors.co.in",0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'GSTIN No. :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"24AAACC2744C2ZA",0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'PAN No. :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"AAACC2744C",0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'State :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"Gujarat",0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'State Code :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"24",0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Tollfree No. :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"9979339111",0,"L");

$pdf->setX(102);
$pdf->setY(37,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(20, 5, 'Invoice No. :');
$pdf->SetFont('times', '', 9.5);
$pdf->Cell(47, 5,$data['Invoice_No'],0);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(10, 5,"Date:");
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 5,$invoicedata);

$pdf->setX(102);
$pdf->setY(44,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Salesman Name :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$data['DSE_F_Name']." ".$data['DSE_L_Name'],0,"L");

$pdf->setX(102);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Mobile No. :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$data['DSE_Mobile'],0,"L");

$pdf->Line(100,55,200,55);
$pdf->setX(102);
$pdf->setY(56,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Details of Recipient :',0,1);

$pdf->setX(102);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Name :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$data['First_Name']." ".$data['Last_Name'],0,"L");

$pdf->setX(102);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Address :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$data['Address1']." ".$data['Address2']." ".$data['Pin_Code'],0,"L");

$pdf->setX(102);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'State :');
$pdf->SetFont('times', '', 10);
$pdf->Cell(30, 5, 'Gujarat',0,0);

$pdf->setX(160);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(22, 5, 'State Code :');
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 5, '24',0,1);

$pdf->setX(102);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'GSTIN :');
$pdf->SetFont('times', '', 10);
$pdf->Cell(30, 5, '',0,1);

$pdf->setX(102);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Mobile :');
$pdf->SetFont('times', '', 10);
$pdf->Cell(30, 5, $data['Mobile'],0,1);

$pdf->setX(102);
$pdf->setY(96,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Address of Delivery :',0,1);

$pdf->setX(102);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Dealer Name :');
$pdf->MultiCell(0, 5,"CARGO MOTORS PVT LTD",0,"L");

$pdf->setX(102);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Address :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"PLOT NO.351, WARD 12B,\nTAGORE ROAD, GANDHIDHAM\nGujarat 370201",0,"L");

$pdf->setX(102);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'State :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"Gujarat",0,"L");

$pdf->setX(102);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'State Code :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"24",0,"L");

$pdf->setX(12);
$pdf->setY(96,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Enquiry Category :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$data['Enquiry_Category'],0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Booking No. :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$data['Booking_No'],0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Battery No. :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$data['Battery_No'],0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Booklet No. :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,"",0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Purchase Type :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$data['Purchase_Type'],0,"L");

$pdf->setX(12);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, 'Key No. :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$data['Key_No'],0,"L");

$pdf->setX(12);
$pdf->setY(137,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(35, 5, 'Hypothecation With :');
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$data['F_Name'],0,"L");

$pdf->setX(15);
$pdf->setY(144,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(30, 5, "Model");
$pdf->Cell(30, 5, 'HSN Code');
$pdf->Cell(30, 5, 'Type');
$pdf->Cell(30, 5, 'Color');
$pdf->Cell(32, 5, 'Frame No.');
$pdf->Cell(30, 5, 'Engine No.');
$pdf->Ln(6);
$pdf->setX(12);
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5, $data['Model_Name']."\n(".$data['Model_Code'].")",0,1);
$pdf->setX(45);
$pdf->setY(151,false);
$pdf->MultiCell(0, 5, "");
$pdf->setX(65);
$pdf->setY(151,false);
$pdf->SetFont('times', '', 9.5);
$pdf->MultiCell(35, 5, $data['Model_Type']."/".$data['Model_Variant'],0,"C");
$pdf->setX(100);
$pdf->setY(151,false);
$pdf->SetFont('times', '', 9.5);
$pdf->MultiCell(30, 5, $data['Color_Name'],0,"C");
$pdf->setX(130);
$pdf->setY(151,false);
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(38, 5, $data['Frame_No'],0,"C");
$pdf->setX(167);
$pdf->setY(151,false);
$pdf->MultiCell(30, 5, $data['Engine_No'],0,"C");

$pdf->Line(10,161,200,161);

$pdf->setX(10);
$pdf->setY(167,false);

$html = '<table border="1" width="696">
    <tr>
      <th align="center" width="20%">Description</th>
      <th align="center" width="10%">Qty</th>
      <th align="center" width="10%">UOM</th>
      <th align="center" width="20%">Unit Price (Rs)</th>
      <th align="center">Tax%</th>
      <th align="center" width="20%">Amount(Rs)</th>
    </tr>
    <tr>
      <th align="center">Basic Price</th>
      <td align="center">1</td>
      <td align="center">Nos</td>
      <td align="center">'.$data['Booking_Basic_Price'].'</td>
      <td align="center"></td>
      <td align="center">'.$data['Booking_Basic_Price'].'</td>
    </tr>
    <tr>
      <th align="center">Discount</th>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center">'.$data['Booking_Discount_Value'].'</td>
    </tr>
    <tr>
      <th align="center">Taxable Amount</th>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center">'.$data['Booking_Taxable_Price'].'</td>
    </tr>
    <tr>
      <th align="center">IGST</th>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center">0.00 %</td>
      <td align="center">0.00</td>
    </tr>
    <tr>
      <th align="center">CGST</th>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center">'.$data['Booking_CGST_Rate'].' %</td>
      <td align="center">'.$data['Booking_CGST_Value'].'</td>
    </tr>
    <tr>
      <th align="center">SGST</th>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center">'.$data['Booking_SGST_Rate'].' %</td>
      <td align="center">'.$data['Booking_SGST_Value'].'</td>
    </tr>
    <tr>
      <th align="center">Ex Showroom Price(Rs)</th>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center"></td>
      <td align="center">'.$data['Booking_Ex_Price'].'</td>
    </tr>
    <tr>
      <th align="center">Total Amount</th>
      <td colspan="4" align="center"></td>
      <td align="center"><b>'.round($data['Booking_Ex_Price']).'.00</b></td>
    </tr>
    
</table>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Line(10,216,200,216);
$pdf->Line(10,221,200,221);

$pdf->setX(40);
$pdf->setY(235,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(25, 5, 'Declaration :',0,2);
$pdf->Line(100,221,100,241);

$pdf->setX(105);
$pdf->setY(222,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(25, 5, 'For    CARGO MOTORS PVT LTD',0,2);

$pdf->setX(135);
$pdf->setY(235,false);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(25, 5, 'Authorized Signatory',0,2);
$pdf->Line(100,221,100,241);


$pdf->Line(10,241,200,241);

$pdf->setX(12);
$pdf->setY(241,false);
$pdf->SetFont('times', 'B', 10);
$txt = 'I/We hereby certify that my/our registration certificate under the GANDHIDHAM Jurisdiction is in force on the date on which the sale of goods specified in this Tax Invoice is made by me/us and that the transaction in the turnover of sales while filling of the return and the due tax, if any payable on the sale has been paid or shall be paid.';
$pdf->Cell(25, 5, 'Declaration :',0,2);
$pdf->SetFont('times', '', 10);
$pdf->MultiCell(0, 5,$txt,0,"L");

$pdf->Line(10,261,200,261);






// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($data['Invoice_No'].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
