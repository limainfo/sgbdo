<?php

//Column titles
//Data loading
//	header('charset=ISO-8859-1');
$final=0;

                //print_r($verso);exit();

//echo $verso[0]['Versoescala']['adjunto'];exit();

foreach($escala['Escalasmonth'] as $nomes){
	if($nomes['mes']==$dta.$dtm){
		$id2 = $nomes['id'];
		break;
	}
}
//print_r($escalasmonths);
/*
 $pdf->barcode("CODE128");


 $barnumber="{$id1}SGBDO{$id2}";
 $pdf->setSymblogy("CODE128");
 $pdf->setHeight(40);
 $pdf->setScale(1);
 $pdf->setHexColor("#a0a0dd","#FFFFFF");
 $caminho = str_replace("index.php","tmpfotos/{$id1}{$id2}",$_SERVER["SCRIPT_FILENAME"]);
 $dados = $pdf->genBarCode($barnumber,"jpg",$caminho);
 */

$verso = $versos;

//print_r($verso);exit();

$caminho = substr(__FILE__, 0, strrpos(__FILE__, '/'));
$caminho = str_replace('views/escalas','',$caminho);

$id1 = $dta.$dtm;
//echo $caminho.'webroot/pdf/assina'.$assinaturas[0]['Assinatura']['militar_id'].'.jpg';
$podeexibirrascunho = 1;

if(!empty($assinaturas)){
	foreach($assinaturas as $assinatura){
		//echo stripslashes($fotos['Assinatura']['data']);
		if(!file_exists($caminho.'webroot/pdf/assina'.$assinatura['Assinatura']['militar_id'].'.jpg')){
		$manip = fopen($caminho.'webroot/pdf/assina'.$assinatura['Assinatura']['militar_id'].'.jpg','w');
		fwrite($manip,stripslashes($assinatura['Assinatura']['data']),$assinatura['Assinatura']['size']);
		fclose($manip);
		}
	}
}
if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==12)){
	if(($selprev=='p')&&((empty($escalasmonths[0]['Escalasmonth']['ok_chefeorgaop']))||(empty($escalasmonths[0]['Escalasmonth']['ok_chefeorgaop'])))){
		$podeexibirrascunho = 1;
	}
	if(($selprev=='c')&&((empty($escalasmonths[0]['Escalasmonth']['ok_chefeorgaoc']))||(empty($escalasmonths[0]['Escalasmonth']['ok_chefeorgaoc'])))){
		$podeexibirrascunho = 1;
	}

}
if($selprev=='p'){
	if((!empty($escalasmonths[0]['Escalasmonth']['ok_chefep']))||(!empty($escalasmonths[0]['Escalasmonth']['ok_chefeorgaop']))){
		$podeexibirrascunho = 0;
		$final = 1;
	}
}
if($selprev=='c'){
	if((!empty($escalasmonths[0]['Escalasmonth']['ok_comandantec']))){
		$podeexibirrascunho = 0;
		$final = 1;
	}
}


if(count($legendas)>50){
//$pdf->AddPage('l');
}else{
//$pdf->AddPage('p');
}
//$pdf->textoRodape("Confere com original conforme NPA 261/DO/09 de 01/04/09. Desenvolvido por 2T Esp Aer COM EVALDO");



if(!$final){
	$pdf->SetFont('Arial','',14);
        $tturnos = count($turnos);
        if( $tturnos>4 ){
            $pdf->AddPage('L');
        }else{
            $pdf->AddPage('P');
        }
	$pdf->textoRodape("Desenvolvido por 2T Esp Aer COM EVALDO - 460882");
	$pdf->Escala($escala,$preenche, $turnos, $legendas,$unidade, $dtm, $dta, $selprev, $verso, $afastamento,$consultasql,$podeexibirrascunho, $afastamentoignorado,$quadrinhos,$regras);
	$pdf->fpdfOutput('escala.pdf', 'I');
}

//$pdf->fpdfOutput('teste.pdf','F');

//		if(($selprev=='p')&&($escalasmonths[0]['Escalasmonth']['ok_chefep']>0)&&(empty($escalasmonths[0]['Escalasmonth']['destrava_prevista']))){




	//echo 'else:'.($escalasmonths[0]['Escalasmonth']['id']);
	if(($selprev=='p')&&(!empty($escalasmonths[0]['Escalasmonth']['ok_comandantep']))){

		$tamanho = strlen($escalasmonths[0]['Escalasmonth']['id']);
		if($tamanho<6){
			$diferenca = 6-$tamanho;
			for($i=0;$i<$diferenca;$i++){
				$complemento .= '0';
			}
			$escalasmonths[0]['Escalasmonth']['id'] = $complemento.$escalasmonths[0]['Escalasmonth']['id'];
		}
	}

	if(($selprev=='c')&&(!empty($escalasmonths[0]['Escalasmonth']['ok_comandantec']))){

		$tamanho = strlen($escalasmonths[0]['Escalasmonth']['id']);
		if($tamanho<6){
			$diferenca = 6-$tamanho;
			for($i=0;$i<$diferenca;$i++){
				$complemento .= '0';
			}
			$escalasmonths[0]['Escalasmonth']['id'] = $complemento.$escalasmonths[0]['Escalasmonth']['id'];
		}

	}

