<?php
App::import('Vendor','xtcpdf');

$pdf = new XTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->xheadertext='Relatório contendo setores e respectivos militares da divisão de operações     Página '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages();
$pdf->xfootertext='Desenvolvido pelo 1S BET EVALDO <2010>';
$pdf->setFontSubsetting(false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('1S BET Evaldo <2010>');
//$pdf->SetTitle('Lista dos militares da Divisão Operacional');
//$pdf->SetSubject('Somente militares da DO');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData('', '', $cabecalho, PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->setHeaderFont(array('helvetica','',8));
//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
//$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content


// create some HTML content
$cabecalho = '';
$html = '<table border="1" cellspacing="1" cellpadding="0">';
foreach ($militar as $dados){
  if(!($cabecalho == $dados['Militar']['orgao'])){
    $html .= '<tr bgcolor="#0000a0" align="center" ><td width="100%" colspan=4><font color="#ffffff"><b>'.$dados['Militar']['orgao'].'</b></font></td></tr><tr bgcolor="#cccccc" align="center" ><td width="10%">POSTO</td><td width="15%">ESPECIALIDADE</td><td width="55%">NOME COMPLETO</td><td width="20%">NOME GUERRA</td></tr>';

    $cabecalho = $dados['Militar']['orgao'];
  }
  $html .= '<tr><td>'.$dados['Posto']['sigla_posto'].'</td>'.'<td>'.$dados['Quadro']['sigla_quadro'].'-'.$dados['Especialidade']['nm_especialidade'].'</td>'.'<td> '.$dados['Militar']['nm_completo'].'</td>'.'<td> '.$dados['Militar']['nm_guerra'].'</td></tr>';
}
$html .= '</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Print some HTML Cells


// reset pointer to the last page

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print all HTML colors

// add a page

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('lista.pdf', 'I');


?>
