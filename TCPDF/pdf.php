<?php
//============================================================+
// File name   : tcpdf.php
// Version     : 6.3.2
// Begin       : 2002-08-03
// Last Update : 2019-09-20
// Author      : Nicola Asuni - Tecnick.com LTD - www.tecnick.com - info@tecnick.com
// License     : GNU-LGPL v3 (http://www.gnu.org/copyleft/lesser.html)
// -------------------------------------------------------------------
// Copyright (C) 2002-2019 Nicola Asuni - Tecnick.com LTD
//
// This file is part of TCPDF software library.
//
// TCPDF is free software: you can redistribute it and/or modify it
// under the terms of the GNU Lesser General Public License as
// published by the Free Software Foundation, either version 3 of the
// License, or (at your option) any later version.
//
// TCPDF is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU Lesser General Public License for more details.
//
// You should have received a copy of the License
// along with TCPDF. If not, see
// <http://www.tecnick.com/pagefiles/tcpdf/LICENSE.TXT>.
//
// See LICENSE.TXT file for more information.
// -------------------------------------------------------------------
//
// Description :
//   This is a PHP class for generating PDF documents without requiring external extensions.
//
// NOTE:
//   This class was originally derived in 2002 from the Public
//   Domain FPDF class by Olivier Plathey (http://www.fpdf.org),
//   but now is almost entirely rewritten and contains thousands of
//   new lines of code and hundreds new features.
//
// Main features:
//  * no external libraries are required for the basic functions;
//  * all standard page formats, custom page formats, custom margins and units of measure;
//  * UTF-8 Unicode and Right-To-Left languages;
//  * TrueTypeUnicode, TrueType, Type1 and CID-0 fonts;
//  * font subsetting;
//  * methods to publish some XHTML + CSS code, Javascript and Forms;
//  * images, graphic (geometric figures) and transformation methods;
//  * supports JPEG, PNG and SVG images natively, all images supported by GD (GD, GD2, GD2PART, GIF, JPEG, PNG, BMP, XBM, XPM) and all images supported via ImageMagick (http://www.imagemagick.org/www/formats.html)
//  * 1D and 2D barcodes: CODE 39, ANSI MH10.8M-1983, USD-3, 3 of 9, CODE 93, USS-93, Standard 2 of 5, Interleaved 2 of 5, CODE 128 A/B/C, 2 and 5 Digits UPC-Based Extension, EAN 8, EAN 13, UPC-A, UPC-E, MSI, POSTNET, PLANET, RMS4CC (Royal Mail 4-state Customer Code), CBC (Customer Bar Code), KIX (Klant index - Customer index), Intelligent Mail Barcode, Onecode, USPS-B-3200, CODABAR, CODE 11, PHARMACODE, PHARMACODE TWO-TRACKS, Datamatrix, QR-Code, PDF417;
//  * JPEG and PNG ICC profiles, Grayscale, RGB, CMYK, Spot Colors and Transparencies;
//  * automatic page header and footer management;
//  * document encryption up to 256 bit and digital signature certifications;
//  * transactions to UNDO commands;
//  * PDF annotations, including links, text and file attachments;
//  * text rendering modes (fill, stroke and clipping);
//  * multiple columns mode;
//  * no-write page regions;
//  * bookmarks, named destinations and table of content;
//  * text hyphenation;
//  * text stretching and spacing (tracking);
//  * automatic page break, line break and text alignments including justification;
//  * automatic page numbering and page groups;
//  * move and delete pages;
//  * page compression (requires php-zlib extension);
//  * XOBject Templates;
//  * Layers and object visibility.
//  * PDF/A-1b support
//============================================================+