/*
	$pdf->SetFont('Arial','',14);
	$pdf->AddPage('p');
	$pdf->textoRodape("Desenvolvido por 2T Esp Aer COM EVALDO - 460882");
	$pdf->Escala($escala,$preenche, $turnos, $legendas,$unidade, $dtm, $dta, $selprev, $verso, $afastamento,$consultasql,$podeexibirrascunho);
	$arquivo=$caminho.'webroot/pdf/'.$dta.$dtm.$escalasmonths[0]['Escalasmonth']['id'].$selprev.'.pdf';
	$pdf->fpdfOutput($arquivo, 'F');

	*/

		if(	$final ){
			
			$arquivo02=$caminho.'webroot/pdf/'.$dta.$dtm.$escalasmonths[0]['Escalasmonth']['id'].$selprev.'.pdf';
			if (!file_exists($arquivo02)) {
				//Arquivo com assinatura
				//$pdf->LimpaBuffer();
				$podeexibirrascunho = 0;
				$pdf->SetFont('Arial','',14);
                                $tturnos = count($turnos);
                                if( $tturnos>4 ){
                                    $pdf->AddPage('L');
                                }else{
                                    $pdf->AddPage('P');
                                }
				$pdf->textoRodape("Desenvolvido por 2T Esp Aer COM EVALDO - 460882");
				//$pdf->Escala($escala,$preenche, $turnos, $legendas,$unidade, $dtm, $dta, $selprev, $verso, $afastamento,$consultasql,$podeexibirrascunho, $afastamentoignorado);
	$pdf->Escala($escala,$preenche, $turnos, $legendas,$unidade, $dtm, $dta, $selprev, $verso, $afastamento,$consultasql,$podeexibirrascunho, $afastamentoignorado,$quadrinhos, $regras);
                                
				$pdf->fpdfOutput($arquivo02,'F');
				$pdf->Close();
			}
			/*
			$arquivo01=$caminho.'webroot/pdf/'.$dta.$dtm.$escalasmonths[0]['Escalasmonth']['id'].$selprev.'a.pdf';
			if (!file_exists($arquivo01)) {
				$pdf->LimpaBuffer();
				$podeexibirrascunho = 0;
				$pdf->SetFont('Arial','',14);
				$pdf->textoRodape("Desenvolvido por 2T Esp Aer COM EVALDO - 460882");
				$pdf->AddPage('p');
				$pdf->Escala($escala,$preenche, $turnos, $legendas,$unidade, $dtm, $dta, $selprev, $verso, $afastamento,$consultasql,$podeexibirrascunho);
				$pdf->fpdfOutput($arquivo01,'F');
				$pdf->Close();
			}
			*/
			
			if($u[0]['Usuario']['privilegio_id']!=12){
				//Arquivo com assinatura
				$arquivo=$arquivo02;
			}else{
				$arquivo=$arquivo02;
			}

			
			$manip = fopen($arquivo,'r');
			$conteudo=fread($manip,filesize($arquivo));
			
			
			header('Content-Type: application/pdf');
			header('Content-Length: '.strlen($conteudo));
			header('Content-disposition: inline; filename="'.$dta.$dtm.$escalasmonths[0]['Escalasmonth']['id'].$selprev.'.pdf'.'"');
			echo $conteudo;
			
			//$pdf->fpdfOutput($arquivo,'A');
			fclose($manip);
			
		}

//$pdf->SetXY(40,40);
//$pdf->Cell(30,4,iconv('UTF-8','ISO-8859-1',$caminho.'webroot/pdf/'.$dta.$dtm.$escalasmonths[0]['Escalasmonth']['id'].$selprev.'.pdf'),1,0,'C',1);


/*
 $nm_arquivo = "tmpfotos/file_{$dados['Foto']['id']}.jpg";
 $img = stripslashes($dados['Foto']['data']);
 $fp = fopen($nm_arquivo, 'w+b');
 fwrite($fp, $img);
 fclose($fp);
 $this->Image($nm_arquivo,175,10,15,20);
 */

?>
