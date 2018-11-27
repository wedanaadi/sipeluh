<?php
 //Define relative path from this script to mPDF
 $nama_file='Data Pelanggan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','libraries/mpdf60/');
//define("_JPGRAPH_PATH", '../mpdf60/graph_cache/src/');

//define("_JPGRAPH_PATH", '../jpgraph/src/');

include(_MPDF_PATH . "mpdf.php");
//include(_MPDF_PATH . "graph.php");

//include(_MPDF_PATH . "graph_cache/src/");

$mpdf=new mPDF('utf-8', 'A4-P'); // Create new mPDF Document

//Beginning Buffer to save PHP variables and HTML tags
ob_start();

$mpdf->useGraphs = true;
include('view/cetak_head.php');
?>

<style type="text/css">
  #TabelKonten tr td {
    padding-right: 7px;
    padding-left:  7px;
    font-size: 12px;
  }
</style>

<div style="margin-buttom : 15px;" >
  <table width="100%" border="0"  >
    <tr>
      <td colspan="2" align="center" style="font-size:14px;"> <strong> LAPORAN ANGGOTA  </strong>  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>

<table id="TabelKonten"  border="1" style="border-collapse: collapse; border-color:#000000; margin-bottom : 130px;"  width="100%"   >
  <tbody>
    <tr>
      <th>NO</th>
      <th>Kode Pelanggan</th>
      <th>Nama Pelanggan</th>
      <th>Alamat</th>
      <th>telepon</th>
      <th>Email</th>
    </tr>
    <?php $i=1; foreach ($pelanggan as $row ) { ?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $row['id'] ?></td>
      <td align="right"><?php echo $row['nama'] ?></td>
       <td align="right"><?php echo $row['alamat'] ?></td>
      <td align="right"><?php echo $row['no_telp']?></td>
      <td align="right"><?php echo $row['email']  ?></td>
    </tr>
   <?php $i++; } ?>



  </tbody>
</table>



<table width="100%" border="0" style="font-size:11px; "  >
    <tr>
      <td width="40%">&nbsp; </td>
      <td >&nbsp; </td>
      <td width="40%">&nbsp; </td>
    </tr>
     <tr>
      <td >&nbsp; </td>
      <td >&nbsp; </td>
      <td >&nbsp; </td>
    </tr>

    <tr>
     <td align="center"><strong>ADMINISTRATOR</strong> </td>
     <td  align="center">&nbsp;</td>
     <td  align="center"><strong>OWNER</strong></td>
    </tr>
    <tr>
       <td >&nbsp; </td>
      <td >&nbsp; </td>
      <td >&nbsp; </td>
    </tr>
    <tr>
      <td >&nbsp; </td>
      <td >&nbsp; </td>
      <td >&nbsp; </td>
    </tr>
    <tr>
       <td >&nbsp; </td>
      <td >&nbsp; </td>
      <td >&nbsp; </td>
    </tr>
     <tr>
      <td >&nbsp; </td>
      <td >&nbsp; </td>
      <td >&nbsp; </td>
    </tr>
    <tr>
      <td >&nbsp; </td>
      <td >&nbsp; </td>
      <td >&nbsp; </td>
    </tr>
     <tr>
     <td align="center"> <hr style="color:#000000"> </td>
     <td align="center"></td>
     <td align="center"> <hr style="color:#000000"></td>
    </tr>


  </table>

<?php

$html = ob_get_contents(); //Proses untuk mengambil data
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
// LOAD a stylesheet
$stylesheet = file_get_contents('mpdfstyletables.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,1);

$mpdf->SetHTMLFooter('
					<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000;; font-style: italic;"><tr>
					<td width="33%" style="Font-size:7px;"> ~CV. Budi Luhur Abadi~ </td>
					<td width="33%" align="right" style="font-weight: bold; ">{PAGENO}/{nbpg}</td>
					</tr></table>');

$mpdf->Output($nama_file."-".$data['no_sj'].".pdf" ,'I');




exit;
?>
</body>
</html>