/**
 * @file
 * This is a PHP class for generating PDF documents without requiring external extensions.<br>
 * TCPDF project (http://www.tcpdf.org) was originally derived in 2002 from the Public Domain FPDF class by Olivier Plathey (http://www.fpdf.org), but now is almost entirely rewritten.<br>
 * <h3>TCPDF main features are:</h3>
 * <ul>
 * <li>no external libraries are required for the basic functions;</li>
 * <li>all standard page formats, custom page formats, custom margins and units of measure;</li>
 * <li>UTF-8 Unicode and Right-To-Left languages;</li>
 * <li>TrueTypeUnicode, TrueType, Type1 and CID-0 fonts;</li>
 * <li>font subsetting;</li>
 * <li>methods to publish some XHTML + CSS code, Javascript and Forms;</li>
 * <li>images, graphic (geometric figures) and transformation methods;
 * <li>supports JPEG, PNG and SVG images natively, all images supported by GD (GD, GD2, GD2PART, GIF, JPEG, PNG, BMP, XBM, XPM) and all images supported via ImageMagick (http://www.imagemagick.org/www/formats.html)</li>
 * <li>1D and 2D barcodes: CODE 39, ANSI MH10.8M-1983, USD-3, 3 of 9, CODE 93, USS-93, Standard 2 of 5, Interleaved 2 of 5, CODE 128 A/B/C, 2 and 5 Digits UPC-Based Extension, EAN 8, EAN 13, UPC-A, UPC-E, MSI, POSTNET, PLANET, RMS4CC (Royal Mail 4-state Customer Code), CBC (Customer Bar Code), KIX (Klant index - Customer index), Intelligent Mail Barcode, Onecode, USPS-B-3200, CODABAR, CODE 11, PHARMACODE, PHARMACODE TWO-TRACKS, Datamatrix, QR-Code, PDF417;</li>
 * <li>JPEG and PNG ICC profiles, Grayscale, RGB, CMYK, Spot Colors and Transparencies;</li>
 * <li>automatic page header and footer management;</li>
 * <li>document encryption up to 256 bit and digital signature certifications;</li>
 * <li>transactions to UNDO commands;</li>
 * <li>PDF annotations, including links, text and file attachments;</li>
 * <li>text rendering modes (fill, stroke and clipping);</li>
 * <li>multiple columns mode;</li>
 * <li>no-write page regions;</li>
 * <li>bookmarks, named destinations and table of content;</li>
 * <li>text hyphenation;</li>
 * <li>text stretching and spacing (tracking);</li>
 * <li>automatic page break, line break and text alignments including justification;</li>
 * <li>automatic page numbering and page groups;</li>
 * <li>move and delete pages;</li>
 * <li>page compression (requires php-zlib extension);</li>
 * <li>XOBject Templates;</li>
 * <li>Layers and object visibility;</li>
 * <li>PDF/A-1b support.</li>
 * </ul>
 * Tools to encode your unicode fonts are on fonts/utils directory.</p>
 * @package com.tecnick.tcpdf
 * @author Nicola Asuni
 * @version 6.3.2
 */
    include("../library/mysql.inc.php");
    session_start();
    $emp_no = $_SESSION['e_no'];
    //??????
    $Month= date('Y ??? m ???', strtotime(date("Y ??? m ???")));
    $Year=date("Y_M").'_Attendance Sheet.pdf';
    //??????
    //$Today = date('Y-m-d');
    $Today = '2021-04-31';
    //???????????????
    $BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
    //??????????????????
    $EndDate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
    //$EndDate= '2021-04-30';
    $Range = round((strtotime($Today)-strtotime($BeginDate))/3600/24)+1;

    //??????????????????????????????, ?????? card_record ????????????????????????
    $sql ="SELECT * FROM card_record
            where emp_no='$emp_no' and 
            card_date between '$BeginDate' and '$EndDate'
            order by card_date , emp_no" ;
    $result=mysqli_query($conn, $sql);
    //????????????????????????????????? 0, ?????????????????????????????????

    $date_ans = array();

    $j=0;
    $z=0;
    //????????????????????????
    for ( $i=0 ; $i<$Range ; $i++ ) {
        $BeginDate2 = date('Y-m-d', strtotime(date("Y-m-$j"))+86400);
        // ???????????????
        $weekday = date('w', strtotime($BeginDate2));
        $weekday2 = '??????' . ['???', '???', '???', '???', '???', '???', '???'][$weekday];
        array_push($date_ans, $weekday2); 

        $j++;
        if ($weekday2 == '?????????'){
            $z++;
        }else if($weekday2 == '?????????'){
            $z++;
        }
    }
    $Range2 = $Range-$z;
?>
<?php
// Include the main TCPDF library (search for installation path).
require_once('E:\coding\xmapp\htdocs\emp\TCPDF\tcpdf.php');



