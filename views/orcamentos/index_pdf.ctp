<?php
App::import('Vendor','xtcpdf');

$pdf = new XTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->xheadertext='Controle de chamadas do efetivo - gerado em '.date('d-m-Y h:i:s').' por '.$u[0][0]['nome'].'   Página '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages();
$pdf->xfootertext= $pdf->xheadertext.'            Desenvolvido pelo SO BET EVALDO <2014>';
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

$pdf->setHeaderFont(array('helvetica','',6));
//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(10, 10, 10);
//$pdf->SetHeaderMargin(10);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);
//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 20);

//set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
//$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 6);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content


// create some HTML content
$cabecalho = '';
$html = '<table border="1" cellspacing="0" cellpadding="0">';
$html .= '<tr bgcolor="#0000a0" align="center" ><td width="100%" colspan=10><font face="Helvetica" size="8px" color="white"><b>CHAMADA '.$militar[0]['Chamada']['divisao'].'->'.$militar[0]['Chamada']['nome_chamada'].'('.date('d-m-Y',strtotime($militar[0]['Chamada']['dia'])).')</b></font></td></tr>';
$html .= '<tr bgcolor="#cccccc" align="center" ><td width="46%" rowspan="2">NOME COMPLETO</td><td width="3%" colspan="2">INI</td><td width="24%" rowspan="2">JUSTIFICATIVA INÍCIO</td><td width="3%" colspan="2">TER</td><td width="24%" rowspan="2">JUSTIFICATIVA TÉRMINO</td></tr>';
$html .= '<tr bgcolor="#cccccc" align="center" ><td width="3%" colspan="2">P/F</td><td width="3%" colspan="2">P/F</td></tr>';
$i=0;
$faltasinicio=0;
$presencasinicio=0;
$faltastermino=0;
$presencastermino=0;

foreach ($militar as $dados){
	$tmp = str_replace($dados['Chamada']['nome_guerra'],'<b>'.$dados['Chamada']['nome_guerra'].'</b>',$dados['Chamada']['nome_completo']);
	$tmpp = '<td>'.$dados['Posto']['sigla_posto'].' '.$dados['Quadro']['sigla_quadro'].' '.$dados['Especialidade']['nm_especialidade'].'</td>';
	$presencaini = '<td align="center" colspan="2">&nbsp;</td>';
	if($dados['Chamada']['presenca_inicio']=='F'){
		$presencaini = '<td align="center" colspan="2">F</td>';
		$faltasinicio ++;
	}
	if($dados['Chamada']['presenca_inicio']=='P'){
		$presencaini = '<td align="center" colspan="2">P</td>';
		$presencasinicio ++;
	}
		$presencater = '<td align="center" colspan="2">&nbsp;</td>';
	if($dados['Chamada']['presenca_termino']=='F'){
		$presencater = '<td align="center" colspan="2">F</td>';
		$faltastermino ++;
	}
	if($dados['Chamada']['presenca_termino']=='P'){
		$presencater = '<td align="center" colspan="2">P</td>';
		$presencastermino ++;
	}
	$class = '';
	if($i%2==0){
		$class = ' bgcolor="#f0f0f0" ';
	}
	$i++;
	$html .= '<tr '.$class.'><td><font face="Helvetica" size="10px"> '.$tmp.' ('.$dados['Chamada']['setor'].')</font></td>'.$presencaini.'<td><font face="Helvetica" size="5px">'.stripslashes($dados['Chamada']['justificativa_inicio']).'</font></td>'.$presencater.'<td><font face="Helvetica" size="5px">'.stripslashes($dados['Chamada']['justificativa_termino']).'</font></td></tr>';
}
$html .= '<tr align="right"><td><font face="Helvetica" size="10px">Assinatura:</font></td><td colspan="3"><font face="Helvetica" size="10px">Assinatura:</font></td></tr>';
$html .= '<tr bgcolor="#0000a0" align="center" ><td width="100%" colspan=10><p align="left"><font face="Helvetica" size="8px" color="white"><u>PRESENÇAS</u> INÍCIO:<b>'.$presencasinicio.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>FALTAS</u> INÍCIO:<b>'.$faltasinicio.'</b></font></p><p align="right"><font face="Helvetica" size="8px" color="white"><u>PRESENÇAS</u> TÉRMINO:<b>'.$presencastermino.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>FALTAS</u> TÉRMINO:<b>'.$faltastermino.'</b></font></p></td></tr>';
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
