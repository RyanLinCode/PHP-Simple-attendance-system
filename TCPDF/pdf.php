<?php
    include("../library/mysql.inc.php");
    session_start();
    $emp_no = $_SESSION['e_no'];
    //月份
    $Month= date('Y 年 m 月', strtotime(date("Y 年 m 月")));
    $Year=date("Y_M").'_Attendance Sheet.pdf';
    //當天
    //$Today = date('Y-m-d');
    $Today = '2021-04-31';
    //當月第一天
    $BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
    //當月最後一天
    $EndDate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
    //$EndDate= '2021-04-30';
    $Range = round((strtotime($Today)-strtotime($BeginDate))/3600/24)+1;

    //使用【打卡日期】排序, 查詢 card_record 資料表的所有資料
    $sql ="SELECT * FROM card_record
            where emp_no='$emp_no' and 
            card_date between '$BeginDate' and '$EndDate'
            order by card_date , emp_no" ;
    $result=mysqli_query($conn, $sql);
    //如果查到的記錄筆數大於 0, 便使用迴圈顯示所有資料

    $date_ans = array();

    $j=0;
    $z=0;
    //計算當月週末數字
    for ( $i=0 ; $i<$Range ; $i++ ) {
        $BeginDate2 = date('Y-m-d', strtotime(date("Y-m-$j"))+86400);
        // 日期中文化
        $weekday = date('w', strtotime($BeginDate2));
        $weekday2 = '星期' . ['日', '一', '二', '三', '四', '五', '六'][$weekday];
        array_push($date_ans, $weekday2); 

        $j++;
        if ($weekday2 == '星期六'){
            $z++;
        }else if($weekday2 == '星期日'){
            $z++;
        }
    }
    $Range2 = $Range-$z;
?>
<?php
// Include the main TCPDF library (search for installation path).
require_once('E:\coding\xmapp\htdocs\emp\TCPDF\tcpdf.php');



// Extend the TCPDF class to create custom Header and Footer
// 自訂頁首與頁尾
class MYPDF extends TCPDF {
    //Page header
    public function Header() {
        // Set font
        $this->SetFont('msungstdlight', '', 10);

        // 公司與報表名稱
        $title = '
<h4 style="font-size: 25pt; font-weight: normal; text-align: center;">簡易人員簽到表</h4>

<table>
    <tr>
        <td style="width: 25%;"></td>
        <td style="border-bottom: 2px solid black; font-size: 20pt; font-weight: normal; text-align: center; width: 45%;">員工：'.$_SESSION['name'].'　'.date('Y年m月') .'簽到表</td>
        <td style="width: 30%;"></td>
    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
</table>';


        /**
         * 標題欄位
         *
         * 所有欄位的 width 設定值均與「資料欄位」互相對應，除第一個 <td> width 須向左偏移 5px，才能讓後續所有「標題欄位」與「資料欄位」切齊
         * 最後一個 <td> 必須設定 width: auto;，才能將剩餘寬度拉至最寬
         * style 屬性可使用 text-align: left|center|right; 來設定文字水平對齊方式
         */


        // 設定不同頁要顯示的內容 (數值為對應的頁數)
        switch ($this->getPage()) {
            case '1':
                // 設定資料與頁面上方的間距 (依需求調整第二個參數即可)
                $this->SetMargins(1, 52, 1);

                // 增加列印日期的資訊
                $html = $title . '
<table cellpadding="1">
    <tr>
        <td>列印時間：' . date('Y-m-d') . ' ' . date ("H:i:s" , mktime(date('H')+6, date('i'), date('s'))) . '</td>
        <td></td>
        <td></td>
        <td></td>         
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
            <td $style>日期</td>
            <td $style>姓名</td>
            <td $style>簽到時間</td>
            <td $style>簽退時間</td>
    </tr>
</table>';
                break;
            // 其它頁
            default:
                $this->SetMargins(1, 52, 1);
                $html = $title . '
<table cellpadding="1">
    <tr>
        <td>列印時間：' . date('Y-m-d') . ' ' . date ("H:i:s" , mktime(date('H')+6, date('i'), date('s'))) . '</td>
        <td></td>
        <td></td>
        <td></td>         
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
            <td $style2>日期</td>
            <td $style2>姓名</td>
            <td $style2>簽到時間</td>
            <td $style2>簽退時間</td>
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
$pdf->SetTitle('簡易人員打卡簽到表');
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
// 版面配置 > 邊界
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(1, 1, 1);

// 頁首上方與頁面頂端的距離
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// 頁尾上方與頁面底端的距離
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
// 自動分頁
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
// 中文字體名稱, 樣式 (B 粗, I 斜, U 底線, D 刪除線, O 上方線), 字型大小 (預設 12pt), 字型檔, 使用文字子集 
$pdf->SetFont('msungstdlight', '', 10);

// Add a page
// This method has several options, check the source code documentation for more information.
// 版面配置：P 直向 | L 橫向, 紙張大小 (必須大寫字母)
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
// 下載 PDF 的檔案名稱 (不可取中文名，即使有也會自動省略中文名)
$pdf->Output($Year, 'I');