// Extend the TCPDF class to create custom Header and Footer
// ?????????????????????
class MYPDF extends TCPDF {
    //Page header
    public function Header() {
        // Set font
        $this->SetFont('msungstdlight', '', 10);

        // ?????????????????????
        $title = '
<h4 style="font-size: 25pt; font-weight: normal; text-align: center;">?????????????????????</h4>

<table>
    <tr>
        <td style="width: 25%;"></td>
        <td style="border-bottom: 2px solid black; font-size: 20pt; font-weight: normal; text-align: center; width: 45%;">?????????'.$_SESSION['name'].'???'.date('Y???m???') .'?????????</td>
        <td style="width: 30%;"></td>
    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
</table>';


        /**
         * ????????????
         *
         * ??????????????? width ???????????????????????????????????????????????????????????? <td> width ??????????????? 5px?????????????????????????????????????????????????????????????????????
         * ???????????? <td> ???????????? width: auto;????????????????????????????????????
         * style ??????????????? text-align: left|center|right; ?????????????????????????????????
         */


        // ????????????????????????????????? (????????????????????????)
        switch ($this->getPage()) {
            case '1':
                // ???????????????????????????????????? (????????????????????????????????????)
                $this->SetMargins(1, 52, 1);

                // ???????????????????????????
                $html = $title . '
<table cellpadding="1">
    <tr>
        <td>???????????????' . date('Y-m-d') . '???' . date ("H:i:s" , mktime(date('H')+6, date('i'), date('s'))) . '</td>
        <td></td>
        <td></td>
        <td></td>         
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
            <td $style>??????</td>
            <td $style>??????</td>
            <td $style>????????????</td>
            <td $style>????????????</td>
    </tr>
</table>';
                break;
            // ?????????
            default:
                $this->SetMargins(1, 52, 1);
                $html = $title . '
<table cellpadding="1">
    <tr>
        <td>???????????????' . date('Y-m-d') . '???' . date ("H:i:s" , mktime(date('H')+6, date('i'), date('s'))) . '</td>
        <td></td>
        <td></td>
        <td></td>         
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
            <td $style2>??????</td>
            <td $style2>??????</td>
            <td $style2>????????????</td>
            <td $style2>????????????</td>
        </tr>
</table>';
        }
        
        // Title
        $this->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('???????????????????????????');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// ???????????? > ??????
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(1, 1, 1);

// ????????????????????????????????????
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// ????????????????????????????????????
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
// ????????????
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
// $pdf->SetFont('dejavusans', '', 14, '', true);
// ??????????????????, ?????? (B ???, I ???, U ??????, D ?????????, O ?????????), ???????????? (?????? 12pt), ?????????, ?????????????????? 
$pdf->SetFont('msungstdlight', '', 10);

// Add a page
// This method has several options, check the source code documentation for more information.
// ???????????????P ?????? | L ??????, ???????????? (??????????????????)
$pdf->AddPage('P', 'LETTER');


$array_ans = array();
while ($row = mysqli_fetch_array($result)) {
        array_push($array_ans, $row['card_date']); 
        array_push($array_ans, $row['card_week']);
        array_push($array_ans, $row['card_name']); 
        array_push($array_ans, $row['begin_time']); 
        array_push($array_ans, $row['end_time']);  
      }

$j=0;
$style = 'style="border-top: 1px solid black;"';



for ( $i=0 ; $i<$Range2 ; $i++ ) {
    $html2 = "
        <tr>
            <td>{$array_ans[$j]}-{$array_ans[$j+1]}</td>
            <td>{$array_ans[$j+2]}</td>
            <td>{$array_ans[$j+3]}</td>
            <td >{$array_ans[$j+4]}</td>
        </tr>
    ";
    $html2 = '<table cellpadding="1">' . $html2 . '</table>';
      $pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);
    $j = $j + 5;
    // $html3 = "
    //     <tr>
    //         <td>{$array_ans[$j+5]}-{$array_ans[$j+6]}</td>
    //         <td>{$array_ans[$j+7]}</td>
    //         <td>{$array_ans[$j+8]}</td>
    //         <td>{$array_ans[$j+9]}</td>
    //     </tr>
    // ";
    // $html3 = '<table cellpadding="1">' . $html3 . '</table>';
    // $pdf->writeHTMLCell(0, 0, '', '', $html3, 0, 1, 0, true, '', true);

    // $html4 = "
    //     <tr>
    //         <td>{$array_ans[$j+10]}-{$array_ans[$j+11]}</td>
    //         <td>{$array_ans[$j+12]}</td>
    //         <td>{$array_ans[$j+13]}</td>
    //         <td>{$array_ans[$j+14]}</td>
    //     </tr>
    // ";
    // $html4 = '<table cellpadding="1">' . $html4 . '</table>';
    // $pdf->writeHTMLCell(0, 0, '', '', $html4, 0, 1, 0, true, '', true);

    // $html5 = "
    //     <tr>
    //         <td>{$array_ans[$j+15]}-{$array_ans[$j+16]}</td>
    //         <td>{$array_ans[$j+17]}</td>
    //         <td>{$array_ans[$j+18]}</td>
    //         <td>{$array_ans[$j+19]}</td>
    //     </tr>
    // ";
    // $html5 = '<table cellpadding="1">' . $html5 . '</table>';
    // $pdf->writeHTMLCell(0, 0, '', '', $html5, 0, 1, 0, true, '', true);
    // $j = $j + 20; 
}

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
// ?????? PDF ??????????????? (?????????????????????????????????????????????????????????)
$pdf->Output($Year, 'I');