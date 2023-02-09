<?php

App::import('Vendor','fpdf/fpdf');

if (!defined('PARAGRAPH_STRING')) define('PARAGRAPH_STRING', '~~~');

class PdfHelper extends FPDF {
	var $title;

	// Codigo de barras
	// ----------------------------------------------------------
	var $_encode;
	var $_error;
	var $_width;
	var $_height;
	var $_scale;
	var $_color;
	var $_font;
	var $_bgcolor;
	var $_format;
	var $_n2w;
	// -----------------------------------------------------------

	var $angle=0;  //Recurso adicionado para imprimir texto em outros angulos
	var $controle_rodape = 0;
	var $texto_rodape = '';

	function textoRodape($texto){
		$this->controle_rodape = 1;
		$this->texto_rodape = $texto;
	}



	function setup ($w=null,$orientation='P',$unit='mm',$format='A4') {
		$this->FPDF($orientation, $unit, $format);
	}



	function fpdfOutput ($name = 'page.pdf', $destination = 's') {
		return $this->Output($name, $destination);
	}


	function Header()
	{

		//Logo
		//	    $this->Image(WWW_ROOT.DS.'',10,8,33);
		// you can use jpeg or pngs see the manual for fpdf for more info
		//Arial bold 15
		//$this->SetFont('Arial','B',15);
		//Move to the right
		//$this->Cell(80);
		//Title
		//$this->Cell(30,10,$this->title,1,0,'C');
		//Line break
		//$this->Ln(20);
	}



	function HeaderFichaCadastral($dados,$url)
	{
		$this->AliasNbPages();
		if($this->GetY()>180){
			$this->AddPage();
			$this->SetY(0);
		}
		//Logo
		//	    $this->Image(WWW_ROOT.DS.'',10,8,33);
		// you can use jpeg or pngs see the manual for fpdf for more info
		//Arial bold 15
		$this->SetFont('Arial','',10);
		//Move to the right
		$this->SetXY(20,10);
		$this->Write(10,iconv('UTF-8','ISO-8859-1','COMANDO DA AERONÁUTICA'));
		$this->SetXY(20,14);
		$this->Write(10,iconv('UTF-8','ISO-8859-1','DEPARTAMENTO DE CONTROLE DO ESPAÇO'));
		$this->SetXY(20,18);
		$this->Write(10,iconv('UTF-8','ISO-8859-1','DIVISÃO DE GERENCIAMENTO DE TRÁFEGO AÉREO'));

		$this->SetFont('Arial','B',10);
		$this->SetXY(20,28);
		$this->Write(10,iconv('UTF-8','ISO-8859-1','FICHA CADASTRAL DE CONTROLADOR DE TRÁFEGO AÉREO'));

		//$this->Write(12,$dados['Militar']['nm_completo']);

		if (stripos($dados['Foto']['type'],'jp')!==false){

			$nm_arquivo = "tmpfotos/file_{$dados['Foto']['id']}.jpg";
			$img = stripslashes($dados['Foto']['data']);

			$fp = fopen($nm_arquivo, 'w+b');
			fwrite($fp, $img);
			fclose($fp);
			$this->Image($nm_arquivo,175,10,15,20);
		}
		if (stripos($dados['Foto']['type'],'png')!==false){

			$nm_arquivo = "tmpfotos/file_{$dados['Foto']['id']}.png";

			$img = stripslashes($dados['Foto']['data']);

			$fp = fopen($nm_arquivo, 'w+b');
			fwrite($fp, $img);
			fclose($fp);
			$this->Image($nm_arquivo,175,10,15,20);
		}

	}

	function atualiza_militarscursoscorrigidos($dados, $setor)
	{

		$this->SetXY(20,20);
		$this->SetFont('Arial','B',8);
		$this->Cell(180,4,iconv('UTF-8','ISO-8859-1','INFORMAÇÕES PARA ATUALIZAÇÃO DO SGBDO'),1,0,'C');
		$this->SetXY(20,24);
		$this->SetFont('Arial','B',8);
		$this->Cell(90,4,iconv('UTF-8','ISO-8859-1','MILITAR'),1,0,'L');
		$this->Cell(15,4,iconv('UTF-8','ISO-8859-1','CURSO'),1,0,'L');
		$this->Cell(15,4,iconv('UTF-8','ISO-8859-1','INÍCIO'),1,0,'L');
		$this->Cell(15,4,iconv('UTF-8','ISO-8859-1','TÉRMINO'),1,0,'L');
		$this->Cell(30,4,iconv('UTF-8','ISO-8859-1','LOCAL'),1,0,'L');
		//		$this->Cell(30,4,iconv('UTF-8','ISO-8859-1','DOCUMENTO'),1,0,'L');
		$this->Cell(15,4,iconv('UTF-8','ISO-8859-1','AÇÃO'),1,0,'L');

		$this->SetFont('Arial','',6);

		$x_inicio = 28;
		$total = count($dados);
		$conta = 0;

		foreach($dados as $curso){
			$this->SetXY(20,$x_inicio);
			$this->SetFont('Arial','',5);
			$this->Cell(90,4,iconv('UTF-8','ISO-8859-1',$curso[0]['nomecompleto']),1,0,'L');
			$this->Cell(15,4,iconv('UTF-8','ISO-8859-1',$curso['Curso']['codigo']),1,0,'L');
			$this->SetFont('Arial','',6);

			$this->Cell(15,4,iconv('UTF-8','ISO-8859-1',date('d-m-Y',strtotime($curso['MilitarsCurso']['dt_inicio_curso']))),1,0,'L');
			$this->Cell(15,4,iconv('UTF-8','ISO-8859-1',date('d-m-Y',strtotime($curso['MilitarsCurso']['dt_fim_curso']))),1,0,'L');
			$this->Cell(30,4,iconv('UTF-8','ISO-8859-1',$curso['MilitarsCurso']['local_realizacao']),1,0,'L');
			//$this->Cell(30,4,iconv('UTF-8','ISO-8859-1',$curso['MilitarsCurso']['documento']),1,0,'L');
			$this->Cell(15,4,iconv('UTF-8','ISO-8859-1',$curso['MilitarsCurso']['acao']),1,0,'L');
			$x_inicio+=4;
			$conta++;
			if($x_inicio>260){
				if($conta<$total){
					$this->AddPage();
					$x_inicio = 25;
				}
			}
		}

		$complemento = '';
		if(strlen($setor)>2){
			$assinatura = '            Chefe do   '.$setor;
		}else{
			$assinatura = '            Comandante do '.$dados[0]['Unidade']['sigla_unidade'];
				
		}

		$this->Ln();
		$this->Ln();
		$this->SetFont('Arial','',8);
		$this->Cell(180,4,iconv('UTF-8','ISO-8859-1','            Ref: FAX no. 1035/OPLAC/09, de 19 de agosto de 2009.'),0,0,'L');

		$this->Ln();
		$this->Ln();
		$this->setX(20);
		$this->Cell(180,4,iconv('UTF-8','ISO-8859-1','__________________________________________________________'),0,0,'R');
		$this->Ln();
		$this->setX(20);
		$this->Cell(180,4,iconv('UTF-8','ISO-8859-1',$assinatura.'                             '),0,0,'R');


	}

	function DadosPessoais($dados)
	{

		$this->SetFont('Arial','',10);
		$this->SetXY(120,10);
		$this->Cell(10,20,'01',1,0,'C');
		$this->Cell(40,10,'',1,0,'C');
		$this->SetXY(130,20);
		$this->Cell(40,10,'',1,0,'C');

		$this->SetFont('Arial','B',10);
		$this->SetXY(130,10);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','(a) Licença no.:'));
		$this->SetXY(130,14);
		$this->Write(5,$dados['Militar']['nr_licenca']);

		$this->SetXY(130,20);
		$this->Write(5,'(b) Indicativo');
		$this->SetXY(130,24);
		$this->Write(5,'Operacional:'.$dados['Habilitacao']['indicativo']);

		$this->SetFont('Arial','B',10);
		$this->SetXY(20,36);
		$this->Cell(170,5,'DADOS PESSOAIS',1,0,'L');

		$this->SetFont('Arial','',10);
		$this->SetXY(20,41);
		$this->Cell(10,8,'02',1,0,'C');
		$this->Cell(160,8,'',1);
		$this->SetXY(30,41);
		$this->Write(5,'NOME COMPLETO:');
		$this->SetXY(30,45);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Militar']['nm_completo']));


		$this->SetXY(20,49);
		$this->Cell(10,8,'03',1,0,'C');
		$this->Cell(80,8,'',1);
		$this->Cell(10,8,'04',1,0,'C');
		$this->Cell(70,8,'',1);

		$this->SetXY(30,49);
		$this->Write(5,'NOME DE GUERRA:');
		$this->SetXY(30,53);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Militar']['nm_guerra']));
		$this->SetXY(120,49);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','POSTO/GRAD/NÍVEL:'));
		$this->SetXY(120,53);
		$this->Write(5,$dados['Posto']['sigla_posto'].' '.$dados['Especialidade']['nm_especialidade'].' '.$dados['Quadro']['sigla_quadro']);

		$this->SetXY(20,57);
		$this->Cell(10,8,'05',1,0,'C');
		$this->Cell(40,8,'',1);
		$this->Cell(10,8,'06',1,0,'C');
		$this->Cell(40,8,'',1);
		$this->Cell(10,8,'07',1,0,'C');
		$this->Cell(60,8,'',1);

		$this->SetXY(30,57);
		$this->Write(5,'DATA NASC:');
		$this->SetXY(80,57);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','DATA DE ADMISSÃO:'));
		$this->SetXY(130,57);
		$this->Write(5,'RG/ORG.EXP:');

		$this->SetXY(30,61);
		$this->Write(5,date('d/m/Y',strtotime($dados['Militar']['dt_nascimento'])));
		$this->SetXY(80,61);
		$this->Write(5,date('d/m/Y',strtotime($dados['Militar']['dt_admissao'])));
		$this->SetXY(130,61);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Militar']['identidade']).'  COMAER');


		$this->SetXY(20,65);
		$this->Cell(10,8,'08',1,0,'C');
		$this->Cell(90,8,'',1);
		$this->Cell(10,8,'09',1,0,'C');
		$this->Cell(60,8,'',1);

		$this->SetXY(30,65);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','ÚLTIMA PROMOÇÃO:'));
		$this->SetXY(130,65);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','UNIDADE/ÓRGÃO:'));

		$this->SetXY(30,69);
		$this->Write(5,date('d/m/Y',strtotime($dados['Militar']['dt_ultima_promocao'])));
		$this->SetXY(130,69);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Unidade']['sigla_unidade'].'/'.$dados['Orgao']['sigla_orgao']));

		$this->SetXY(20,73);
		$this->Cell(10,8,'10',1,0,'C');
		$this->Cell(80,8,'',1);
		$this->Cell(10,8,'11',1,0,'C');
		$this->Cell(70,8,'',1);

		$this->SetXY(30,73);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','ÚLTIMA PROMOÇÃO:'));
		$this->SetXY(120,73);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','PROCEDÊNCIA:'));

		$this->SetXY(30,77);
		$this->Write(5,date('d/m/Y',strtotime($dados['Militar']['dt_apresentacao'])));
		$this->SetXY(120,77);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Militar']['procedencia']));

		$this->SetFont('Arial','B',10);
		$this->SetXY(20,81);
		$this->Cell(170,5,iconv('UTF-8','ISO-8859-1','HABILITAÇÃO'),1,0,'L');

		$this->SetFont('Arial','',10);

		$this->SetXY(20,86);
		$this->Cell(10,8,'12',1,0,'C');
		$this->Cell(80,8,'',1);
		$this->Cell(10,8,'13',1,0,'C');
		$this->Cell(70,8,'',1);

		$this->SetXY(30,86);
		$this->Write(5,'CHT ANTERIOR:');
		$this->SetXY(120,86);
		$this->Write(5,'VALIDADE:');

		$this->SetXY(30,90);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Habilitacao'][0]['cht_anterior']));
		$this->SetXY(120,90);
		$this->Write(5,date('d/m/Y',strtotime($dados['Habilitacao'][0]['validade_cht_anterior'])));

		$this->SetXY(20,94);
		$this->Cell(10,8,'14',1,0,'C');
		$this->Cell(80,8,'',1);
		$this->Cell(10,8,'15',1,0,'C');
		$this->Cell(70,8,'',1);

		$this->SetXY(30,94);
		$this->Write(5,'CHT ATUAL:');
		$this->SetXY(120,94);
		$this->Write(5,'VALIDADE:');

		$this->SetXY(30,98);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Habilitacao'][0]['cht_atual']));
		$this->SetXY(120,98);
		$this->Write(5,date('d/m/Y',strtotime($dados['Habilitacao'][0]['validade_cht_atual'])));

		$this->SetXY(20,102);
		$this->Cell(10,8,'16',1,0,'C');
		$this->Cell(80,8,'',1);
		$this->Cell(10,8,'17',1,0,'C');
		$this->Cell(70,8,'',1);

		$this->SetXY(30,102);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','FUNÇÃO ATUAL/SETOR:'));
		$this->SetXY(120,102);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','CONDIÇÃO OPERACIONAL:'));

		$this->SetXY(30,106);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Habilitacao'][0]['funcao']));
		$this->SetXY(120,106);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Habilitacao'][0]['condicao_operacional']));

		$this->SetXY(20,110);
		$this->Cell(10,8,'18',1,0,'C');
		$this->Cell(50,8,'',1);
		$this->Cell(10,8,'19',1,0,'C');
		$this->Cell(50,8,'',1);
		$this->Cell(10,8,'20',1,0,'C');
		$this->Cell(40,8,'',1);

		$this->SetXY(30,110);
		$this->Write(5,'CONCEITO OPERACIONAL:');
		$this->SetXY(90,110);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','GRAU TEÓRICO:'));
		$this->SetXY(150,110);
		$this->Write(5,iconv('UTF-8','ISO-8859-1','NÍVEL INGLÊS:'));

		$this->SetXY(30,114);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Habilitacao'][0]['conceito_operacional']));
		$this->SetXY(90,114);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Habilitacao'][0]['grau_teorico']));
		$this->SetXY(150,114);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Habilitacao'][0]['nivel_ingles']));

		$this->SetXY(20,118);
		$this->SetFont('Arial','',10);
		$this->Cell(10,5,'21',1,0,'C');
		$this->SetFont('Arial','B',10);
		$this->Cell(160,5,iconv('UTF-8','ISO-8859-1','CURSOS (CÓDIGO/NOME/LOCAL/DATA)'),1,0,'L');
		//$this->Cell(160,5,iconv('UTF-8','ISO-8859-1','ABC',1,0,'L'));

		$this->SetFont('Arial','',10);


		/*
		 $x_inicio = 123;
		 $limite=1;

		 for($i=1;$i<=count($dados['Curso']);$i++){
			$this->SetXY(20,$x_inicio);
			$this->Cell(170,6,'',1);
			$x_inicio+=6;
			}
			*/

		$this->SetFont('Arial','',8);

		$x_inicio = 123;
		foreach($dados['Curso'] as $curso){
			$this->SetXY(20,$x_inicio);
			$this->Cell(170,6,iconv('UTF-8','ISO-8859-1',$curso['codigo'].'/'.$curso['descricao'].'/'.$curso['MilitarsCurso']['local_realizacao'].'/'.$curso['MilitarsCurso']['periodo']),1);
			$x_inicio+=6;
			$limite++;
		}
		$this->SetFont('Arial','',10);

		/*
		 $this->SetXY(20,129);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,135);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,141);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,147);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,153);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,159);
		 $this->Cell(170,6,'',1);
		 */
		$x_inicio = $this->GetY()+6;
		$this->SetXY(20,$x_inicio);
		$this->SetFont('Arial','',10);
		$this->Cell(10,5,'22',1,0,'C');
		$this->SetFont('Arial','B',10);
		$this->Cell(160,5,iconv('UTF-8','ISO-8859-1','EXPERIÊNCIA FUNCIONAL (FUNÇÃO/ÓRGÃO/PERÍODO)'),1,0,'L');

		$x_inicio = $this->GetY()+5;
		$this->SetFont('Arial','',8);

		foreach($dados['Atividade'] as $atividade){
			$this->SetXY(20,$x_inicio);
			//if($limite<=7){
			$this->SetXY(20,$x_inicio);
			$this->Cell(170,5,iconv('UTF-8','ISO-8859-1',$atividade['desc_atividade'].'/'.$atividade['orgao'].'/'.$atividade['periodo']),1);
			//}
			$x_inicio =$this->GetY()+5;
			$limite++;
		}
		$this->SetFont('Arial','',10);

		/*
		 $this->SetXY(20,170);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,176);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,182);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,188);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,194);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,200);
		 $this->Cell(170,6,'',1);
		 $this->SetXY(20,206);
		 $this->Cell(170,6,'',1);
		 */
		//$y = $this->GetY()+6;

		//$this->SetXY(20,212);
		$this->SetXY(20,$x_inicio);
		$this->SetFont('Arial','B',10);
		$this->Cell(170,5,iconv('UTF-8','ISO-8859-1','EXAME DE SAÚDE'),1,0,'L');

		$x_inicio =$this->GetY()+5;
		$this->SetFont('Arial','',10);
		//$this->SetXY(20,217);
		$this->SetXY(20,$x_inicio);
		$this->MultiCell(10,8,'23',1,'C',0);
		$this->SetXY(30,$x_inicio);
		$this->MultiCell(50,4,"DATA:\r\n".date('d/m/Y',strtotime($dados['Exame'][0]['data_exame'])),1,'L',0);
		$this->SetXY(80,$x_inicio);
		$this->MultiCell(10,8,'24',1,'C',0);
		$this->SetXY(90,$x_inicio);
		$this->MultiCell(50,4,"PARECER:\r\n".iconv('UTF-8','ISO-8859-1',$dados['Exame'][0]['parecer']),0,'L',0);
		$this->SetXY(140,$x_inicio);
		$this->MultiCell(10,8,'25',1,'C',0);
		$this->SetXY(150,$x_inicio);
		$this->MultiCell(40,4,"VALIDADE:\r\n".date('d/m/Y',strtotime($dados['Exame'][0]['validade'])),1,'L',0);

		/*
		 $this->SetXY(30,$x_inicio);
		 $this->Write(5,'DATA:');
		 $this->SetXY(90,$x_inicio);
		 $this->Write(5,'PARECER:');
		 $this->SetXY(150,$x_inicio);
		 $this->Write(5,'VALIDADE:');

		 $x_inicio =$this->GetY()+4;

		 $this->SetXY(30,$x_inicio);
		 $this->Write(5,date('d/m/Y',strtotime($dados['Exame'][0]['data_exame'])));
		 $this->SetXY(90,$x_inicio);
		 $this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Exame'][0]['parecer']));
		 $this->SetXY(150,$x_inicio);
		 $this->Write(5,date('d/m/Y',strtotime($dados['Exame'][0]['validade'])));
		 */
		$x_inicio =$this->GetY();

		$this->SetXY(20,$x_inicio);
		$this->SetFont('Arial','B',10);
		$this->Cell(170,5,iconv('UTF-8','ISO-8859-1','DADOS DO RESPONSÁVEL PELO PREENCHIMENTO'),1,0,'L');


		$x_inicio =$this->GetY()+5;
		$this->SetFont('Arial','',10);
		$this->SetXY(20,$x_inicio);
		$this->Cell(10,8,'26',1,0,'C');
		$this->MultiCell(160,4,"CIDADE E DATA:\r\n".'Manaus, '.date('d/m/Y'),1,'L',0);

		/*$this->SetXY(30,$x_inicio);
		 $this->Write(5,'CIDADE E DATA:');

		 $x_inicio =$this->GetY()+4;
		 $this->SetXY(30,$x_inicio);
		 $this->Write(5,'Manaus, '.date('d/m/Y'));
		 */
		$x_inicio =$this->GetY();
		$this->SetXY(20,$x_inicio);
		$this->Cell(10,8,'27',1,0,'C');
		$this->MultiCell(160,4,iconv('UTF-8','ISO-8859-1','POSTO/GRAD,ESP,NOME COMPLETO E FUNÇÃO:').'                                                                           '.iconv('UTF-8','ISO-8859-1',$dados['Posto']['sigla_posto'].' '.$dados['Especialidade']['nm_especialidade'].' '.$dados['Militar']['nm_completo']),1,'L',0);
		/*
		 $this->SetXY(30,$x_inicio);
		 $this->Write(5,iconv('UTF-8','ISO-8859-1','POSTO/GRAD,ESP,NOME COMPLETO E FUNÇÃO:'));
		 */

		$x_inicio =$this->GetY();
		$this->SetXY(20,$x_inicio);
		$this->Cell(10,8,'28',1,0,'C');
		$this->MultiCell(160,4,"ASSINATURA:\r\n".iconv('UTF-8','ISO-8859-1',$dados['Militar']['nm_completo']),1,'L',0);
		//$this->SetXY(30,$x_inicio);
		//$this->Write(5,'ASSINATURA:');
		/*
		$x_inicio =$this->GetY()+4;
		$this->SetXY(30,$x_inicio);
		$this->Write(5,iconv('UTF-8','ISO-8859-1',$dados['Militar']['nm_completo']));
		*/

		$x_inicio =$this->GetY();
		$this->SetXY(20,$x_inicio);
		$this->SetFont('Arial','B',10);
		$this->MultiCell(170,4,iconv('UTF-8','ISO-8859-1','OBS.: Se necessário, poderá ser utilizado o verso desta Ficha para informações complementares, citando o no. do campo.'),1,'L',0);

		//$this->AddPage();



	}

	function Escala($escala, $preenche, $turnos, $legendas, $unidade, $dtm, $dta, $selprev, $verso, $afastamento, $consultasql,$podeexibirrascunho)
	{

		$this->AliasNbPages();
		$this->lMargin = 20;
		$this->tMargin = 20;
		$this->bMargin = 35;
		$this->rMargin = 15;
		$tampagina = 174;
		$this->AutoPageBreak = 1;


		foreach($escala['Escalasmonth'] as $nomes){
			if($nomes['mes']==$dta.$dtm){
				if($selprev=='p'){
					$assinacomandante = $nomes['ok_comandantep'];
					$escalante = $nomes['nm_escalantep'];
					$chefe = $nomes['nm_chefe_orgaop'];
					$comandante = $nomes['nm_comandantep'];
					$idescalante = $nomes['ok_escalantep'];
					$idchefe = $nomes['ok_chefep'];
					$idcheferegional = $nomes['ok_chefeorgaop'];

				}else{
					$assinacomandante = $nomes['ok_comandantec'];
					$escalante = $nomes['nm_escalantec'];
					$chefe = $nomes['nm_chefe_orgaoc'];
					$comandante = $nomes['nm_comandantec'];
					$idescalante = $nomes['ok_escalantec'];
					$idchefe = $nomes['ok_chefec'];
					$idcheferegional = $nomes['ok_chefeorgaoc'];

				}

				$horainstrucao = $nomes['hora_instrucao'];
				$horainstrucao += 0;
				if($horainstrucao==0){
					$horainstrucao = 0;
				}
				$id2 = $nomes['id'];
				break;
			}

		}

		/*
		 $id1 = $dta.$dtm;
		 $caminho = str_replace("index.php","tmpfotos/{$id1}{$id2}.jpg",$_SERVER["SCRIPT_FILENAME"]);
		 $this->RotatedImage($caminho, 170, 190, 100, 16, 90);
		 */
		$caminho = substr(__FILE__, 0, strrpos(__FILE__, '/'));
		$caminho = str_replace('views/helpers','',$caminho);

		if($podeexibirrascunho>0){
			if($idescalante>0){
				if(file_exists($caminho.'webroot/pdf/assina'.$idescalante.'.jpg')){
					$this->Image($caminho.'webroot/pdf/assina'.$idescalante.'.jpg',140,20,40,5.7);
				}
			}
			if($idchefe>0){
				if(file_exists($caminho.'webroot/pdf/assina'.$idchefe.'.jpg')){
					$this->Image($caminho.'webroot/pdf/assina'.$idchefe.'.jpg',140,30,40,5.7);
				}
			}
		}


		if(($idcheferegional>0)||(!$podeexibirrascunho)){
			$rascunho = 0;
		}else{
			$rascunho = 1;
		}

		if($comandante>0){
			$rascunho = 0;
		}



		if($rascunho==1){
			$this->SetFont('Arial','B',28);
			$this->SetTextColor(200,200,200);
			$this->RotatedText(10,250,'RASCUNHO - AGUARDA ASSINATURA DO CHF REGIONAL',45);
			$max = count($legendas);
			$this->SetTextColor(0,0,0);
		}

		$this->SetFont('Arial','B',8);
		$this->SetXY(20,20);
		$this->Cell(43,4,iconv('UTF-8','ISO-8859-1','CINDACTA IV'),0,0,'L');
		if($selprev=='p'){
			$this->Cell(33,4,iconv('UTF-8','ISO-8859-1','PREVISTA'),0,0,'L');
		}else{
			$this->Cell(33,4,iconv('UTF-8','ISO-8859-1','CUMPRIDA'),0,0,'L');
		}
		$this->Cell(32,4,iconv('UTF-8','ISO-8859-1','MÊS/ANO'),0,0,'L');
		$this->Cell(66,4,iconv('UTF-8','ISO-8859-1','ESCALANTE'),0,0,'L');
		$this->SetFont('Arial','',8);
		$this->SetXY(20,23);
		$this->Cell(43,4,iconv('UTF-8','ISO-8859-1',$unidade[0]['Unidade']['sigla_unidade']),0,0,'C');
		$this->Cell(33,4,iconv('UTF-8','ISO-8859-1',' '),'C');
		$meses = array('01'=>'JANEIRO','02'=>'FEVEREIRO','03'=>'MARÇO','04'=>'ABRIL','05'=>'MAIO','06'=>'JUNHO','07'=>'JULHO','08'=>'AGOSTO','09'=>'SETEMBRO','10'=>'OUTUBRO','11'=>'NOVEMBRO','12'=>'DEZEMBRO');
		$meseslower = array('01'=>'janeiro','02'=>'fevereiro','03'=>'março','04'=>'abril','05'=>'maio','06'=>'junho','07'=>'julho','08'=>'agosto','09'=>'setembro','10'=>'outubro','11'=>'novembro','12'=>'dezembro');


		$this->Cell(32,4,iconv('UTF-8','ISO-8859-1',$meses[$dtm].'/ '.$dta),0,0,'C');
		$this->SetFont('Arial','',5);
		$this->Cell(66,8,iconv('UTF-8','ISO-8859-1',$escalante),0,0,'C');
		$this->SetXY(20,20);
		$this->Cell(43,8,' ',1,0,'C');
		$this->Cell(33,8,' ',1,0,'C');
		$this->Cell(32,8,' ',1,0,'C');
		$this->Cell(66,8,' ',1,0,'C');

		$this->SetXY(20,28);
		$this->SetFont('Arial','B',8);
		$this->Cell(43,4,'LOCALIDADE',0,0,'L');
		//$this->SetFont('Arial','B',6);
		$this->Cell(33,4,'EFETIVO TOTAL',0,0,'L');
		$this->Cell(32,4,'EFETIVO DA ESCALA',0,0,'L');


		$t01 = strtoupper($unidade[0]['Setor']['sigla_setor']);
		$p1 = '/APP/';
		$p2 = '/ACC/';
		$p3 = '/TWR/';

		$novoPDF = $dta.$dtm;


		if(((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01)))&&($novoPDF<=200908)){
			$this->SetFont('Arial','B',8);
			$this->Cell(66,8,iconv('UTF-8','ISO-8859-1','CHEFE DO ÓRGÃO'),0,0,'L');

		}else{

			if($podeexibirrascunho){
					
				if($assinacomandante>0){
					$this->Image('img/assinaturacmt.jpg',150,36,18,8);
				}
			}
			$this->SetFont('Arial','B',8);
			$this->Cell(66,4,iconv('UTF-8','ISO-8859-1','CHEFE DO ÓRGÃO'),0,0,'L');

		}


		$this->SetFont('Arial','',8);
		$this->SetXY(20,31);
		$this->Cell(43,4,iconv('UTF-8','ISO-8859-1',$unidade[0]['Cidade']['nome']),0,0,'C');
		$this->Cell(33,4,$escala['Escala']['efetivo_total'],0,0,'C');
		$this->Cell(32,4,$preenche[0]['EscalasMonth']['efetivo_total'],0,0,'C');
		//$this->Cell(32,4,' ',0,0,'C');

		//-------------------------------------------------------------
		if(((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01)))&&($novoPDF<=200908)){
			//if((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01))){
			$this->SetFont('Arial','',5);
			$this->SetXY(128,39);
			$this->Cell(66,8,iconv('UTF-8','ISO-8859-1',$chefe),0,0,'C');
		}else{
			$this->SetFont('Arial','',5);
			$this->Cell(66,8,iconv('UTF-8','ISO-8859-1',$chefe),0,0,'C');

		}
		$this->SetXY(20,28);
		$this->Cell(43,8,' ',1,0,'C');
		$this->Cell(33,8,' ',1,0,'C');
		$this->Cell(32,8,' ',1,0,'C');
		if(((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01)))&&($novoPDF<=200908)){
			//if((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01))){
			$this->Cell(66,16,' ',1,0,'C');
		}else{
			$this->Cell(66,8,' ',1,0,'C');

		}

		$this->SetXY(20,36);
		$this->SetFont('Arial','B',8);
		$this->Cell(43,4,iconv('UTF-8','ISO-8859-1','ÓRGÃO'),0,0,'L');
		//$this->SetFont('Arial','B',6);
		$this->Cell(33,4,iconv('UTF-8','ISO-8859-1','MÉDIA HORA MENSAL'),0,0,'L');
		$this->Cell(32,4,iconv('UTF-8','ISO-8859-1','HORA INSTRUÇÃO'),0,0,'L');

		if(((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01)))&&($novoPDF<=200908)){
			//if((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01))){
		}else{
			$this->SetFont('Arial','B',8);
			$this->Cell(66,4,'COMANDANTE',0,0,'L');
		}

		$this->SetFont('Arial','',8);
		$this->SetXY(20,39);
		$mediagrafico = 0;
		$this->Cell(43,4,iconv('UTF-8','ISO-8859-1',$unidade[0]['Setor']['sigla_setor']),0,0,'C');
		if($selprev=='p'){
			$mediagrafico = round($preenche[0]['EscalasMonth']['media_hora_prevista'],0);
			$this->Cell(33,4,iconv('UTF-8','ISO-8859-1',$mediagrafico),0,0,'C');
		}else{
			$mediagrafico = round($preenche[0]['EscalasMonth']['media_hora'],0);
			$this->Cell(33,4,iconv('UTF-8','ISO-8859-1',$mediagrafico),0,0,'C');
		}

		//--------------------------------------------------------------------
		$this->Cell(32,4,iconv('UTF-8','ISO-8859-1',$horainstrucao),0,0,'C');




		if(((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01)))&&($novoPDF<=200908)){
			//if((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01))){
		}else{
			$this->SetFont('Arial','',5);
			$this->Cell(65,8,iconv('UTF-8','ISO-8859-1',$comandante),0,0,'C');
		}

		$this->SetXY(20,36);
		$this->Cell(43,8,iconv('UTF-8','ISO-8859-1',' '),1,0,'C');
		$this->Cell(33,8,iconv('UTF-8','ISO-8859-1',' '),1,0,'C');
		$this->Cell(32,8,iconv('UTF-8','ISO-8859-1',' '),1,0,'C');
		if(((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01)))&&($novoPDF<=200908)){
			//if((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01))){
		}else{
			$this->Cell(66,8,iconv('UTF-8','ISO-8859-1',' '),1,0,'C');
		}
		$this->SetXY(20,44);
		$this->SetFont('Arial','B',8);
		$this->Cell(7,4,'DIA',0,0,'C');
		$this->Cell(7,4,'SEM',0,0,'C');
		$this->SetFont('Arial','B',6);


		$qtd_turnos = count($turnos);
		$tamanho = round(64/$qtd_turnos);

		$tamtotal = 0;
		foreach ($turnos as $turno){
			$tamcalc = $turno['Turno']['qtd'];
			$tamanhos[$turno['Turno']['id']]['tamanho'] = round((($tamcalc)*2 + ($tamcalc-1))*0.4);
			
			$limite = 16;
			if($tamcalc>4){
				$minimo = 20;
			}else{
				$minimo = 16;
			}
			if($tamanhos[$turno['Turno']['id']]['tamanho']<$limite){
				$tamanhos[$turno['Turno']['id']]['tamanho'] = $limite;
			}
			

		$t01 = strtoupper($unidade[0]['Setor']['sigla_setor']);
		$p1 = '/ACC/';
		if((preg_match($p1, $t01))&&($dtm==11)){
				$tamanhos[$turno['Turno']['id']]['tamanho'] = 13.8;
		}
			
			$tamtotal += $tamanhos[$turno['Turno']['id']]['tamanho'] ; 
			
		}
		
		foreach ($turnos as $turno){

			//for($c=1;$c<=$qtd_turnos;$c++){
			//$this->Cell($tamanho,4,iconv('UTF-8','ISO-8859-1',$turno['Turno']['rotulo']),0,0,'C');
			$this->Cell($tamanhos[$turno['Turno']['id']]['tamanho'],4,iconv('UTF-8','ISO-8859-1',$turno['Turno']['rotulo']),0,0,'C');
		}
		
		$folga = $tampagina -21 - floor($tamtotal);
		if(floor($tamtotal)>64){
			$tobs = floor($tamtotal) - 64;
		}
		$tobs = 7;
		$this->SetFont('Arial','B',8);
		$this->Cell($folga,4,'FOLGA',0,0,'C');
		$this->Cell($tobs,4,'OBS',0,0,'C');


		$this->SetFont('Arial','',8);
		$this->SetXY(20,46);
		$this->Cell(7,4,' ',0,0,'C');
		$this->Cell(7,4,' ',0,0,'C');
		$this->SetFont('Arial','',6);


		foreach ($turnos as $turno){
			$this->Cell($tamanhos[$turno['Turno']['id']]['tamanho'],4,iconv('UTF-8','ISO-8859-1',substr($turno['Turno']['hora_inicio'],0,5).'/'.substr($turno['Turno']['hora_termino'],0,5)),0,0,'C');
			$inicio = strtotime($turno['Turno']['hora_inicio']);
			$termino = strtotime($turno['Turno']['hora_termino']);
			$qtd = $turno['Turno']['qtd'];

			$v1h1 = date('G', $inicio);
			$v1h2 = date('G', $termino);
			$v1m1 = date('i', $inicio);
			$v1m2 = date('i', $termino);

			$v1 = $v1h1 + ($v1m1/60);
			$v2 = $v1h2 + ($v1m2/60);

			$v3 = $turno['Turno']['qtd'];

			if($v2<$v1){
				$qtd_horas = (24-$v1) + $v2;
			}else{
				$qtd_horas = (abs($v1 - $v2));
			}

			$t[$turno['Turno']['id']]['horas'] = $qtd_horas;
			$t[$turno['Turno']['id']]['qtd'] = 0;
		}

		$this->Cell($folga,4,' ',0,0,'C');
		$this->Cell($tobs,4,' ',0,0,'C');



		$this->SetXY(20,44);
		$this->Cell(7,6,' ',1,0,'C');
		$this->Cell(7,6,' ',1,0,'C');
		for($c=1;$c<=$qtd_turnos;$c++){
			$this->Cell($tamanhos[$turno['Turno']['id']]['tamanho'],6,' ',1,0,'C');
		}
		$this->Cell($folga,6,' ',1,0,'C');
		$this->Cell($tobs,6,' ',1,0,'C');


		$todos = '';



		foreach ($legendas as $militar){
			$codigos[$militar['Militar']['id']] = $militar['MilitarsEscala']['codigo'];
			$todos.= $militar['MilitarsEscala']['codigo'].' ';
			$milico[$militar['Militar']['id']]['codigo'] = $militar['MilitarsEscala']['codigo'];
			$milico[$militar['Militar']['id']]['nome'] = $militar[0]['nome'];
			$milico[$militar['Militar']['id']]['horas'] = 0;
			$milico[$militar['Militar']['id']]['saram'] = $militar['Militar']['saram'];
		}

		//exit();
		$milico[0]['codigo'] = '--';
		$milico[0]['nome'] = '--';
		$milico[0]['horas'] = 0;
		$milico[0][0]['dias'] = '';
		$codigos[0]='--';


		//------------------------------------------------------------------
		$conta = 0;
		$datasAfastados[0]['codigo'] = 0;
		$datasAfastados[0]['dt_inicio'] = 0;
		$datasAfastados[0]['dt_termino'] = 0;
		$datasAfastados[0]['numeroHoras'] = '';
		$datasAfastados[0]['nomeInstrucao'] = '';
		
		foreach($afastamento as $afastamentos){
			if(($afastamentos['Afastamento']['motivo']!='SERVIÇO RISAER')&&($afastamentos['Afastamento']['motivo']!='ADJ OFICIAL DIA')&&($afastamentos['Afastamento']['motivo']!='ADJ OFICIAL OPERAÇÕES')&&($afastamentos['Afastamento']['motivo']!='OFICIAL DE DIA')&&($afastamentos['Afastamento']['motivo']!='COMANDANTE DA GUARDA')&&($afastamentos['Afastamento']['motivo']!='SARGENTO DE DIA')){
				$datasAfastados[$conta]['motivo'] = $afastamentos['Afastamento']['motivo'];
				$datasAfastados[$conta]['codigo'] = $codigos[$afastamentos['Militar']['id']];
				$datasAfastados[$conta]['numeroHoras'] = $codigos[$afastamentos['Afastamento']['numeroHoras']];
				$datasAfastados[$conta]['nomeInstrucao'] = $codigos[$afastamentos['Afastamento']['nomeInstrucao']];
				$datasAfastados[$conta]['dt_inicio'] = strtotime($afastamentos['Afastamento']['dt_inicio']);
				$datasAfastados[$conta]['dt_termino'] = strtotime($afastamentos['Afastamento']['dt_termino']);
				$conta++;
			}
		}
		//------------------------------------------------------------------

		$todos = explode(' ',$todos);

		$totalcodigos = count($codigos);
		$posicaoselected = $totalcodigos + 1;

		$cumprimento = 0;


		$dtIni = strtotime("$dta/$dtm/1");


		$dia_semana =date('N',$dtIni);

		$qtd_dias = date('t', $dtIni);

		$sab = iconv('UTF-8','ISO-8859-1','SÁB');

		$semana = array(1=>'SEG', 2=>'TER', 3=>'QUA', 4=>'QUI', 5=>'SEX', 6=>$sab, 7=>'DOM');

		$ini = 50;
		for ($c=1;$c<=$qtd_dias;$c++){
			$dtIni = strtotime("$dta/$dtm/$c");
			$dia_semana =date('N',$dtIni);

			$this->SetXY(20,$ini);
			$this->SetFont('Arial','B',8);
			if($c<=9){$c = '0'.$c;}
			$this->Cell(7,4,$c,1,0,'C');
			$this->Cell(7,4,$semana[$dia_semana],1,0,'C');
			$this->SetFont('Arial','',5);
			if($max>45){
				$this->SetFont('Arial','',5);
			}

			$obs = '';
			$temp = implode(' ',$todos);
			$temp2 = '';
			foreach ($turnos as $turno){
				$conteudo = '';
					
				for ($l=1;$l<=$turno['Turno']['qtd'];$l++){
					if($selprev=='p'){
						$k = $preenche[$cumprimento]['CumprimentoEscala']['previsto'];
						$milico[$k]['horas'] += round($t[$turno['Turno']['id']]['horas'],2);
						$milico[$k][$turno['Turno']['id']]['horas'] = $t[$turno['Turno']['id']]['horas'];
						$milico[$k][$turno['Turno']['id']]['qtd'] += 1;
						$milico[$k][$turno['Turno']['id']]['dias'] .=  $preenche[$cumprimento]['CumprimentoEscala']['dia'].' ,';
					}else{
						$k = $preenche[$cumprimento]['CumprimentoEscala']['cumprido'];
						$milico[$k]['horas'] += $t[$turno['Turno']['id']]['horas'];
						$milico[$k][$turno['Turno']['id']]['horas'] = round($t[$turno['Turno']['id']]['horas'],2);
						$milico[$k][$turno['Turno']['id']]['qtd'] += 1;
						$milico[$k][$turno['Turno']['id']]['dias'] .=  $preenche[$cumprimento]['CumprimentoEscala']['dia'].' ,';
					}

					if($k==0){
						$conteudo .= ' ';
						//						$temp = str_replace($preenche[$cumprimento]['MilitarsEscala']['codigo'].' ','',$temp);
					}else{
						$conteudo .= $codigos[$k].' ';
						$temp = str_replace($codigos[$k].' ','',$temp);
					}

					$obs .= $preenche[$cumprimento][0]['obs'].' ';
					$cumprimento++;
				}
				$conteudo = trim($conteudo);

				$this->Cell($tamanhos[$turno['Turno']['id']]['tamanho'],4,$conteudo,1,0,'C');
			}

			$obs = '';
			$dtReferencia = strtotime("$dta/$dtm/$c");

			foreach($datasAfastados as $afastado){
				$dif1 = $afastado['dt_inicio'] - $dtReferencia;
				$dif2 = $afastado['dt_termino'] - $dtReferencia;
				if(($dif1<=0)&&($dif2>=0)){
					$obs.= $afastado['codigo'].' ';
				}
			}


			$obs = array_unique(explode(' ',$obs));
			$temp = array_unique(explode(' ',$temp));
			$temp = array_diff($temp, $obs);

			$temp = implode(' ',$temp);
			$obs = implode(' ',$obs);

			$this->SetFont('Arial','',4);
			$this->Cell($folga,4,$temp,1,0,'L');

			if($obs!=''){
				$this->Cell($tobs,4,'',1,0,'C');
				//$this->Cell(28,5,$obs,1,0,'C');
			}
			else{
				$this->Cell($tobs,4,'',1,0,'C');
			}
			$ini += 4;
			//$dtIni += strtotime('+1 day');
			//$dia_semana =date('N',$dtIni);
		}


		$this->SetFont('Arial','B',10);
		$this->SetXY(20,$ini);
		$this->Cell($tampagina,5,iconv('UTF-8','ISO-8859-1','LEGENDAS'),1,0,'C');
		$this->SetFont('Arial','',10);
		$ini+=5;

		$this->SetFont('Arial','B',8);
		$this->SetXY(20,$ini);
		$this->SetFillColor(200,200,200);
		$this->SetTextColor(0,0,0);
		$this->Cell(7,4,iconv('UTF-8','ISO-8859-1','CÓD'),1,0,'C',1);
		$this->Cell(34,4,'OPERADOR',1,0,'C');
		$this->Cell(17,4,'INDICATIVO',1,0,'C');
		$this->Cell(7,4,iconv('UTF-8','ISO-8859-1','CÓD'),1,0,'C',1);
		$this->Cell(34,4,'OPERADOR',1,0,'C');
		$this->Cell(17,4,'INDICATIVO',1,0,'C');
		$this->Cell(7,4,iconv('UTF-8','ISO-8859-1','CÓD'),1,0,'C',1);
		$this->Cell(34,4,'OPERADOR',1,0,'C');
		$this->Cell(17,4,'INDICATIVO',1,0,'C');

		$ini+=4;
		$this->SetFont('Arial','',6);


		$nq = count($escala['Militar']) / 3;
		$nr = count($escala['Militar']) % 3;
		$n = 0;


		$linha = '';

		$this->SetXY(20,$ini);

		$max = count($legendas);
		$tam = 4.2;
		if($max>45){
			$this->SetFont('Arial','',$tam);
		}

		$x = 20;

		foreach ($legendas as $militar){

			if($max>45){
				$this->SetXY($x,$ini);
				$this->MultiCell(7,$tam,iconv('UTF-8','ISO-8859-1',$militar['MilitarsEscala']['codigo']),1,'C',1);
				$x+=7;
				$this->SetXY($x,$ini);
				$this->MultiCell(34,$tam,iconv('UTF-8','ISO-8859-1',$militar[0]['nome']),1,'C');
				$x+=34;
				$this->SetXY($x,$ini);
				$this->MultiCell(17,$tam,iconv('UTF-8','ISO-8859-1',$militar['Militar']['indicativo']),1,'C');
				$x+=17;
			}else{
				$this->SetXY($x,$ini);
				$this->MultiCell(7,4,iconv('UTF-8','ISO-8859-1',$militar['MilitarsEscala']['codigo']),1,'C',1);
				$x+=7;
				$this->SetXY($x,$ini);
				$this->MultiCell(34,4,iconv('UTF-8','ISO-8859-1',$militar[0]['nome']),1,'C');
				$x+=34;
				$this->SetXY($x,$ini);
				$this->MultiCell(17,4,iconv('UTF-8','ISO-8859-1',$militar['Militar']['indicativo']),1,'C');
				$x+=17;
			}

			$n++;

			if($n==3){
				$n=0;
				if($max>45){
					$ini +=$tam;
					$x=20;
					$this->SetXY(20,$ini);
				}else{
					$x=20;
					$ini +=4;
					$this->SetXY(20,$ini);
				}
			}

		}
		if($n>0){
			for($i=$n;$i<3;$i++){
				if($max>45){
					$this->SetXY($x,$ini);
					$this->MultiCell(7,$tam,'',1,'C',1);
					$x+=7;
					$this->SetXY($x,$ini);
					$this->MultiCell(34,$tam,'',1,'C');
					$x+=34;
					$this->SetXY($x,$ini);
					$this->MultiCell(17,$tam,'',1,'C');
					$x+=17;
				}else{
					$this->SetXY($x,$ini);
					$this->MultiCell(7,4,'',1,'C',1);
					$x+=7;
					$this->SetXY($x,$ini);
					$this->MultiCell(34,4,'',1,'C');
					$x+=34;
					$this->SetXY($x,$ini);
					$this->MultiCell(17,4,'',1,'C');
					$x+=17;
				}
			}

		}

		$this->AddPage();
		$this->Rect(20,20,$tampagina,260);
		$assinatura_escalante = '';
		$assinatura_chefe_local = '';
		$assinatura_comandante = '';

		if($podeexibirrascunho){

			if($idescalante>0){
				if(file_exists($caminho.'webroot/pdf/assina'.$idescalante.'.jpg')){
					//$this->Image($caminho.'webroot/pdf/assina'.$idescalante.'.jpg',140,190,40,5.7);
					$assinatura_escalante =  $caminho.'webroot/pdf/assina'.$idescalante.'.jpg';
				}
			}
			if($idchefe>0){
				if(file_exists($caminho.'webroot/pdf/assina'.$idchefe.'.jpg')){
					//$this->Image($caminho.'webroot/pdf/assina'.$idchefe.'.jpg',140,240,40,5.7);
					$assinatura_chefe_local = $caminho.'webroot/pdf/assina'.$idchefe.'.jpg';
				}
			}




			if(((preg_match($p1, $t01))||(preg_match($p2, $t01))||(preg_match($p3, $t01)))&&($novoPDF<=200908)){
				if(file_exists($caminho.'webroot/pdf/assina'.$idchefe.'.jpg')){
					//$this->Image($caminho.'webroot/pdf/assina'.$idchefe.'.jpg',140,260,40,5.7);
					$assinatura_comandante = $caminho.'webroot/pdf/assina'.$idchefe.'.jpg';
				}
			}else{
				if($assinacomandante>0){
					//$this->Image('img/assinaturacmt.jpg',140,260,18,8);
					$assinatura_comandante = 'img/assinaturacmt.jpg';
				}
			}

		}


		if($rascunho==1){
			$this->SetFont('Arial','B',28);
			$this->SetTextColor(200,200,200);
			$this->RotatedText(10,250,'RASCUNHO - AGUARDA ASSINATURA DO CHF REGIONAL',45);
			$max = count($legendas);
			$this->SetTextColor(0,0,0);
		}

		/*
		 $this->RotatedImage($caminho, 170, 190, 100, 16, 90);
		 */
		$this->SetFont('Arial','B',8);

		$this->SetXY(20,20);
		$this->Cell($tampagina,4,iconv('UTF-8','ISO-8859-1','ESPAÇO RESERVADO PARA OBSERVAÇÕES QUE SE FAÇAM NECESSÁRIAS'),1,0,'L');
		$this->SetXY(20,$this->GetY()+4);

		if($selprev=='p'){
			if($preenche[0]['EscalasMonth']['hora_instrucao']>0){
				$item3 = '3.1 Hora Instrução: '.$preenche[0]['EscalasMonth']['hora_instrucao'].' horas - '.$preenche[0]['EscalasMonth']['obs_hora_instrucao']."\r\n";
				$conta3 = 1;
			}else{
				$conta3 = 0;
				$item3 = '';
			}

			$obs1 = $verso[0]['Versoescala']['item1'];
			//$obs2 = $verso[0]['Versoescala']['naoconformidades']." | ".$verso[0]['Versoescala']['item2'];
			$obs2 = str_replace('undefined','',$verso[0]['Versoescala']['naoconformidades'])." | ".str_replace('undefined','',$verso[0]['Versoescala']['item2']);
			$obs3 = $verso[0]['Versoescala']['item3'];
		}else{

			if($preenche[0]['EscalasMonth']['hora_instrucao']>0){
				$item3 = '3.1 Hora Instrução: '.$preenche[0]['EscalasMonth']['hora_instrucao'].' horas - '.$preenche[0]['EscalasMonth']['obs_hora_instrucao']."\r\n";
				$conta3 = 1;
			}else{
				$conta3 = 0;
				$item3 = '';
			}
				

			$obs1 = $verso[0]['Versoescala']['item4'];
			$obs2 = str_replace("\n",'  ',$verso[0]['Versoescala']['naoconformidades'])." | ".str_replace("\n",'  ',$verso[0]['Versoescala']['item5']);
			$obs3 = $verso[0]['Versoescala']['item6'];
		}

		$obs1 = str_replace('undefined','',$obs1);
		$obs2 = str_replace('undefined','',$obs2);
		$obs3 = str_replace('undefined','',$obs3);

		//$preenche[0]['EscalasMonth']['media_hora_prevista']
		$obsafastamento = '';

		$item3 = iconv('UTF-8','ISO-8859-1',$item3);

		$conta2 = 0;
		$conta4 = 0;
		$conta5 = 0;
		$item2 = '';
		$item4 = '';
		$item5 = '';
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);

		//$item3 = print_r($afastamento);
		
				if($selprev=='p'){
					$nenhum = 'Não previsto.';
				}else{
					$nenhum = 'Não houve.';
				}
		
		$conta21 = 0;
		$p21 = '/OFICIAL DE DIA/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
				
			if((preg_match($p21, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item21 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta21 ++;
					$item21 .= "\r\n".$afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}

			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}		
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta22 = 0;
		$p22 = '/ADJ OFICIAL DIA/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
				
			if((preg_match($p22, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item22 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta22 ++;
					$item22 .= "\r\n";
					$item22 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}		
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta23 = 0;
		$p23 = '/ADJ OFICIAL OPERAÇÕES/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p23, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item23 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta23 ++;
					$item23 .= "\r\n";
					$item23 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta24 = 0;
		$p24 = '/SARGENTO DE DIA/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p24, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item24 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta24 ++;
					$item24 .= "\r\n";
					$item24 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta25 = 0;
		$p25 = '/COMANDANTE DA GUARDA/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p25, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item25 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta25 ++;
					$item25 .= "\r\n";
					$item25 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$p26 = '/SERVIÇO RISAER/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p26, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item25 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta25 ++;
					$item25 .= "\r\n";
					$item25 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta30 = 0;
		
		if($preenche[0]['EscalasMonth']['hora_instrucao']>0){
			$item30 = "".$preenche[0]['EscalasMonth']['hora_instrucao'].' horas - '.$preenche[0]['EscalasMonth']['obs_hora_instrucao'];
			$conta30 = 1;
		}else{
			$conta30 = 0;
			$item30 = '';
		}
		
		$p30 = '/INSTRUÇÃO NA OM/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p30, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
				//	$item30 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino'])).' - Horas:'.$afastado['Afastamento']['numeroHoras'].' - Instrução:'.$afastado['Afastamento']['nomeInstrucao'];
				}else{
				//	$conta30 ++;
				//	$item30 .= "\r\n";
				//	$item30 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino'])).' - Horas:'.$afastado['Afastamento']['numeroHoras'].' - Instrução:'.$afastado['Afastamento']['nomeInstrucao'];
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta41 = 0;
		$p41 = '/^FÉRIAS/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p41, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item41 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta41 ++;
					$item41 .= "\r\n";
					$item41 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta42 = 0;
		$p42 = '/LICENÇA ESPECIAL/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p42, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item42 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta42 ++;
					$item42 .= "\r\n";
					$item42 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta43 = 0;
		$p43 = '/LICENÇA PARA TRATAR DE INTERESSE PARTICULAR/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p43, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item43 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino'])).' - '.$afastado['Afastamento']['obs'];
				}else{
					$conta43 ++;
					$item43 .= "\r\n";
					$item43 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino'])).' - '.$afastado['Afastamento']['obs'];
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta44 = 0;
		$p44 = '/LICENÇA PARA TRATAMENTO DE SAÚDE PRÓPRIA/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p44, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item44 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta44 ++;
					$item44 .= "\r\n";
					$item44 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta45 = 0;
		$p45 = '/LICENÇA PARA TRATAMENTO DE SAÚDE DE DEPENDENTES/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p45, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item45 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta45 ++;
					$item45 .= "\r\n";
					$item45 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta46 = 0;
		$p46 = '/LICENÇA PATERNIDADE/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p46, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item46 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta46 ++;
					$item46 .= "\r\n";
					$item46 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta47 = 0;
		$p47 = '/LICENÇA-MATERNIDADE/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p47, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item47 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta47 ++;
					$item47 .= "\r\n";
					$item47 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta48 = 0;
		$p48 = '/DISPENSA COMO RECOMPENSA/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p48, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item48 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta48 ++;
					$item48 .= "\r\n";
					$item48 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta49 = 0;
		$item49 = '';
		$p49 = '/DISPENSA PARA DESCONTO EM FÉRIAS/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p49, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item49 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta49 ++;
					$item49 .= "\r\n";
					$item49 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta410 = 0;
		$p410 = '/DISPENSA EM DECORRÊNCIA DE PRESCRIÇÃO MÉDICA/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p410, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item410 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta410 ++;
					$item410 .= "\r\n";
					$item410 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta411 = 0;
		$p411 = '/NÚPCIAS/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p411, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item411 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta411 ++;
					$item411 .= "\r\n";
					$item411 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta412 = 0;
		$p412 = '/LUTO/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p412, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item412 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta412 ++;
					$item412 .= "\r\n";
					$item412 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta413 = 0;
		$p413 = '/INSTALAÇÃO/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p413, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item413 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta413 ++;
					$item413 .= "\r\n";
					$item413 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta414 = 0;
		$p414 = '/CURSO/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p414, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item414 .= ' - '.$t01.' '.$afastado['Afastamento']['obs'].' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta414 ++;
					$item414 .= "\r\n";
					$item414 .= $afastado[0]['nome'].' - '.$t01.' '.$afastado['Afastamento']['obs'].' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta415 = 0;
		$p415 = '/INSPEÇÃO DE SAÚDE/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p415, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item415 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta415 ++;
					$item415 .= "\r\n";
					$item415 .= $afastado[0]['nome'].' - '.$t01.'(SOMENTE CZ, GM, MQ, RB, SL, SN, TT, UA, BV(BCT) e PV(BCT)) de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta416 = 0;
		$p416 = '/CUMPRIMENTO DE ORDEM DE SERVIÇO/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p416, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item416 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta416 ++;
					$item416 .= "\r\n";
					$item416 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		$p416 = '/COMISSIONAMENTO/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p416, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item416 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta416 ++;
					$item416 .= "\r\n";
					$item416 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta417 = 0;
		$p417 = '/DISPENSA POR MOTIVO DE FORÇA MAIOR/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p417, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item417 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta417 ++;
					$item417 .= "\r\n";
					$item417 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta418 = 0;
		$p418 = '/DISPENSA POR ORDEM SUPERIOR/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p418, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item418 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta418 ++;
					$item418 .= "\r\n";
					$item418 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta419 = 0;
		$p419 = '/MILITAR DE OUTRA OM PRESTANDO SERVIÇO/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p419, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item419 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta419 ++;
					$item419 .= "\r\n";
					$item419 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta420 = 0;
		$p420 = '/MUDANÇA/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p420, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item420 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta420 ++;
					$item420 .= "\r\n";
					$item420 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta421 = 0;
		$p421 = '/TRANSFERIDO/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p421, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item421 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta421 ++;
					$item421 .= "\r\n";
					$item421 .= $afastado[0]['nome'].' - '.$t01.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		

		$anterior =$afastado[0][0]['nome'];
		$motivoanterior=strtoupper($afastado[0]['Afastamento']['motivo']);
		$conta500 = 0;
		$p500 = '/EXPEDIENTE/';
		foreach($afastamento as $afastado){
			$t01 = strtoupper($afastado['Afastamento']['motivo']);
			if((preg_match($p500, $t01))){
				if($anterior.$motivoanterior==$afastado[0]['nome'].$t01){
					$item500 .= ', de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}else{
					$conta500 ++;
					$item500 .= "\r\n";
					$item500 .= $afastado[0]['nome'].' - '.' de '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_inicio'])).' até '.strftime('%d/%m/%Y',strtotime($afastado['Afastamento']['dt_termino']));
				}
			}
			$anterior = $afastado[0]['nome'];
			$motivoanterior=strtoupper($afastado['Afastamento']['motivo']);
		}
		
		
		
		//CURSO EXPEDIENTE RISAER

		$this->SetFont('Arial','B',8);
		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1','1. ADJUNTO'),0,'L',0);
		$this->SetXY(20,$this->GetY());
		$this->SetFont('Arial','',6);
		if(!empty($verso[0]['Versoescala']['adjunto'])){
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',''.$verso[0]['Versoescala']['adjunto'].' - '.$verso[0]['Versoescala']['adjunto_obs']."\r\n"),0,'L',0);
		}else{
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}

		$this->SetXY(20,$this->GetY());
		$this->SetFont('Arial','B',8);
		//$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1','2. FÉRIAS/LESP/NÚPCIAS/LUTO/COMISSIONAMENTO/RISAER'),0,'L',0);
		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1','2. SERVIÇOS INDIVIDUAIS RISAER'."\r\n"),0,'L',0);
		$this->SetFont('Arial','',6);
		if(($conta21==0)&&($conta22==0)&&($conta23==0)&&($conta24==0)&&($conta25==0)){
			$this->SetXY(20,$this->GetY()-4);
			//$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item21."\r\n"),0,'L',0);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','2.1 OFICIAL DE DIA'),0,'L',0);
		//$this->SetXY(20,$this->GetY()-4);
		$this->SetFont('Arial','',6);
		if($conta21>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item21."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}


		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','2.2 ADJUNTO AO OFICIAL DE DIA'),0,'L',0);
		//$this->SetXY(20,$this->GetY()-4);
		$this->SetFont('Arial','',6);
		if($conta22>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item22."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}


		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','2.3 ADJUNTO AO OFICIAL DE OPERAÇÕES'),0,'L',0);
		//$this->SetXY(20,$this->GetY()-4);
		$this->SetFont('Arial','',6);
		if($conta23>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item23."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}


		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','2.4 SARGENTO DE DIA'),0,'L',0);
		//$this->SetXY(20,$this->GetY()-4);
		$this->SetFont('Arial','',6);
		if($conta24>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item24."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}


		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','2.5 COMANDANTE DA GUARDA'),0,'L',0);
		//$this->SetXY(20,$this->GetY()-4);
		$this->SetFont('Arial','',6);
		if($conta25>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item25."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}

		
		$this->SetXY(20,$this->GetY());
		$this->SetFont('Arial','B',8);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','3. INSTRUÇÕES/CURSOS'),0,'L',0);
		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1','3. INSTRUÇÃO NA OM'."\r\n"),0,'L',0);
		//$this->SetXY(20,$this->GetY()-4);
		$this->SetFont('Arial','',6);
		if($conta30>0){
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item30."\r\n"),0,'L',0);
		}else{
			//$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',"$nenhum"),0,'L',0);
		}

		
		$this->SetXY(20,$this->GetY());
		$this->SetFont('Arial','B',8);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4. SERVIÇO RISAER'),0,'L',0);
		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1','4. AFASTAMENTOS DA ESCALA'."\r\n"),0,'L',0);
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.1 FÉRIAS'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta41>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item41."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}

		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.2 LICENÇA ESPECIAL'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta42>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item42."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.3 LICENÇA PARA TRATAR DE INTERESSE PARTICULAR'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta43>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item43."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.4 LICENÇA PARA TRATAMENTO DE SAÚDE PRÓPRIA'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta44>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item44."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.5 LICENÇA PARA TRATAMENTO DE SAÚDE DE DEPENDENTES'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta45>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item45."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.6 LICENÇA PATERNIDADE'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta46>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item46."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.7 LICENÇA-MATERNIDADE'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta47>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item47."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.8 DISPENSA COMO RECOMPENSA'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta48>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item48."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.9 DISPENSA PARA DESCONTO EM FÉRIAS'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta49>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item49."\r\n"),0,'L',0);
		}else{
		//	$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.10 DISPENSA EM DECORRÊNCIA DE PRESCRIÇÃO MÉDICA'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta410>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item410."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.11 NÚPCIAS'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta411>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item411."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.12 LUTO'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta412>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item412."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.13 INSTALAÇÃO'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta413>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item413."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.14 CURSO'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta414>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item414."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.15 INSPEÇÃO DE SAÚDE (SOMENTE CZ, GM, MQ, RB, SL, SN, TT, UA, BV(BCT) e PV(BCT))'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta415>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item415."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.16 CUMPRIMENTO DE ORDEM DE SERVIÇO'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta416>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item416."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.17 DISPENSA POR MOTIVO DE FORÇA MAIOR'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta417>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item417."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.18 DISPENSA POR ORDEM SUPERIOR'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta418>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item418."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.19 MILITAR DE OUTRA OM PRESTANDO SERVIÇO'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta419>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item419."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.20 MUDANÇA DE ESCALA'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta420>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item420."\r\n"),0,'L',0);
		}else{
			//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		//$this->SetXY(20,$this->GetY());
		//$this->SetFont('Arial','B',6);
		//$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1','4.21 TRANSFERIDO'),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta421>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item421."\r\n"),0,'L',0);
		}else{
		//	$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}
		
		


		$this->SetXY(20,$this->GetY());
		$this->SetFont('Arial','B',8);
		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1','5. EXPEDIENTE ADMINISTRATIVO'."\r\n"),0,'L',0);
		$this->SetFont('Arial','',6);
		if($conta500>0){
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$item500."\r\n"),0,'L',0);
		}else{
			$this->SetXY(20,$this->GetY()-4);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',"\r\n$nenhum"),0,'L',0);
		}


		$this->SetXY(20,$this->GetY());
		$this->SetFont('Arial','B',8);
		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1','6. OBSERVAÇOES'),0,'L',0);
		$this->SetXY(20,$this->GetY());
		$this->SetFont('Arial','',6);
		if(preg_match("/[a-zA-Z]/",$obs1)||preg_match("/[a-zA-Z]/",$outraOM)){
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$obs1.$outraOM),0,'L',0);
		}else{
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',"$nenhum\r\n"),0,'L',0);
		}

		$this->Rect(20,20,$tampagina,260);
		//$this->SetXY(20,194);
		if($this->GetY()>250){
			$this->AddPage();
		}

		if(!empty($assinatura_escalante)){
			$this->Image($assinatura_escalante,140,$this->GetY(),40,5.7);
		}

		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',"\n".$preenche[0]['EscalasMonth']['nm_escalante']),0,'R',0);

		$this->SetFont('Arial','B',8);
		//$this->SetXY(20,200);
		$this->SetXY(20,$this->GetY());
		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',"ALTERAÇÕES NA ESCALA"),1,'L',0);
		//$this->Cell(168,4,iconv('UTF-8','ISO-8859-1','ALTERAÇÕES NA ESCALA'),1,0,'L');
		$this->SetXY(20,$this->GetY());
		$this->SetFont('Arial','',6);
		if($selprev=='p'){
			$obs2 = '';
		}

		$obs2 = str_replace('Substituição ','|',$obs2);


		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$obs2),0,'J',0);

		$this->Rect(20,20,$tampagina,260);
		if($this->GetY()>250){
			$this->AddPage();
		}

		if(!empty($assinatura_chefe_local)){
			$this->Image($assinatura_chefe_local,140,$this->GetY(),40,5.7);
		}
		//$this->SetXY(20,244);
		$this->MultiCell(165,4,iconv('UTF-8','ISO-8859-1',"\n".$preenche[0]['EscalasMonth']['nm_chefe_orgao']),0,'R',0);

		$this->Rect(20,20,$tampagina,260);
		if($this->GetY()>250){
			$this->AddPage();
		}

		$this->SetFont('Arial','B',8);
		//$this->SetXY(20,250);
		$this->SetXY(20,$this->GetY());
		//$this->Cell(168,4,iconv('UTF-8','ISO-8859-1','OBSERVAÇOES DO COMANDANTE'),1,0,'L');
		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',"OBSERVAÇOES DO COMANDANTE"),1,'L',0);
		$this->SetXY(20,$this->GetY()+4);
		$this->SetFont('Arial','',6);
		$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',$obs3),0,'J',0);



		if(!empty($assinatura_comandante)){
			$this->Image($assinatura_comandante,140,$this->GetY(),40,5.7);
		}

		//$this->SetXY(20,264);
		$this->MultiCell(165,4,iconv('UTF-8','ISO-8859-1',"\n".$preenche[0]['EscalasMonth']['nm_comandante']),0,'R',0);
		$this->Rect(20,20,$tampagina,260);

		//		$this->Cell(170,260,'',1,0,'C');
		//		$this->SetXY(20,20);
		//		$this->Cell(168,250,' ',1,0,'C');




		$this->AddPage();
		$this->SetFont('Arial','B',8);
		$this->SetXY(20,73);
		$this->Cell($tampagina,4,iconv('UTF-8','ISO-8859-1','OPERADORES'),0,0,'C');
		$this->SetXY(25,28);
		$this->MultiCell(2,3,iconv('UTF-8','ISO-8859-1','CARGA HORÁRIA'),0,0,'C');

		$this->SetFillColor(200,200,200);
		$this->SetXY(40,29);
		$this->Cell(140,40,iconv('UTF-8','ISO-8859-1',''),1,0,'C',1);

		if($rascunho==1){
			$this->SetFont('Arial','B',28);
			$this->SetTextColor(200,200,200);
			$this->RotatedText(10,250,'RASCUNHO - AGUARDA ASSINATURA DO CHF REGIONAL',45);
			$max = count($legendas);
			$this->SetTextColor(0,0,0);
		}

		$this->SetFont('Arial','B',10);
		$this->SetXY(20,20);
		$this->Cell($tampagina,4,iconv('UTF-8','ISO-8859-1','CARGA DE TRABALHO DA ESCALA =>'.$unidade[0]['Unidade']['sigla_unidade'].' - '.strtoupper($unidade[0]['Setor']['sigla_setor']).' - '.strtoupper($selprev)),1,0,'C');
		$this->SetXY(20,24);
		$this->Cell($tampagina,60,iconv('UTF-8','ISO-8859-1',' '),1,0,'C');
		$this->SetXY(20,86);
		$this->SetFont('Arial','',10);
		$ini = $this->GetY();

		$this->SetFont('Arial','B',8);
		$this->SetXY(20,$ini);
		$this->SetFillColor(200,200,200);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','B',6);
		$this->Cell(50,4,iconv('UTF-8','ISO-8859-1','LEGENDA/NOME'),1,0,'C',1);
		$this->Cell(7,4,'TOTAL',1,0,'C',1);

		$tamanho = round(95/$qtd_turnos);

		foreach($turnos as $turno){
			$milico[$militar['Militar']['id']][$turno['Turno']['id']]['horas'] = round($t[$turno['Turno']['id']]['horas'],2);
			//$milico[$militar['Militar']['id']][$turno['Turno']['id']]['qtd'] += 1;
			$this->Cell($tamanho,4,round($t[$turno['Turno']['id']]['horas'],2),1,0,'C',1);

		}
		//$milico[$militar['Militar']['id']][$turno['Turno']['id']]['qtd'] -= 1;

		$this->Cell(16,4,iconv('UTF-8','ISO-8859-1','HORAS'),1,0,'C',1);

		$ini+=4;
		$this->SetFont('Arial','',8);

		$linha = '';

		$this->SetXY(20,$ini);
		$cor = 1;
		$grafico[0]['legenda'] = '';
		$grafico[0]['horas'] = 0;
		$contagrafico = 0;

		$maximo = 0;

		foreach ($legendas as $militar){
			if($cor>0){
				$this->SetFillColor(230,230,230);

			}else{
				$this->SetFillColor(255,255,255);

			}
			$cor *= -1;

			$total = 0;
			foreach($turnos as $turno){
				$total += $milico[$militar['Militar']['id']][$turno['Turno']['id']]['qtd'];
			}
			if($milico[$militar['Militar']['id']]['horas']>=floor(((1.2)*$mediagrafico))){
				$this->SetFillColor(101,174,55);
			}

			if($milico[$militar['Militar']['id']]['horas']<=floor(((0.8)*$mediagrafico))){
				$this->SetFillColor(229,121,55);
			}


			$grafico[$contagrafico]['legenda'] = $milico[$militar['Militar']['id']]['codigo'];
			$grafico[$contagrafico]['horas'] = $milico[$militar['Militar']['id']]['horas'];
			$contagrafico ++;

			if($max>45){
				$this->SetFont('Arial','',4);
				$this->Cell(7,3,iconv('UTF-8','ISO-8859-1',$milico[$militar['Militar']['id']]['codigo']),1,0,'L',1);
				$this->Cell(43,3,iconv('UTF-8','ISO-8859-1',$milico[$militar['Militar']['id']]['nome']),1,0,'L',1);
				$this->Cell(7,3,$total,1,0,'C',1);
			}else{
				$this->Cell(7,4,iconv('UTF-8','ISO-8859-1',$milico[$militar['Militar']['id']]['codigo']),1,0,'L',1);
				$this->Cell(43,4,iconv('UTF-8','ISO-8859-1',$milico[$militar['Militar']['id']]['nome']),1,0,'L',1);
				$this->Cell(7,4,$total,1,0,'C',1);
			}
			foreach($turnos as $turno){
				if($max>45){
					$this->Cell($tamanho,3,$milico[$militar['Militar']['id']][$turno['Turno']['id']]['qtd'],1,0,'C',1);
				}else{
					$this->Cell($tamanho,4,$milico[$militar['Militar']['id']][$turno['Turno']['id']]['qtd'],1,0,'C',1);
				}

			}


			if($max>45){
				$this->Cell(16,3,iconv('UTF-8','ISO-8859-1',round($milico[$militar['Militar']['id']]['horas'],2)),1,0,'C',1);
			}else{
				$this->Cell(16,4,iconv('UTF-8','ISO-8859-1',round($milico[$militar['Militar']['id']]['horas'],2)),1,0,'C',1);
			}
			if($maximo<$milico[$militar['Militar']['id']]['horas']){
				$maximo = $milico[$militar['Militar']['id']]['horas'];
			}
			if($max>45){
				$ini = $this->GetY()+3;
			}else{
				$ini = $this->GetY()+4;
			}
			$this->SetXY(20,$ini);



		}
		$mediagrafico = round($mediagrafico,0);

		if($mediagrafico==0)$mediagrafico=1;
		$mediaantes = $mediagrafico;
		if($mediagrafico>$maximo){
			$mediagrafico = $mediagrafico;
		}else{
			$mediagrafico = $maximo;
		}

		$y = 69;
		$this->SetXY(42,$y);

		$this->SetLineWidth(2);


		for($x=0;$x<$contagrafico;$x++){
			if($max<45){
				$this->SetFont('Arial','',6);
				$this->Write(3,'  '.$grafico[$x]['legenda']);
			}else{
				$this->SetFont('Arial','',4);
				$this->Write(3,' '.$grafico[$x]['legenda']);
			}
			$k = round(($grafico[$x]['horas']*40)/$mediagrafico)-1;
			if($k==-1)$k=1;
			$this->SetDrawColor(100,100,100);
			if($grafico[$x]['horas']>=floor(((1.2)*$mediaantes))){
				$this->SetDrawColor(101,174,55);
			}

			if($grafico[$x]['horas']<=floor(((0.8)*$mediaantes))){
				$this->SetDrawColor(229,121,55);
			}

			$this->Line($this->GetX(),$this->GetY()-1,$this->GetX(),$this->GetY()-$k);
		}

		$this->SetFont('Arial','',8);

		$this->SetDrawColor(100,100,100);
		$this->SetLineWidth(0.5);
		$k = round(($mediaantes*40)/$mediagrafico)-1;
		$this->Line(40,69 - $k,180 ,69 - $k);


		$this->SetXY(35,28);
		$this->Cell(6,4,$mediagrafico,0,0,'R');
		$y = 28;
		$fracao = round($mediagrafico/8);
		for($i=0;$i<7;$i++){
			$y += 5;
			$mediagrafico -= $fracao;
			$this->SetXY(35,$y);
			$this->Cell(6,4,$mediagrafico,0,0,'R');

		}

		$qtd_turnos = 0;
		foreach($turnos as $turno){
			if($t[$turno['Turno']['id']]['horas']>=8){
				$qtd_turnos++;
			}

		}
		$tamanho = round(105/$qtd_turnos);

		if(($qtd_turnos>0)&&($selprev=='c')){

			$this->AddPage();
			$this->SetXY(20,20);
			$this->SetFont('Arial','B',10);
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',"SERVIÇO PÚBLICO FEDERAL\r\nQUARTO CENTRO INTEGRADO DE DEFESA AÉREA E CONTROLE DE TRÁFEGO AÉREO\r\n".$unidade[0]['Unidade']['sigla_unidade']."\r\n".$unidade[0]['Setor']['sigla_setor']."\r\nFICHA DE INFORMAÇÕES PARA INDENIZAÇÃO DE ETAPAS DE ALIMENTAÇÃO\n\n"),0,'C',0);

			//-----------------------------------------------------------------------------------------------------
			$ini = $this->GetY()+0.5;
			$this->SetFont('Arial','B',8);
			$this->SetXY(20,$ini);
			$this->SetFillColor(120,120,120);
			$this->Cell(170,4,iconv('UTF-8','ISO-8859-1','REFERÊNCIA  - '.$meses[$dtm].' / '.$dta),1,0,'C',1);
			$ini = $this->GetY()+4;
			$this->SetXY(20,$ini);
			$this->SetFillColor(200,200,200);
			$this->SetTextColor(0,0,0);
			$this->SetFont('Arial','B',6);
			$this->Cell(50,4,iconv('UTF-8','ISO-8859-1','LEGENDA/NOME'),1,0,'C',1);
			$this->SetFont('Arial','B',6);
			$this->Cell(15,4,iconv('UTF-8','ISO-8859-1','SARAM'),1,0,'C',1);


			foreach($turnos as $turno){
				$milico[$militar['Militar']['id']][$turno['Turno']['id']]['horas'] = round($t[$turno['Turno']['id']]['horas'],2);
				$milico[$militar['Militar']['id']][$turno['Turno']['id']]['qtd'] += 1;
				if($t[$turno['Turno']['id']]['horas']>=8){
					$this->Cell($tamanho,4,round($t[$turno['Turno']['id']]['horas'],2),1,0,'C',1);
				}

			}


			$ini+=4;
			$this->SetFont('Arial','',8);

			$linha = '';

			$this->SetXY(20,$ini);
			$cor = 1;
			$grafico[0]['legenda'] = '';
			$grafico[0]['horas'] = 0;
			$contagrafico = 0;

			$maximo = 0;

			foreach ($legendas as $militar){
				if(strpos($milico[$militar['Militar']['id']]['nome'],'R/R')<=0){
					if($cor>0){
						$this->SetFillColor(230,230,230);

					}else{
						$this->SetFillColor(255,255,255);

					}
					$cor *= -1;


					$this->SetFont('Arial','',8);

					$grafico[$contagrafico]['legenda'] = $milico[$militar['Militar']['id']]['codigo'];
					$grafico[$contagrafico]['horas'] = $milico[$militar['Militar']['id']]['horas'];
					$contagrafico ++;

					$this->SetFont('Arial','',6);
					$this->Cell(7,6,iconv('UTF-8','ISO-8859-1',$milico[$militar['Militar']['id']]['codigo']),1,0,'L',1);
					$this->Cell(43,6,iconv('UTF-8','ISO-8859-1',$milico[$militar['Militar']['id']]['nome']),1,0,'L',1);
					$this->Cell(15,6,iconv('UTF-8','ISO-8859-1',$milico[$militar['Militar']['id']]['saram']),1,0,'C',1);
					foreach($turnos as $turno){
						$this->SetFont('Arial','',6);
						if($t[$turno['Turno']['id']]['horas']>=8){
							$this->Cell($tamanho,6,substr($milico[$militar['Militar']['id']][$turno['Turno']['id']]['dias'],0,-1),1,0,'C',1);
						}

					}


					$ini = $this->GetY()+6;
					$this->SetXY(20,$ini);

				}

			}




			$this->SetFont('Arial','',8);
			//$this->SetXY(20,250);
			$dtm  = date('m');
			$this->MultiCell($tampagina,4,iconv('UTF-8','ISO-8859-1',"\n\n\n".$unidade[0]['Cidade']['nome']." , ".date('d')."  de ".$meseslower[$dtm]." de $dta.\r\n\r\n\r\n____________________________________________\r\n$chefe"),0,'R',0);

		}


	}


	function LivroEletronico($escala, $preenche, $turnos, $legendas, $unidade, $dtm, $dta, $selprev, $verso, $afastamento, $consultasql,$podeexibirrascunho)
	{

		$this->AliasNbPages();
		$this->lMargin = 20;
		$this->tMargin = 20;
		$this->bMargin = 35;
		$this->AutoPageBreak = 1;
		$this->Rect(20,20,168,260);
		

		$caminho = substr(__FILE__, 0, strrpos(__FILE__, '/'));
		$caminho = str_replace('views/helpers','',$caminho);

		if(file_exists($caminho.'webroot/img/brasaopb.jpg')){
			$this->Image($caminho.'webroot/img/brasaopb.jpg',100,20.1,10,10);
		}


		//$this->AddPage();
		$this->SetXY(20,30);
		$this->SetFont('Arial','B',10);
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"SERVIÇO PÚBLICO FEDERAL\r\nQUARTO CENTRO INTEGRADO DE DEFESA AÉREA E CONTROLE DE TRÁFEGO AÉREO\r\n"),0,'C',0);
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"DESTACAMENTO DE PROTEÇÃO AO VÔO EDUARDO GOMES\r\n"),0,'C',0);
		$this->SetFont('Arial','BU',10);
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"LIVRO DE OCORRÊNCIAS DO ACC AZ MU\r"),0,'C',0);
		
		//-----------------------------------------------------------------------------------------------------
		$ini = $this->GetY()+0.5;
		$this->SetFont('Arial','B',8);

		$this->SetFillColor(200,200,200);
			
		$this->SetXY(20,$ini);
		$this->Cell(168,4,iconv('UTF-8','ISO-8859-1','I   - RECEBIMENTO DO SERVIÇO'),1,0,'L',1);
		$this->SetXY(20,$this->GetY()+4);
		$this->SetFont('Arial','',6);
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"Recebi-o do 1T QOEA CTA FULANO DE TAL, em ORDEM \n"),0,'L',0);
		$ini = $this->GetY()+4;

		$this->SetXY(20,$ini);
		$this->SetFont('Arial','B',8);
		$this->Cell(168,4,iconv('UTF-8','ISO-8859-1','II  - EQUIPE DE SERVIÇO'),1,0,'L',1);
		$this->SetXY(20,$this->GetY()+4);
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"A) CHEFE DE EQUIPE:"),0,'L',0);
		$ini = $this->GetY()+4;
		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"B) SUPERVISOR:"),0,'L',0);
		$ini = $this->GetY()+4;
		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"C) CONTROLADORES:"),0,'L',0);
		$ini = $this->GetY()+4;
		//-----------------------
		$this->SetXY(30,$ini);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','B',6);
		$this->Cell(7,4,iconv('UTF-8','ISO-8859-1','LEG'),1,0,'L');
		$this->Cell(43,4,iconv('UTF-8','ISO-8859-1','NOME'),1,0,'L');
		$this->Cell(15,4,iconv('UTF-8','ISO-8859-1','SARAM'),1,0,'C');
		
		$ini = $this->GetY()+4;
		$this->SetFont('Arial','',6);
		$this->SetXY(30,$ini);
		$this->Cell(7,4,iconv('UTF-8','ISO-8859-1','A1'),1,0,'L');
		$this->Cell(43,4,iconv('UTF-8','ISO-8859-1','FULANO'),1,0,'L');
		$this->Cell(15,4,iconv('UTF-8','ISO-8859-1','123456'),1,0,'C');
		
		
		$ini = $this->GetY()+4;
		$this->SetFont('Arial','',6);
		$this->SetXY(30,$ini);
		$this->Cell(7,4,iconv('UTF-8','ISO-8859-1','A1'),1,0,'L');
		$this->Cell(43,4,iconv('UTF-8','ISO-8859-1','FULANO'),1,0,'L');
		$this->Cell(15,4,iconv('UTF-8','ISO-8859-1','123456'),1,0,'C');
		
				
		$ini = $this->GetY()+4;
		$this->SetFont('Arial','',6);
		$this->SetXY(30,$ini);
		$this->Cell(7,4,iconv('UTF-8','ISO-8859-1','A1'),1,0,'L');
		$this->Cell(43,4,iconv('UTF-8','ISO-8859-1','FULANO'),1,0,'L');
		$this->Cell(15,4,iconv('UTF-8','ISO-8859-1','123456'),1,0,'C');
		
		$ini = $this->GetY()+4;
		
		foreach($turnos as $turno){
			$milico[$militar['Militar']['id']][$turno['Turno']['id']]['horas'] = round($t[$turno['Turno']['id']]['horas'],2);
			$milico[$militar['Militar']['id']][$turno['Turno']['id']]['qtd'] += 1;
			if($t[$turno['Turno']['id']]['horas']>=8){
				$this->Cell($tamanho,4,round($t[$turno['Turno']['id']]['horas'],2),1,0,'C');
			}

		}


		$ini+=4;
		$this->SetFont('Arial','',8);

		$linha = '';

		$this->SetXY(20,$ini);
		$cor = 1;
		$grafico[0]['legenda'] = '';
		$grafico[0]['horas'] = 0;
		$contagrafico = 0;

		$maximo = 0;

		foreach ($legendas as $militar){
			if(strpos($milico[$militar['Militar']['id']]['nome'],'R/R')<=0){
				if($cor>0){
					$this->SetFillColor(230,230,230);

				}else{
					$this->SetFillColor(255,255,255);

				}
				$cor *= -1;


				$this->SetFont('Arial','',8);

				$grafico[$contagrafico]['legenda'] = $milico[$militar['Militar']['id']]['codigo'];
				$grafico[$contagrafico]['horas'] = $milico[$militar['Militar']['id']]['horas'];
				$contagrafico ++;

				$this->SetFont('Arial','',6);
				$this->Cell(7,6,iconv('UTF-8','ISO-8859-1',$milico[$militar['Militar']['id']]['codigo']),1,0,'L');
				$this->Cell(43,6,iconv('UTF-8','ISO-8859-1',$milico[$militar['Militar']['id']]['nome']),1,0,'L');
				$this->Cell(15,6,iconv('UTF-8','ISO-8859-1',$milico[$militar['Militar']['id']]['saram']),1,0,'C');
				foreach($turnos as $turno){
					$this->SetFont('Arial','',6);
					if($t[$turno['Turno']['id']]['horas']>=8){
						$this->Cell($tamanho,6,substr($milico[$militar['Militar']['id']][$turno['Turno']['id']]['dias'],0,-1),1,0,'C');
					}

				}


				$ini = $this->GetY()+6;
				$this->SetXY(20,$ini);

			}

		}


		//-----------------------

		$this->SetFont('Arial','B',8);
		$this->SetXY(20,$ini);
		$this->Cell(168,4,iconv('UTF-8','ISO-8859-1','III - OCORRÊNCIAS'),1,0,'L',1);
		$ini = $this->GetY()+4;
		$this->SetXY(20,$ini);
		$this->SetFont('Arial','B',8);
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"A) OPERACIONAIS:"),0,'L',0);
		$ini = $this->GetY()+4;


		$this->SetFont('Arial','',6);
		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   1. 1130Z - FAG048 - SBEG/MTPP - YYYYY informou que o APP-BV teria sido informado que a ACFT citada tinha como destino o SBBV. Que informou às autoridades prestadas e o comandante da Base Aérea de Boa Vista, informou que a anv não estava autorizada a pousar. Enfim, verificado que o destino da anv era MTPP foi alertado pelo cto que tomasse mais cuidado com coordenações deste tipo de tráfego. Informo que a coordenação foi realizado pela equipe anterior e por isso não houve como averiguar mais detalhes do ocorrido."),0,'L',0);
		$ini = $this->GetY()+4;

		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   2. 1130Z - FAG048 - SBEG/MTPP - YYYYY informou que o APP-BV teria sido informado que a ACFT citada tinha como destino o SBBV. Que informou às autoridades prestadas e o comandante da Base Aérea de Boa Vista, informou que a anv não estava autorizada a pousar. Enfim, verificado que o destino da anv era MTPP foi alertado pelo cto que tomasse mais cuidado com coordenações deste tipo de tráfego. Informo que a coordenação foi realizado pela equipe anterior e por isso não houve como averiguar mais detalhes do ocorrido."),0,'L',0);
		$ini = $this->GetY()+4;

		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   3. 1130Z - FAG048 - SBEG/MTPP - YYYYY informou que o APP-BV teria sido informado que a ACFT citada tinha como destino o SBBV. Que informou às autoridades prestadas e o comandante da Base Aérea de Boa Vista, informou que a anv não estava autorizada a pousar. Enfim, verificado que o destino da anv era MTPP foi alertado pelo cto que tomasse mais cuidado com coordenações deste tipo de tráfego. Informo que a coordenação foi realizado pela equipe anterior e por isso não houve como averiguar mais detalhes do ocorrido."),0,'L',0);
		$ini = $this->GetY()+4;

		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   4. 1130Z - FAG048 - SBEG/MTPP - YYYYY informou que o APP-BV teria sido informado que a ACFT citada tinha como destino o SBBV. Que informou às autoridades prestadas e o comandante da Base Aérea de Boa Vista, informou que a anv não estava autorizada a pousar. Enfim, verificado que o destino da anv era MTPP foi alertado pelo cto que tomasse mais cuidado com coordenações deste tipo de tráfego. Informo que a coordenação foi realizado pela equipe anterior e por isso não houve como averiguar mais detalhes do ocorrido."),0,'L',0);
		$ini = $this->GetY()+4;
		
		

		$this->SetXY(20,$this->GetY());
		$this->SetFont('Arial','B',8);
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"B) TÉCNICAS:"),0,'L',0);
		$ini = $this->GetY()+4;


		$this->SetFont('Arial','',6);
		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   1. Às 1320Z foi informado pelo sargento XXX da TIOP, que o mouse trackball faltante na console do SCO-MN estava em processo de aquisição."),0,'L',0);
		$ini = $this->GetY()+4;

		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   2. Às 1435Z a frequência 121,5 e SFX e CZS  atualizado SCI para o dia 09 e 08 respectivamente; Às 1450Z colocado o pedestal na console 02 do SCO-MU; Às 1505 colocada impressora na console 04 do SCO-BL; por determinação da chefia do COI fica instituída o item console, na letra B-1. Onde serão lançados todos os ítens que estejam faltando ou sejam retirados durante o turno do serviço tais como: pedestais, mousetrack, monofones, impressoras, microfones e quaisquer outros elementos que façam parte das console de operação no ACC."),0,'L',0);
		$ini = $this->GetY()+4;

		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   3. Às 1435Z a frequência 121,5 e SFX e CZS  atualizado SCI para o dia 09 e 08 respectivamente; Às 1450Z colocado o pedestal na console 02 do SCO-MU; Às 1505 colocada impressora na console 04 do SCO-BL; por determinação da chefia do COI fica instituída o item console, na letra B-1. Onde serão lançados todos os ítens que estejam faltando ou sejam retirados durante o turno do serviço tais como: pedestais, mousetrack, monofones, impressoras, microfones e quaisquer outros elementos que façam parte das console de operação no ACC."),0,'L',0);
		$ini = $this->GetY()+4;
		
		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   4. Às 1435Z a frequência 121,5 e SFX e CZS  atualizado SCI para o dia 09 e 08 respectivamente; Às 1450Z colocado o pedestal na console 02 do SCO-MU; Às 1505 colocada impressora na console 04 do SCO-BL; por determinação da chefia do COI fica instituída o item console, na letra B-1. Onde serão lançados todos os ítens que estejam faltando ou sejam retirados durante o turno do serviço tais como: pedestais, mousetrack, monofones, impressoras, microfones e quaisquer outros elementos que façam parte das console de operação no ACC."),0,'L',0);
		$ini = $this->GetY()+4;
		
		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   5. Às 1435Z a frequência 121,5 e SFX e CZS  atualizado SCI para o dia 09 e 08 respectivamente; Às 1450Z colocado o pedestal na console 02 do SCO-MU; Às 1505 colocada impressora na console 04 do SCO-BL; por determinação da chefia do COI fica instituída o item console, na letra B-1. Onde serão lançados todos os ítens que estejam faltando ou sejam retirados durante o turno do serviço tais como: pedestais, mousetrack, monofones, impressoras, microfones e quaisquer outros elementos que façam parte das console de operação no ACC."),0,'L',0);
		$ini = $this->GetY();
		
		$this->SetFont('Arial','B',8);
		$this->SetXY(20,$ini);
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"C) ADMINISTRATIVAS:"),0,'L',0);
		$ini = $this->GetY()+4;

		$this->SetFont('Arial','',6);
		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   1. Às 19:20Q, FULANO foi conduzido ao hospital da BAMN."),0,'L',0);
		$ini = $this->GetY()+4;

		$this->SetXY(20,$this->GetY());
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"   2. BELTRANO apresentou-se ao serviço sentindo dores abdominais e foi autorizado a prosseguir para receber atendimento hospitalar. Em seu lugar foi escalado o XXX, que trabalhou até 1515Z, quando foi dispensado por orderm da chefia da DO. Aproximadamente as 1630Z a esposa do referido informou que ele estava no hospital e tinha indicaçoes para recebimento de exame de contraste e estaria levando o militar pra realizar o exame a tarde. Solicitei que informasse o resultado do atendimento e ,se fosse o caso, a dispensa a ser concedida.."),0,'L',0);
		$ini = $this->GetY()+4;
		
		$this->SetFont('Arial','B',8);
		$this->SetXY(20,$ini);
		$this->Cell(168,4,iconv('UTF-8','ISO-8859-1','IV  - PASSAGEM DO SERVIÇO'),1,0,'L',1);
		$this->SetXY(20,$this->GetY()+4);
		$this->SetFont('Arial','',6);
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"  Todas as informações registradas neste turno foram informados aos controladores do 1 e 2 turnos e foram questionados se havia alguma a ser registrada.\n   Passo o serviço ao 1T QOEA CTA SICLANO DE TAL"),0,'L',0);
		$ini = $this->GetY()+4;



		$dtm  = date('m');
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"\n\n\nManaus, 10  de Setembro de 2009.\r\n\r\n____________________________________________\r\n1T QOEA CTA FULANO DE TAL"),0,'R',0);
//		$this->MultiCell(165,4,iconv('UTF-8','ISO-8859-1',"\n".$preenche[0]['EscalasMonth']['nm_comandante']),0,'R',0);
		$this->Rect(20,20,168,260);

			
	}

	function relatorioEscala($escala, $mes, $selprev)
	{
		$this->AliasNbPages();
		$tipo = $selprev;
		$this->SetXY(20,20);
		$this->SetFont('Arial','B',10);
		$this->MultiCell(168,4,iconv('UTF-8','ISO-8859-1',"SERVIÇO PÚBLICO FEDERAL\r\nQUARTO CENTRO INTEGRADO DE DEFESA AÉREA E CONTROLE DE TRÁFEGO AÉREO\r\nRELATÓRIO DAS ESCALAS"),0,'C',0);

		//-----------------------------------------------------------------------------------------------------
		$ini = $this->GetY()+5;
		$this->SetFont('Arial','B',8);
		$this->SetXY(20,$ini);
		$this->SetFillColor(120,120,120);
		$this->Cell(170,4,iconv('UTF-8','ISO-8859-1','REFERÊNCIA  - '.$mes.'   Data Impressão:'.date('d/m/Y h:i:s').'   Tipo:'.$tipo.'  Total de registros:'.count($escala)),1,0,'C',1);
		$ini = $this->GetY()+4;
		$this->SetXY(20,$ini);
		$this->SetFillColor(200,200,200);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','B',6);
		$this->Cell(5,4,iconv('UTF-8','ISO-8859-1',$c),1,0,'C',1);
		$this->Cell(35,4,iconv('UTF-8','ISO-8859-1','LOCALIDADE'),1,0,'C',1);
		$this->Cell(40,4,iconv('UTF-8','ISO-8859-1','UNIDADE'),1,0,'C',1);
		$this->Cell(30,4,iconv('UTF-8','ISO-8859-1','SETOR'),1,0,'C',1);
		$this->Cell(30,4,iconv('UTF-8','ISO-8859-1','ESCALANTE'),1,0,'C',1);
		$this->Cell(30,4,iconv('UTF-8','ISO-8859-1','CHEFE'),1,0,'C',1);

		$cor = 1;
		$ini = $this->GetY()+4;
		$this->SetXY(20,$ini);
		$c = 0;

		foreach ($escala as $dados){
			if($cor>0){
				$this->SetFillColor(230,230,230);

			}else{
				$this->SetFillColor(255,255,255);

			}
			$cor *= -1;
			$c++;

			$this->SetFont('Arial','',8);

			$this->Cell(5,4,iconv('UTF-8','ISO-8859-1',$c),1,0,'C',1);
			$this->Cell(35,4,iconv('UTF-8','ISO-8859-1',$dados['Cidade']['nome']),1,0,'C',1);
			$this->Cell(40,4,iconv('UTF-8','ISO-8859-1',$dados['Unidade']['sigla_unidade']),1,0,'C',1);
			$this->Cell(30,4,iconv('UTF-8','ISO-8859-1',$dados['Setor']['sigla_setor']),1,0,'C',1);
			if($dados['Escalasmonth']['escalante']==''){
				$valor = 'Não assinou.';
			}else{
				$valor = 'Assinou.';
			}
			$this->Cell(30,4,iconv('UTF-8','ISO-8859-1',$valor),1,0,'C',1);
			if($dados['Escalasmonth']['chefe']==''){
				$valor = 'Não assinou.';
			}else{
				$valor = 'Assinou.';
			}
			$this->Cell(30,4,iconv('UTF-8','ISO-8859-1',$valor),1,0,'C',1);


			$ini = $this->GetY()+4;
			$this->SetXY(20,$ini);



		}
			
		//$this->Output('teste',$this->webroot.'')

	}

	//Page footer
	function Footer() { //Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','B',6); //Page number
		if($this->controle_rodape==0){
			$this->Cell(0,10,iconv('UTF-8','ISO-8859-1','SGBDO v. 0.5   Pág.: ').$this->PageNo().' / {nb} --------> Gerado automaticamente pelo sistema desenvolvido no CINDACTA IV - 1S BET EVALDO (c) 2008',0,0,'C');
		}else{
			$this->Cell(0,10,iconv('UTF-8','ISO-8859-1','SGBDO v. 0.5   Pág.: ').$this->PageNo().' / {nb} '.$this->texto_rodape,0,0,'C');
		}
	}

	/// Funcoes acrescentadas - Extensoes para FPDF
	function Rotate($angle, $x=-1, $y=-1)
	{
		if($x==-1)
		$x=$this->x;
		if($y==-1)
		$y=$this->y;
		if($this->angle!=0)
		$this->_out('Q');
		$this->angle=$angle;
		if($angle!=0)
		{
			$angle*=M_PI/180;
			$c=cos($angle);
			$s=sin($angle);
			$cx=$x*$this->k;
			$cy=($this->h-$y)*$this->k;
			$this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
		}
	}
	function RotatedText($x, $y, $txt, $angle)
	{
		//Text rotated around its origin
		$this->Rotate($angle, $x, $y);
		$this->Text($x, $y, $txt);
		$this->Rotate(0);
	}

	function RotatedImage($file, $x, $y, $w, $h, $angle)
	{
		//Image rotated around its upper-left corner
		$this->Rotate($angle, $x, $y);
		$this->Image($file, $x, $y, $w, $h);
		$this->Rotate(0);
	}
	function _endpage()
	{
		if($this->angle!=0)
		{
			$this->angle=0;
			$this->_out('Q');
		}
		parent::_endpage();
	}












	// --------------------------------------------------------------------------
	// Complemento para código de barras

	function barcode($encoding="EAN-13")
	{
			
		if(!function_exists("imagecreate"))
		{
			die("This class needs GD library support.");
			return false;
		}

		$this->_error="";
		$this->_scale=2;
		$this->_width=0;
		$this->_height=0;
		$this->_n2w=2;
		$this->_height=60;
		$this->_format='png';
			
		//$this->_font= str_replace("/pdf.php","/fonts/arialbd.ttf",$_SERVER["SCRIPT_FILENAME"]);
		$this->_font = str_replace("webroot/index.php","views/helpers/fonts/arialbd.ttf",$_SERVER["SCRIPT_FILENAME"]);
			
		//$this->_font= '/var/www/operacional/views/helpers/fonts/arialbd.ttf';
		if (isset($_SERVER['WINDIR']) && file_exists($_SERVER['WINDIR']))
		$this->_font=$_SERVER['WINDIR']."\Fonts\arialbd.ttf";

		$this->setSymblogy($encoding);
		$this->setHexColor("#000000","#FFFFFF");
	}

	function setFontBar($font,$autolocate=false)
	{
		$this->_font=$font;
		if($autolocate)
		{
			//$this->_font=dirname($_SERVER["PATH_TRANSLATED"])."/".$font.".ttf";
			$this->_font = str_replace("webroot/index.php","views/helpers/fonts/{$font}.ttf",$_SERVER["SCRIPT_FILENAME"]);
			//$this->_font= 'fonts/'.$font.'.ttf';
			if (isset($_SERVER['WINDIR']) && file_exists($_SERVER['WINDIR']))
			$this->_font=$_SERVER['WINDIR']."\Fonts\\".$font.".ttf";
		}
	}

	function setSymblogy($encoding="EAN-13")
	{
		$this->_encode=strtoupper($encoding);
	}

	function setHexColor($color,$bgcolor)
	{
		$this->setColor(hexdec(substr($color,1,2)),hexdec(substr($color,3,2)),hexdec(substr($color,5,2)));
		$this->setBGColor(hexdec(substr($bgcolor,1,2)),hexdec(substr($bgcolor,3,2)),hexdec(substr($bgcolor,5,2)));
	}

	function setColor($red,$green,$blue)
	{
		$this->_color=array($red,$green,$blue);
	}

	function setBGColor($red,$green,$blue)
	{
		$this->_bgcolor=array($red,$green,$blue);
	}

	function setScale($scale)
	{
		$this->_scale=$scale;
	}

	function setFormat($format)
	{
		$this->_format=strtolower($format);
	}

	function setHeight($height)
	{
		$this->_height=$height;
	}

	function setNarrow2Wide($n2w)
	{
		if($n2w<2)
		$n2w=3;
		$this->_n2w=$n2w;
	}

	function error($asimg=false)
	{
		if(empty($this->_error))
		return "";
		if(!$asimg)
		return $this->_error;
			

		@header("Content-type: image/png");
		$im=@imagecreate(250,100);
		$color = @imagecolorallocate($im,255,255,255);
		$color = @imagecolorallocate($im,0,0,0);
		@imagettftext($im,10,0,5,50,$color,$this->_font , wordwrap($this->_error, 40, "\n"));
		@imagepng($im);
		@imagedestroy($im);
	}

	function genBarCode($barnumber,$format="jpg",$file="")
	{
		$this->setFormat($format);
		if($this->_encode=="EAN-13")
		{
			if(strlen($barnumber)>13)
			{
				$this->_error="Barcode number must be less then 13 characters.";
				return false;
			}
			$this->_eanBarcode($barnumber,$this->_scale,$file);
		}
		elseif($this->_encode=="UPC-A")
		{
			if(strlen($barnumber)>12)
			{
				$this->_error="Barcode number must be less then 13 characters.";
				return false;
			}
			$this->_eanBarcode($barnumber,$this->_scale,$file);
		}
		elseif($this->_encode=="ISBN")
		{
			if(strlen($barnumber)>13 || strlen($barnumber)<12)
			{
				$this->_error="Barcode number must be less then 13 characters.";
				return false;
			}
			elseif(substr($barnumber,0,3)!="978")
			{
				$this->_error="Not an ISBN barcode number. Must be start with 978";
				return false;
			}
			$this->_eanBarcode($barnumber,$this->_scale,$file);
		}
		elseif($this->_encode=="EAN-8")
		{
			if(strlen($barnumber)>8)
			{
				$this->_error="Barcode number must be less then 8 characters.";
				return false;
			}
			$this->_ean8Barcode($barnumber,$this->_scale,$file);
		}
		elseif($this->_encode=="UPC-E")
		{
			if(strlen($barnumber)>12)
			{
				$this->_error="Barcode number must be less then 12 characters.";
				return false;
			}
			$this->_upceBarcode($barnumber,$this->_scale,$file);
		}
		elseif($this->_encode=="S205" || $this->_encode=="I2O5")
		{ //STANDARD 2 OF 5 SYMBOLOGY OR INDUSTRIAL 2 OF 5
			$this->_so25Barcode($barnumber,$this->_scale,$file);
		}
		elseif($this->_encode=="I25" || $this->_encode=="INTERLEAVED")
		{ //INTERLEAVED 2 OF 5
			$this->_i25Barcode($barnumber,$this->_scale,$file);
		}
		elseif($this->_encode=="POSTNET" )
		{
			$this->_postBarcode($barnumber,$this->_scale,$file);
		}
		elseif($this->_encode=="CODABAR" )
		{
			$this->_codaBarcode($barnumber,$this->_scale,$file);
		}
		elseif($this->_encode=="CODE128" )
		{
			$this->_c128Barcode($barnumber,$this->_scale,$file);
		}
		elseif($this->_encode=="CODE39" )
		{
			$this->_c39Barcode($barnumber,$this->_scale,$file,false);
		}
		elseif($this->_encode=="CODE93" )
		{
			$this->_c93Barcode($barnumber,$this->_scale,$file);
		}
	}

	/// Start function for code93

	/*A Code 39 barcode has the following structure:

	A start character , represented below by the asterisk (*) character.
	Any number of characters encoded from the table below.
	The "C" and "K" checksum digits calculated as described above and encoded using the table below.
	A stop character, which is a second asterisk character.
	*/

	function _c93Encode($barnumber)
	{
		$encTable=array("0" => "100010100",
							"1" => "101001000",
							"2" => "101000100",
							"3" => "101000010",
							"4" => "100101000",
							"5" => "100100100",
							"6" => "100100010",
							"7" => "101010000",
							"8" => "100010010",
							"9" => "100001010",
							"A" => "110101000",
							"B" => "110100100",
							"C" => "110100010",
							"D" => "110010100",
							"E" => "110010010",
							"F" => "110001010",
							"G" => "101101000",
							"H" => "101100100",
							"I" => "101100010",
							"J" => "100110100",
							"K" => "100011010",
							"L" => "101011000",
							"M" => "101001100",
							"N" => "101000110",
							"O" => "100101100",
							"P" => "100010110",
							"Q" => "110110100",
							"R" => "110110010",
							"S" => "110101100",
							"T" => "110100110",
							"U" => "110010110",
							"V" => "110011010",
							"W" => "101101100",
							"X" => "101100110",
							"Y" => "100110110",
							"Z" => "100111010",
							"-" => "100101110",
							"." => "111010100",
							" " => "111010010",
							"$" => "111001010",
							"/" => "101101110",
							"+" => "101110110",
							"%" => "110101110",
							"$" => "100100110",
							"%" => "111011010",
							"/" => "111010110",
							"+" => "100110010",
							"*" => "101011110"
							);

							$mfcStr="";
							$widebar=str_pad("",$this->_n2w,"1",STR_PAD_LEFT);
							$widespc=str_pad("",$this->_n2w,"0",STR_PAD_LEFT);

							$arr_key=array_keys($encTable);
							/// calculating C And K

							for($j=0;$j<2;$j++)
							{
								$sum=0;
								for($i=strlen($barnumber);$i>0;$i--)
								{
									$num=$barnumber[strlen($barnumber)-$i];
									if(preg_match("/[A-Z]+/",$num))
									$num=ord($num)-55;
									elseif($num=='-')
									$num=36;
									elseif($num=='.')
									$num=37;
									elseif($num==' ')
									$num=38;
									elseif($num=='$')
									$num=39;
									elseif($num=='/')
									$num=40;
									elseif($num=='+')
									$num=41;
									elseif($num=='%')
									$num=42;
									elseif($num=='*')
									$num=43;

									$sum+=$i*$num;
								}
								$barnumber.=trim($arr_key[(int)($sum % 47)]);
							}

							$barnumber="*".$barnumber."*";

							for($i=0;$i<strlen($barnumber);$i++)
							{
								$mfcStr.=$encTable[$barnumber[$i]];
							}
							$mfcStr.='1';

							return $mfcStr;
	}

	function _c93Barcode($barnumber,$scale=1,$file="",$checkdigit=false)
	{
		$bars=$this->_c93Encode($barnumber);
		if(empty($file))
		header("Content-type: image/".$this->_format);

		if ($scale<1) $scale=2;
		$total_y=(double)$scale * $this->_height+10*$scale;
		if (!$space)
		$space=array('top'=>2*$scale,'bottom'=>2*$scale,'left'=>2*$scale,'right'=>2*$scale);
			
		/* count total width */
		$xpos=0;
			
		$xpos=$scale*strlen($bars)+2*$scale*10;

		/* allocate the image */
		$total_x= $xpos +$space['left']+$space['right'];
		$xpos=$space['left']+$scale*10;

		$height=floor($total_y-($scale*20));
		$height2=floor($total_y-$space['bottom']);

		$im=@imagecreatetruecolor($total_x, $total_y);
		$bg_color = @imagecolorallocate($im, $this->_bgcolor[0], $this->_bgcolor[1],$this->_bgcolor[2]);
		@imagefilledrectangle($im,0,0,$total_x,$total_y,$bg_color);
		$bar_color = @imagecolorallocate($im, $this->_color[0], $this->_color[1],$this->_color[2]);

		for($i=0;$i<strlen($bars);$i++)
		{
			$h=$height;
			$val=$bars[$i];

			if($val==1)
			@imagefilledrectangle($im,$xpos, $space['top'],$xpos+$scale-1, $h,$bar_color);
			$xpos+=$scale;
		}
			
		$font_arr=@imagettfbbox ( $scale*10, 0, $this->_font, $barnumber);
		$x= floor($total_x-(int)$font_arr[0]-(int)$font_arr[2]+$scale*10)/2;
		@imagettftext($im,$scale*10,0,$x, $height2, $bar_color,$this->_font , $barnumber);

			
		if($this->_format=="png")
		{
			if(!empty($file))
			@imagepng($im,$file.".".$this->_format);
			else
			@imagepng($im);
		}

		if($this->_format=="gif")
		{
			if(!empty($file))
			@imagegif($im,$file.".".$this->_format);
			else
			@imagegif($im);
		}

		if($this->_format=="jpg" || $this->_format=="jpeg" )
		{
			if(!empty($file))
			@imagejpeg($im,$file.".".$this->_format);
			else
			@imagejpeg($im);
		}

		@imagedestroy($im);
	}
	/// End functions for code93

	/// Start function for code39

	/*A Code 39 barcode has the following structure:

	A start character - the asterisk (*) character.
	Any number of characters encoded from the table below.
	An optional checksum digit calculated as described above and encoded from the table below.
	A stop character, which is a second asterisk character. */

	function _c39Encode($barnumber,$checkdigit=false)
	{
		$encTable=array("0" => "NNNWWNWNN",
							"1" => "WNNWNNNNW",
							"2" => "NNWWNNNNW",
							"3" => "WNWWNNNNN",
							"4" => "NNNWWNNNW",
							"5" => "WNNWWNNNN",
							"6" => "NNWWWNNNN",
							"7" => "NNNWNNWNW",
							"8" => "WNNWNNWNN",
							"9" => "NNWWNNWNN",
							"A" => "NNWWNNWNN",
							"B" => "NNWNNWNNW",
							"C" => "WNWNNWNNN",
							"D" => "NNNNWWNNW",
							"E" => "WNNNWWNNN",
							"F" => "NNWNWWNNN",
							"G" => "NNNNNWWNW",
							"H" => "WNNNNWWNN",
							"I" => "NNWNNWWNN",
							"J" => "NNNNWWWNN",
							"K" => "WNNNNNNWW",
							"L" => "NNWNNNNWW",
							"M" => "WNWNNNNWN",
							"N" => "NNNNWNNWW",
							"O" => "WNNNWNNWN",
							"P" => "NNWNWNNWN",
							"Q" => "NNNNNNWWW",
							"R" => "WNNNNNWWN",
							"S" => "NNWNNNWWN",
							"T" => "NNNNWNWWN",
							"U" => "WWNNNNNNW",
							"V" => "NWWNNNNNW",
							"W" => "WWWNNNNNN",
							"X" => "NWNNWNNNW",
							"Y" => "WWNNWNNNN",
							"Z" => "NWWNWNNNN",
							"-" => "NWNNNNWNW",
							"." => "WWNNNNWNN",
							" " => "NWWNNNWNN",
							"$" => "NWNWNWNNN",
							"/" => "NWNWNNNWN",
							"+" => "NWNNNWNWN",
							"%" => "NNNWNWNWN",
							"*" => "NWNNWNWNN"
							);

							$mfcStr="";
							$widebar=str_pad("",$this->_n2w,"1",STR_PAD_LEFT);
							$widespc=str_pad("",$this->_n2w,"0",STR_PAD_LEFT);

							if($checkdigit==true)
							{
								$arr_key=array_keys($encTable);
								for($i=0;$i<strlen($barnumber);$i++)
								{
									$num=$barnumber[$i];
									if(preg_match("/[A-Z]+/",$num))
									$num=ord($num)-55;
									elseif($num=='-')
									$num=36;
									elseif($num=='.')
									$num=37;
									elseif($num==' ')
									$num=38;
									elseif($num=='$')
									$num=39;
									elseif($num=='/')
									$num=40;
									elseif($num=='+')
									$num=41;
									elseif($num=='%')
									$num=42;
									elseif($num=='*')
									$num=43;
									$sum+=$num;
								}
								$barnumber.=trim($arr_key[(int)($sum % 43)]);
							}

							$barnumber="*".$barnumber."*";

							for($i=0;$i<strlen($barnumber);$i++)
							{
								$tmp=$encTable[$barnumber[$i]];

								$bar =true;

								for($j=0;$j<strlen($tmp);$j++)
								{
									if($tmp[$j]=='N' && $bar)
									$mfcStr.='1';
									else if($tmp[$j]=='N' && !$bar)
									$mfcStr.='0';
									else if($tmp[$j]=='W' && $bar)
									$mfcStr.=$widebar;
									else if($tmp[$j]=='W' && !$bar)
									$mfcStr.=$widespc;
									$bar = !$bar;
								}
								$mfcStr.='0';
							}

							return $mfcStr;
	}

	function _c39Barcode($barnumber,$scale=1,$file="",$checkdigit=false)
	{
		$bars=$this->_c39Encode($barnumber,$checkdigit);
		if(empty($file))
		header("Content-type: image/".$this->_format);

		if ($scale<1) $scale=2;
		$total_y=(double)$scale * $this->_height+10*$scale;
		if (!$space)
		$space=array('top'=>2*$scale,'bottom'=>2*$scale,'left'=>2*$scale,'right'=>2*$scale);
			
		/* count total width */
		$xpos=0;
			
		$xpos=$scale*strlen($bars)+2*$scale*10;

		/* allocate the image */
		$total_x= $xpos +$space['left']+$space['right'];
		$xpos=$space['left']+$scale*10;

		$height=floor($total_y-($scale*20));
		$height2=floor($total_y-$space['bottom']);

		$im=@imagecreatetruecolor($total_x, $total_y);
		$bg_color = @imagecolorallocate($im, $this->_bgcolor[0], $this->_bgcolor[1],$this->_bgcolor[2]);
		@imagefilledrectangle($im,0,0,$total_x,$total_y,$bg_color);
		$bar_color = @imagecolorallocate($im, $this->_color[0], $this->_color[1],$this->_color[2]);

		for($i=0;$i<strlen($bars);$i++)
		{
			$h=$height;
			$val=$bars[$i];

			if($val==1)
			@imagefilledrectangle($im,$xpos, $space['top'],$xpos+$scale-1, $h,$bar_color);
			$xpos+=$scale;
		}
			
		$font_arr=@imagettfbbox ( $scale*10, 0, $this->_font, $barnumber);
		$x= floor($total_x-(int)$font_arr[0]-(int)$font_arr[2]+$scale*10)/2;
		@imagettftext($im,$scale*10,0,$x, $height2, $bar_color,$this->_font , $barnumber);

			
		if($this->_format=="png")
		{
			if(!empty($file))
			@imagepng($im,$file.".".$this->_format);
			else
			@imagepng($im);
		}

		if($this->_format=="gif")
		{
			if(!empty($file))
			@imagegif($im,$file.".".$this->_format);
			else
			@imagegif($im);
		}

		if($this->_format=="jpg" || $this->_format=="jpeg" )
		{
			if(!empty($file))
			@imagejpeg($im,$file.".".$this->_format);
			else
			@imagejpeg($im);
		}

		@imagedestroy($im);
	}
	/// End functions for code39

	///Start function for code128
	function _c128Encode($barnumber,$useKeys)
	{
		$encTable=array("11011001100","11001101100","11001100110","10010011000","10010001100","10001001100","10011001000","10011000100","10001100100","11001001000","11001000100","11000100100","10110011100","10011011100","10011001110","10111001100","10011101100","10011100110","11001110010","11001011100","11001001110","11011100100","11001110100","11101101110","11101001100","11100101100","11100100110","11101100100","11100110100","11100110010","11011011000","11011000110","11000110110","10100011000","10001011000","10001000110","10110001000","10001101000","10001100010","11010001000","11000101000","11000100010","10110111000","10110001110","10001101110","10111011000","10111000110","10001110110","11101110110","11010001110","11000101110","11011101000","11011100010","11011101110","11101011000","11101000110","11100010110","11101101000","11101100010","11100011010","11101111010","11001000010","11110001010","10100110000","10100001100","10010110000","10010000110","10000101100","10000100110","10110010000","10110000100","10011010000","10011000010","10000110100","10000110010","11000010010","11001010000","11110111010","11000010100","10001111010","10100111100","10010111100","10010011110","10111100100","10011110100","10011110010","11110100100","11110010100","11110010010","11011011110","11011110110","11110110110","10101111000","10100011110","10001011110","10111101000","10111100010","11110101000","11110100010","10111011110","10111101110","11101011110","11110101110","11010000100","11010010000","11010011100","11000111010");

		$start=array("A"=>"11010000100","B"=>"11010010000","C"=>"11010011100");
		$stop="11000111010";

		$sum=0;
		$mfcStr="";
		if($useKeys=='C')
		{
			for($i=0;$i<strlen($barnumber);$i+=2)
			{
				$val=substr($barnumber,$i,2);
				if(is_int($val))
				$sum+=($i+1)*(int)($val);
				elseif($barnumber==chr(129))
				$sum+=($i+1)*100;
				elseif($barnumber==chr(130))
				$sum+=($i+1)*101;
				$mfcStr.=$encTable[$val];
			}
		}
		else
		{
			for($i=0;$i<strlen($barnumber);$i++)
			{
				$num=ord($barnumber[$i]);
				if($num>=32 && $num<=126)
				$num=ord($barnumber[$i])-32;
				elseif($num==128)
				$num=99;
				elseif($num==129)
				$num=100;
				elseif($num==130)
				$num=101;
				elseif($num<32 && $useKeys=='A')
				$num=$num+64;
				$sum+=($i+1)*$num;
				$mfcStr.=$encTable[$num];
			}
		}

		if($useKeys=='A')
		$check=($sum+103)%103;
		if($useKeys=='B')
		$check=($sum+104)%103;
		if($useKeys=='C')
		$check=($sum+105)%103;

		return $start[$useKeys].$mfcStr.$encTable[$check].$stop."11";
	}

	function _c128Barcode($barnumber,$scale=1,$file="")
	{
		$useKeys="B";
		if(preg_match("/^[0-9".chr(128).chr(129).chr(130)."]+$/",$barnumber))
		{
			$useKeys='C';
			if(strlen($barnumber)%2 != 0)
			$barnumber='0'.$barnumber;
		}
			
		for($i=0;$i<32;$i++)
		$chr=chr($i);
		if(preg_match("/[".$chr."]+/",$barnumber))
		$useKeys='A';

		$bars=$this->_c128Encode($barnumber,$useKeys);
		if(empty($file))
		header("Content-type: image/".$this->_format);

		if ($scale<1) $scale=2;
		$total_y=(double)$scale * $this->_height+10*$scale;
		if (!$space)
		$space=array('top'=>2*$scale,'bottom'=>2*$scale,'left'=>2*$scale,'right'=>2*$scale);
			
		/* count total width */
		$xpos=0;
			
		$xpos=$scale*strlen($bars)+2*$scale*10;

		/* allocate the image */
		$total_x= $xpos +$space['left']+$space['right'];
		$xpos=$space['left']+$scale*10;

		$height=floor($total_y-($scale*20));
		$height2=floor($total_y-$space['bottom']);

		$im=@imagecreatetruecolor($total_x, $total_y);
		$bg_color = @imagecolorallocate($im, $this->_bgcolor[0], $this->_bgcolor[1],$this->_bgcolor[2]);
		@imagefilledrectangle($im,0,0,$total_x,$total_y,$bg_color);
		$bar_color = @imagecolorallocate($im, $this->_color[0], $this->_color[1],$this->_color[2]);

		for($i=0;$i<strlen($bars);$i++)
		{
			$h=$height;
			$val=strtoupper($bars[$i]);

			if($val==1)
			@imagefilledrectangle($im,$xpos, $space['top'],$xpos+$scale-1, $h,$bar_color);
			$xpos+=$scale;
		}
			
		$font_arr=@imagettfbbox ( $scale*10, 0, $this->_font, $barnumber);
		$x= floor($total_x-(int)$font_arr[0]-(int)$font_arr[2]+$scale*10)/2;
		@imagettftext($im,$scale*10,0,$x, $height2, $bar_color,$this->_font , $barnumber);

			
		if($this->_format=="png")
		{
			if(!empty($file))
			@imagepng($im,$file.".".$this->_format);
			else
			@imagepng($im);
		}

		if($this->_format=="gif")
		{
			if(!empty($file))
			@imagegif($im,$file.".".$this->_format);
			else
			@imagegif($im);
		}

		if($this->_format=="jpg" || $this->_format=="jpeg" )
		{
			if(!empty($file))
			@imagejpeg($im,$file.".".$this->_format);
			else
			@imagejpeg($im);
		}

		@imagedestroy($im);
	}
	///End function for codabar


	///Start function for codabar

	/*
		A Code 11 Barcode has the following structure:

		One of four possible start characters (A, B, C, or D), encoded from the table below.
		A narrow, inter-character space.
		The data of the message, encoded from the table below, with a narrow inter-character space between each character.
		One of four possible stop characters (A, B, C, or D), encoded from the table below
		*/

	function _codaEncode($barnumber)
	{
		$encTable=array("0000011","0000110","0001001","1100000","0010010","1000010","0100001","0100100","0110000","1001000");
		$chrTable=array("-" => "0001100","$" => "0011000",":" => "1000101","/" => "1010001","." => "1010100", "+" => "0011111","A" => "0011010","B" => "0001011","C" => "0101001","D" => "0001110");

		$mfcStr="";
			
		$widebar=str_pad("",$this->_n2w,"1",STR_PAD_LEFT);
		$widespc=str_pad("",$this->_n2w,"0",STR_PAD_LEFT);
			
		for($i=0;$i<strlen($barnumber);$i++)
		{
			if(preg_match("/[0-9]+/",$barnumber[$i]))
			$tmp=$encTable[(int)$barnumber[$i]];
			else
			$tmp=$chrTable[strtoupper(trim($barnumber[$i]))];

			$bar =true;

			for($j=0;$j<strlen($tmp);$j++)
			{
				if($tmp[$j]=='0' && $bar)
				$mfcStr.='1';
				else if($tmp[$j]=='0' && !$bar)
				$mfcStr.='0';
				else if($tmp[$j]=='1' && $bar)
				$mfcStr.=$widebar;
				else if($tmp[$j]=='1' && !$bar)
				$mfcStr.=$widespc;

				$bar = !$bar;
			}
			$mfcStr.='0';
		}
			
		return $mfcStr;
	}

	function _codaBarcode($barnumber,$scale=1,$file="")
	{

		$bars=$this->_codaEncode($barnumber);
		if(empty($file))
		header("Content-type: image/".$this->_format);

		if ($scale<1) $scale=2;
		$total_y=(double)$scale * $this->_height;
		if (!$space)
		$space=array('top'=>2*$scale,'bottom'=>2*$scale,'left'=>2*$scale,'right'=>2*$scale);
			
		/* count total width */
		$xpos=0;
			
		$xpos=$scale*strlen($bars);

		/* allocate the image */
		$total_x= $xpos +$space['left']+$space['right'];
		$xpos=$space['left'];

		$height=floor($total_y-($scale*10));
		$height2=floor($total_y-$space['bottom']);

		$im=@imagecreatetruecolor($total_x, $total_y);
		$bg_color = @imagecolorallocate($im, $this->_bgcolor[0], $this->_bgcolor[1],$this->_bgcolor[2]);
		@imagefilledrectangle($im,0,0,$total_x,$total_y,$bg_color);
		$bar_color = @imagecolorallocate($im, $this->_color[0], $this->_color[1],$this->_color[2]);

		for($i=0;$i<strlen($bars);$i++)
		{
			$h=$height;
			$val=strtoupper($bars[$i]);

			if($val==1)
			@imagefilledrectangle($im,$xpos, $space['top'],$xpos+$scale-1, $h,$bar_color);
			$xpos+=$scale;
		}
			

		$x= ($total_x-strlen($bars))/2;
		@imagettftext($im,$scale*6,0,$x, $height2, $bar_color,$this->_font , $barnumber);

			
		if($this->_format=="png")
		{
			if(!empty($file))
			@imagepng($im,$file.".".$this->_format);
			else
			@imagepng($im);
		}

		if($this->_format=="gif")
		{
			if(!empty($file))
			@imagegif($im,$file.".".$this->_format);
			else
			@imagegif($im);
		}

		if($this->_format=="jpg" || $this->_format=="jpeg" )
		{
			if(!empty($file))
			@imagejpeg($im,$file.".".$this->_format);
			else
			@imagejpeg($im);
		}

		@imagedestroy($im);
	}

	///End function for codabar

	// Start Function for POSTNET
	/*
	A PostNet barcode has the following structure:

	Frame bar, encoded as a single 1.
	5, 9, or 11 data characters properly encoded (see encoding table below).
	Check digit, encoded using encoding table below.
	Final frame bar, encoded as a single 1.

	0		 11000
	1		 00011
	2		 00101
	3		 00110
	4		 01001
	5		 01010
	6		 01100
	7		 10001
	8		 10010
	9		 10100
	*/

	function _postEncode($barnumber)
	{
		$encTable=array("11000","00011","00101","00110","01001","01010","01100","10001","10010","10100");

		$sum=0;
		$encstr="";
		for($i=0;$i<strlen($barnumber);$i++)
		{
			$sum+=(int)$barnumber[$i];
			$encstr.=$encTable[(int)$barnumber[$i]];
		}
		if($sum%10!=0)
		$check=(int)(10-($sum%10));
			
		$encstr.=$encTable[$check];
		$encstr="1".$encstr."1";
		return $encstr;
	}

	function _postBarcode($barnumber,$scale=1,$file="")
	{
		if(strlen($barnumber)==5 || strlen($barnumber)==9 || strlen($barnumber)==11)
		;
		else
		{
			$this->_error="Not a valid postnet number.";
			return false;
		}

		$bars=$this->_postEncode($barnumber);
		if(empty($file))
		header("Content-type: image/".$this->_format);

		if ($scale<1) $scale=2;
		$total_y=(double)$scale * $this->_height;
		if (!$space)
		$space=array('top'=>2*$scale,'bottom'=>2*$scale,'left'=>2*$scale,'right'=>2*$scale);
			
		/* count total width */
		$xpos=0;
			
		$xpos=$scale*strlen($bars)*2;

		/* allocate the image */
		$total_x= $xpos +$space['left']+$space['right'];
		$xpos=$space['left'];

		$height=floor($total_y-($scale*10));
		$height2=floor($total_y-$space['bottom']);

		$im=@imagecreatetruecolor($total_x, $total_y);
		$bg_color = @imagecolorallocate($im, $this->_bgcolor[0], $this->_bgcolor[1],$this->_bgcolor[2]);
		@imagefilledrectangle($im,0,0,$total_x,$total_y,$bg_color);
		$bar_color = @imagecolorallocate($im, $this->_color[0], $this->_color[1],$this->_color[2]);

		for($i=0;$i<strlen($bars);$i++)
		{
			$val=strtoupper($bars[$i]);
			$h=$total_y-$space['bottom'];

			if($val==1)
			@imagefilledrectangle($im,$xpos,$space['top'],$xpos+$scale-1,$height2 , $bar_color);
			else
			@imagefilledrectangle($im,$xpos,floor($height2/1.5) ,$xpos+$scale-1, $height2,$bar_color);
			$xpos+=2*$scale;
		}
			
			

		if($this->_format=="png")
		{
			if(!empty($file))
			@imagepng($im,$file.".".$this->_format);
			else
			@imagepng($im);
		}

		if($this->_format=="gif")
		{
			if(!empty($file))
			@imagegif($im,$file.".".$this->_format);
			else
			@imagegif($im);
		}

		if($this->_format=="jpg" || $this->_format=="jpeg" )
		{
			if(!empty($file))
			@imagejpeg($im,$file.".".$this->_format);
			else
			@imagejpeg($im);
		}

		@imagedestroy($im);
	}
	// End Function for POSTNET

	// Start Function for INTERLEAVED

	/*A Standard 2 of 5 barcode has the following physical structure:

	Start character, encoded as 11011010.
	Data characters properly encoded (see encoding table below).
	Stop character, encoded as 11010110.

	ASCII	BARCODE
	0		 NNWWN
	1		 WNNNW
	2		 NWNNW
	3		 WWNNN
	4		 NNWNW
	5		 WNWNN
	6		 NWWNN
	7		 NNNWW
	8		 WNNWN
	9		 NWNWN
	*/

	function _i25Encode($barnumber)
	{
		$encTable=array("NNWWN","WNNNW","NWNNW","WWNNN","NNWNW","WNWNN","NWWNN","NNNWW","WNNWN","NWNWN");
		$guards=array("1010","1101");

		$len=strlen($barnumber);
		if($len % 2!=0)
		{
			$barnumber=$this->_checkDigit($barnumber,$len);
			if($len==strlen($barnumber) && substr($barnumber,-1)!='0')
			$barnumber.='0';
		}
			
		$mfcStr="";
			
		$widebar=str_pad("",$this->_n2w,"1",STR_PAD_LEFT);
		$widespc=str_pad("",$this->_n2w,"0",STR_PAD_LEFT);
			
		for($i=0;$i<strlen($barnumber);$i+=2)
		{
			$tmp=$encTable[(int)$barnumber[$i]];
			$tmp1=$encTable[(int)$barnumber[$i+1]];
			for($j=0;$j<strlen($tmp);$j++)
			{
				if($tmp[$j]=='N')
				$mfcStr.='1';
				else
				$mfcStr.=$widebar;

				if($tmp1[$j]=='N')
				$mfcStr.='0';
				else
				$mfcStr.=$widespc;
			}
		}
			
		return $guards[0].$mfcStr.$guards[1];
	}

	function _i25Barcode($barnumber,$scale=1,$file="")
	{

		$bars=$this->_i25Encode($barnumber);
		if(empty($file))
		header("Content-type: image/".$this->_format);

		if ($scale<1) $scale=2;
		$total_y=(double)$scale * $this->_height;
		if (!$space)
		$space=array('top'=>2*$scale,'bottom'=>2*$scale,'left'=>2*$scale,'right'=>2*$scale);
			
		/* count total width */
		$xpos=0;
			
		$xpos=$scale*strlen($bars);

		/* allocate the image */
		$total_x= $xpos +$space['left']+$space['right'];
		$xpos=$space['left'];

		$height=floor($total_y-($scale*10));
		$height2=floor($total_y-$space['bottom']);

		$im=@imagecreatetruecolor($total_x, $total_y);
		$bg_color = @imagecolorallocate($im, $this->_bgcolor[0], $this->_bgcolor[1],$this->_bgcolor[2]);
		@imagefilledrectangle($im,0,0,$total_x,$total_y,$bg_color);
		$bar_color = @imagecolorallocate($im, $this->_color[0], $this->_color[1],$this->_color[2]);

		for($i=0;$i<strlen($bars);$i++)
		{
			$h=$height;
			$val=strtoupper($bars[$i]);

			if($val==1)
			@imagefilledrectangle($im,$xpos, $space['top'],$xpos+$scale-1, $h,$bar_color);
			$xpos+=$scale;
		}
			
			

		$x= ($total_x-strlen($bars))/2;
		@imagettftext($im,$scale*6,0,$x, $height2, $bar_color,$this->_font , $barnumber);

			
		if($this->_format=="png")
		{
			if(!empty($file))
			@imagepng($im,$file.".".$this->_format);
			else
			@imagepng($im);
		}

		if($this->_format=="gif")
		{
			if(!empty($file))
			@imagegif($im,$file.".".$this->_format);
			else
			@imagegif($im);
		}

		if($this->_format=="jpg" || $this->_format=="jpeg" )
		{
			if(!empty($file))
			@imagejpeg($im,$file.".".$this->_format);
			else
			@imagejpeg($im);
		}

		@imagedestroy($im);
	}

	// End Function for INTERLEAVED

	// Start Function for S2O5

	/*A Standard 2 of 5 barcode has the following physical structure:

	Start character, encoded as 11011010.
	Data characters properly encoded (see encoding table below).
	Stop character, encoded as 11010110.

	ASCII	BARCODE
	0		 NNWWN
	1		 WNNNW
	2		 NWNNW
	3		 WWNNN
	4		 NNWNW
	5		 WNWNN
	6		 NWWNN
	7		 NNNWW
	8		 WNNWN
	9		 NWNWN
	*/

	function _so25Encode($barnumber)
	{
		$encTable=array("NNWWN","WNNNW","NWNNW","WWNNN","NNWNW","WNWNN","NWWNN","NNNWW","WNNWN","NWNWN");
		$guards=array("11011010","1101011");

		$len=strlen($barnumber);
		$barnumber=$this->_checkDigit($barnumber,$len);
		if($len==strlen($barnumber) && substr($barnumber,-1)!='0')
		$barnumber.='0';
			
		$mfcStr="";
			
		$widebar=str_pad("",$this->_n2w,"1",STR_PAD_LEFT);
		$widebar.="0";
			
		for($i=0;$i<strlen($barnumber);$i++)
		{
			$num=(int)$barnumber{$i};
			$str="";
			$str=str_replace("N","10",$encTable[$num]);
			$str=str_replace("W",$widebar,$str);
			$mfcStr.=$str;
		}
			
		return $guards[0].$mfcStr.$guards[1];
	}

	function _so25Barcode($barnumber,$scale=1,$file="")
	{

		$bars=$this->_so25Encode($barnumber);
		if(empty($file))
		header("Content-type: image/".$this->_format);

		if ($scale<1) $scale=2;
		$total_y=(double)$scale * $this->_height;
		if (!$space)
		$space=array('top'=>2*$scale,'bottom'=>2*$scale,'left'=>2*$scale,'right'=>2*$scale);
			
		/* count total width */
		$xpos=0;
			
		$xpos=$scale*strlen($bars);

		/* allocate the image */
		$total_x= $xpos +$space['left']+$space['right'];
		$xpos=$space['left'];

		$height=floor($total_y-($scale*10));
		$height2=floor($total_y-$space['bottom']);

		$im=@imagecreatetruecolor($total_x, $total_y);
		$bg_color = @imagecolorallocate($im, $this->_bgcolor[0], $this->_bgcolor[1],$this->_bgcolor[2]);
		@imagefilledrectangle($im,0,0,$total_x,$total_y,$bg_color);
		$bar_color = @imagecolorallocate($im, $this->_color[0], $this->_color[1],$this->_color[2]);

		for($i=0;$i<strlen($bars);$i++)
		{
			$h=$height;
			$val=strtoupper($bars[$i]);

			if($val==1)
			@imagefilledrectangle($im,$xpos, $space['top'],$xpos+$scale-1, $h,$bar_color);
			$xpos+=$scale;
		}
			
			

		$x= ($total_x-strlen($bars))/2;
		@imagettftext($im,$scale*6,0,$x, $height2, $bar_color,$this->_font , $barnumber);

			
		if($this->_format=="png")
		{
			if(!empty($file))
			@imagepng($im,$file.".".$this->_format);
			else
			@imagepng($im);
		}

		if($this->_format=="gif")
		{
			if(!empty($file))
			@imagegif($im,$file.".".$this->_format);
			else
			@imagegif($im);
		}

		if($this->_format=="jpg" || $this->_format=="jpeg" )
		{
			if(!empty($file))
			@imagejpeg($im,$file.".".$this->_format);
			else
			@imagejpeg($im);
		}

		@imagedestroy($im);
	}

	// End Function for S2O5


	///Start Functions from UPCE Encoding

	function ConvertUPCAtoUPCE($upca)
	{
		$csumTotal = 0; // The checksum working variable starts at zero
		$upce ="";
		// If the source message string is less than 12 characters long, we make it 12 characters

		if( strlen($upca) < 12 )
		{
			$barnumber = str_pad($barnumber, 12, "0", STR_PAD_LEFT);
		}

		if( substr($upca,0,1) != '0' && substr($upca,0,1) != '1')
		{
			$this->_error = 'Invalid Number System (only 0 & 1 are valid)';
			return false;
		}
		else
		{
			if( substr($upca,3,3) == '000' || substr($upca,3,3) == '100' ||  substr($upca,3,3) == '200' )
			$upce = substr($upca,1,2) . substr($upca,8,3) . substr($upca,3,1);
			else if( substr($upca,4,2) == '00' )
			$upce = substr($upca,1,2) . substr($upca,9,2) . '3';
			else if( substr($upca,5,1) == '0' )
			$upce = substr($upca,1,4) . substr($upca,10,1) . '4';
			else if( substr($upca,10,1) >= '5' )
			$upce = substr($upca,1,5) . substr($upca,10,1);
			else
			{
				$this->_error = 'Invalid product code (00005 to 00009 are valid)';
				return false;
			}
		}
		return $upce;
	}

	function _upceEncode($barnumber,$encbit,$checkdigit)
	{
		$leftOdd=array("0001101","0011001","0010011","0111101","0100011","0110001","0101111","0111011","0110111","0001011");
		$leftEven=array("0100111","0110011","0011011","0100001","0011101","0111001","0000101","0010001","0001001","0010111");
			
		$encTable0=array("EEEOOO","EEOEOO","EEOOEO","EEOOOE","EOEEOO","EOOEEO","EOOOEE","EOEOEO","EOEOOE","EOOEOE");
		$encTable1=array("OOOEEE","OOEOEE","OOEEOE","OOEEEO","OEOOEE","OEEOOE","OEEEOO","OEOEOE","OEOEEO","OEEOEO");
			
		$guards=array("bab","ababa","b");


		if($encbit==0)
		$encTable=$encTable0;
		elseif($encbit==1)
		$encTable=$encTable1;
		else
		{
			$this->_error="Not an UPC-E barcode number";
			return false;
		}

		$mfcStr="";
		$prodStr="";
		$checkdigit;
		$encTable[$checkdigit];
			
		for($i=0;$i<strlen($barnumber);$i++)
		{
			$num=(int)$barnumber{$i};
			$even=(substr($encTable[$checkdigit],$i,1)=='E');
			if(!$even)
			$mfcStr.=$leftOdd[$num];
			else
			$mfcStr.=$leftEven[$num];
		}

		return $guards[0].$mfcStr.$guards[1].$guards[2];
	}

	function _upceBarcode($barnumber,$scale=1,$file="")
	{

		if(strlen($barnumber)>6)
		{
			$this->_ean13CheckDigit($barnumber);
			$barnumber=substr($this->_ean13CheckDigit($barnumber),1);
			$encbit=$barnumber[0];
			$checkdigit=$barnumber[11];
			$barnumber=$this->ConvertUPCAtoUPCE($barnumber);
		}
		else
		{
			$barnumber=$this->_checkDigit($barnumber,7);
			$encbit=$barnumber[0];
			$checkdigit=$barnumber[7];
			$barnumber=substr($barnumber,1,6);
		}

		$bars=$this->_upceEncode($barnumber,$encbit,$checkdigit);
		if(empty($file))
		header("Content-type: image/".$this->_format);

		if ($scale<1) $scale=2;
		$total_y=(double)$scale * $this->_height;
		if (!$space)
		$space=array('top'=>2*$scale,'bottom'=>2*$scale,'left'=>2*$scale,'right'=>2*$scale);
			
		/* count total width */
		$xpos=0;
			
		$xpos=$scale*strlen($bars)+$scale*12;

		/* allocate the image */
		$total_x= $xpos +$space['left']+$space['right'];
		$xpos=$space['left']+($scale*6);

		$height=floor($total_y-($scale*10));
		$height2=floor($total_y-$space['bottom']);

		$im=@imagecreatetruecolor($total_x, $total_y);
		$bg_color = @imagecolorallocate($im, $this->_bgcolor[0], $this->_bgcolor[1],$this->_bgcolor[2]);
		@imagefilledrectangle($im,0,0,$total_x,$total_y,$bg_color);
		$bar_color = @imagecolorallocate($im, $this->_color[0], $this->_color[1],$this->_color[2]);

		for($i=0;$i<strlen($bars);$i++)
		{
			$h=$height;
			$val=strtoupper($bars[$i]);
			if(preg_match("/[a-z]/i",$val))
			{
				$val=ord($val)-65;
				$h=$height2;
			}

			if($val==1)
			@imagefilledrectangle($im,$xpos, $space['top'],$xpos+$scale-1, $h,$bar_color);
			$xpos+=$scale;
		}
			
			

		@imagettftext($im,$scale*6,0, $space['left'], $height, $bar_color,$this->_font , $encbit);

			
		$x= $space['left']+$scale*strlen($barnumber)+$scale*6;
		@imagettftext($im,$scale*6,0,$x, $height2, $bar_color,$this->_font , $barnumber);

		$x=$total_x-$space['left']-$scale*6;
		@imagettftext($im,$scale*6,0, $x, $height, $bar_color,$this->_font , $checkdigit);
			
		if($this->_format=="png")
		{
			if(!empty($file))
			@imagepng($im,$file.".".$this->_format);
			else
			@imagepng($im);
		}

		if($this->_format=="gif")
		{
			if(!empty($file))
			@imagegif($im,$file.".".$this->_format);
			else
			@imagegif($im);
		}

		if($this->_format=="jpg" || $this->_format=="jpeg" )
		{
			if(!empty($file))
			@imagejpeg($im,$file.".".$this->_format);
			else
			@imagejpeg($im);
		}

		@imagedestroy($im);
	}

	//End UPC-E functions


	///Start Functions from EAN-8 Encoding

	function _checkDigit($barnumber,$number)
	{
		$csumTotal = 0; // The checksum working variable starts at zero

		// If the source message string is less than 12 characters long, we make it 12 characters
		if(strlen($barnumber) < $number)
		{
			$barnumber = str_pad($barnumber, $number, "0", STR_PAD_LEFT);
		}
			
		// Calculate the checksum value for the message
			
		for($i=0;$i<strlen($barnumber);$i++)
		{
			if($i % 2 == 0 )
			$csumTotal = $csumTotal + (3 * intval($barnumber{$i}));
			else
			$csumTotal = $csumTotal + intval($barnumber{$i});
		}

		// Calculate the checksum digit
		//echo $csumTotal;
		if( $csumTotal % 10 == 0 )
		$checksumDigit = '';
		else
		$checksumDigit = 10 - ($csumTotal % 10);
		return $barnumber.$checksumDigit;
	}

	/*An EAN-8 barcode has the following physical structure:

	Left-hand guard bars, or start sentinel, encoded as 101.
	Two number system characters, encoded as left-hand odd-parity characters.
	First two message characters, encoded as left-hand odd-parity characters.
	Center guard bars, encoded as 01010.
	Last three message characters, encoded as right-hand characters.
	Check digit, encoded as right-hand character.
	Right-hand guar bars, or end sentinel, encoded as 101.
	*/

	function _ean8Encode($barnumber)
	{
		$leftOdd=array("0001101","0011001","0010011","0111101","0100011","0110001","0101111","0111011","0110111","0001011");
		$leftEven=array("0100111","0110011","0011011","0100001","0011101","0111001","0000101","0010001","0001001","0010111");
		$rightAll=array("1110010","1100110","1101100","1000010","1011100","1001110","1010000","1000100","1001000","1110100");

		$encTable=array("000000","001011","001101","001110","010011","011001","011100","010101","010110","011010");
			
		$guards=array("bab","ababa","bab");

		$mfcStr="";
		$prodStr="";
			
		for($i=0;$i<strlen($barnumber);$i++)
		{
			$num=(int)$barnumber{$i};
			if($i<4)
			{
				$mfcStr.=$leftOdd[$num];
			}
			elseif($i>=4)
			{
				$prodStr.=$rightAll[$num];
			}

		}

		return $guards[0].$mfcStr.$guards[1].$prodStr.$guards[2];
	}

	function _ean8Barcode($barnumber,$scale=1,$file="")
	{
		$barnumber=$this->_checkDigit($barnumber,7);
		$bars=$this->_ean8Encode($barnumber);
		if(empty($file))
		header("Content-type: image/".$this->_format);

		if ($scale<1) $scale=2;
		$total_y=(double)$scale * $this->_height;
		if (!$space)
		$space=array('top'=>2*$scale,'bottom'=>2*$scale,'left'=>2*$scale,'right'=>2*$scale);
			
		/* count total width */
		$xpos=0;
			
		$xpos=$scale*strlen($bars);

		/* allocate the image */
		$total_x= $xpos +$space['left']+$space['right'];
		$xpos=$space['left'];

		$height=floor($total_y-($scale*10));
		$height2=floor($total_y-$space['bottom']);

		$im=@imagecreatetruecolor($total_x, $total_y);
		$bg_color = @imagecolorallocate($im, $this->_bgcolor[0], $this->_bgcolor[1],$this->_bgcolor[2]);
		@imagefilledrectangle($im,0,0,$total_x,$total_y,$bg_color);
		$bar_color = @imagecolorallocate($im, $this->_color[0], $this->_color[1],$this->_color[2]);

		for($i=0;$i<strlen($bars);$i++)
		{
			$h=$height;
			$val=strtoupper($bars[$i]);
			if(preg_match("/[a-z]/i",$val))
			{
				$val=ord($val)-65;
				$h=$height2;
			}

			if($val==1)
			@imagefilledrectangle($im,$xpos, $space['top'],$xpos+$scale-1, $h,$bar_color);
			$xpos+=$scale;
		}
			
			

		$str=substr($barnumber,0,4);
		$x= $space['left']+$scale*strlen($barnumber);
		@imagettftext($im,$scale*6,0,$x, $height2, $bar_color,$this->_font , $str);
			
		$str=substr($barnumber,4,4);
		$x=$space['left']+$scale*strlen($bars)/1.65;
		@imagettftext($im,$scale*6,0, $x, $height2, $bar_color,$this->_font ,$str);

		if($this->_format=="png")
		{
			if(!empty($file))
			@imagepng($im,$file.".".$this->_format);
			else
			@imagepng($im);
		}

		if($this->_format=="gif")
		{
			if(!empty($file))
			@imagegif($im,$file.".".$this->_format);
			else
			@imagegif($im);
		}

		if($this->_format=="jpg" || $this->_format=="jpeg" )
		{
			if(!empty($file))
			@imagejpeg($im,$file.".".$this->_format);
			else
			@imagejpeg($im);
		}

		@imagedestroy($im);
	}
	////End functions fron EAN-8 Encoding

	///Start Functions from EAN-13 Encoding

	function _ean13CheckDigit($barnumber)
	{
		$csumTotal = 0; // The checksum working variable starts at zero

		// If the source message string is less than 12 characters long, we make it 12 characters
		if(strlen($barnumber) <= 12 )
		{
			$barnumber = str_pad($barnumber, 13, "0", STR_PAD_LEFT);
		}
			
		/*if(strlen($barnumber) == 13)
		 $barnumber = substr($barnumber,0,12);*/

		// Calculate the checksum value for the message
			
		for($i=0;$i<strlen($barnumber);$i++)
		{
			if($i % 2 == 0 )
			$csumTotal = $csumTotal + intval($barnumber{$i});
			else
			$csumTotal = $csumTotal + (3 * intval($barnumber{$i}));
		}

		// Calculate the checksum digit

		if( $csumTotal % 10 == 0 )
		$checksumDigit = '';
		else
		$checksumDigit = 10 - ($csumTotal % 10);
		return $barnumber.$checksumDigit;
	}

	/*An EAN-13 barcode has the following physical structure:

	Left-hand guard bars, or start sentinel, encoded as 101.
	The second character of the number system code, encoded as described below.
	The five characters of the manufacturer code, encoded as described below.
	Center guard pattern, encoded as 01010.
	The five characters of the product code, encoded as right-hand characters, described below.
	Check digit, encoded as a right-hand character, described below.
	Right-hand guard bars, or end sentinel, encoded as 101.
	FIRST NUMBER

	SYSTEM DIGIT PARITY TO ENCODE WITH
	SECOND NUMBER
	SYSTEM DIGIT MANUFACTURER CODE CHARACTERS
	1	2	3	 4	5
	0 (UPC-A)	Odd	Odd	Odd	Odd	Odd	Odd
	1			Odd Odd Even Odd Even Even
	2			Odd Odd Even Even Odd Even
	3			Odd Odd Even Even Even Odd
	4			Odd Even Odd Odd Even Even
	5			Odd Even Even Odd Odd Even
	6			Odd Even Even Even Odd Odd
	7			Odd Even Odd Even Odd Even
	8			Odd Even Odd Even Even Odd
	9			Odd Even Even Odd Even Odd


	*/

	function _eanEncode($barnumber)
	{
		$leftOdd=array("0001101","0011001","0010011","0111101","0100011","0110001","0101111","0111011","0110111","0001011");
		$leftEven=array("0100111","0110011","0011011","0100001","0011101","0111001","0000101","0010001","0001001","0010111");
		$rightAll=array("1110010","1100110","1101100","1000010","1011100","1001110","1010000","1000100","1001000","1110100");

		$encTable=array("000000","001011","001101","001110","010011","011001","011100","010101","010110","011010");
			
		$guards=array("bab","ababa","bab");

		$mfcStr="";
		$prodStr="";
			
		$encbit=$barnumber[0];

		for($i=1;$i<strlen($barnumber);$i++)
		{
			$num=(int)$barnumber{$i};
			if($i<7)
			{
				$even=(substr($encTable[$encbit],$i-1,1)==1);
				if(!$even)
				$mfcStr.=$leftOdd[$num];
				else
				$mfcStr.=$leftEven[$num];
			}
			elseif($i>=7)
			{
				$prodStr.=$rightAll[$num];
			}

		}

		return $guards[0].$mfcStr.$guards[1].$prodStr.$guards[2];
	}

	function _eanBarcode($barnumber,$scale=1,$file="")
	{
		$barnumber=$this->_ean13CheckDigit($barnumber);

		$bars=$this->_eanEncode($barnumber);
		if(empty($file))
		header("Content-type: image/".$this->_format);

		if ($scale<1) $scale=2;
		$total_y=(double)$scale * $this->_height;
		if (!$space)
		$space=array('top'=>2*$scale,'bottom'=>2*$scale,'left'=>2*$scale,'right'=>2*$scale);
			
		/* count total width */
		$xpos=0;
			
		$xpos=$scale*(114);

		/* allocate the image */
		$total_x= $xpos +$space['left']+$space['right'];
		$xpos=$space['left']+($scale*6);

		$height=floor($total_y-($scale*10));
		$height2=floor($total_y-$space['bottom']);

		$im=@imagecreatetruecolor($total_x, $total_y);
		$bg_color = @imagecolorallocate($im, $this->_bgcolor[0], $this->_bgcolor[1],$this->_bgcolor[2]);
		@imagefilledrectangle($im,0,0,$total_x,$total_y,$bg_color);
		$bar_color = @imagecolorallocate($im, $this->_color[0], $this->_color[1],$this->_color[2]);

		for($i=0;$i<strlen($bars);$i++)
		{
			$h=$height;
			$val=strtoupper($bars[$i]);
			if(preg_match("/[a-z]/i",$val))
			{
				$val=ord($val)-65;
				$h=$height2;
			}
			if($this->_encode=="UPC-A" && ($i<10 || $i>strlen($bars)-13))
			$h=$height2;

			if($val==1)
			@imagefilledrectangle($im,$xpos, $space['top'],$xpos+$scale-1, $h,$bar_color);
			$xpos+=$scale;
		}
			
			
		if($this->_encode=="UPC-A")
		$str=substr($barnumber,1,1);
		else
		$str=substr($barnumber,0,1);

		@imagettftext($im,$scale*6,0, $space['left'], $height, $bar_color,$this->_font , $str);

		if($this->_encode=="UPC-A")
		$str=substr($barnumber,2,5);
		else
		$str=substr($barnumber,1,6);
			
		$x= $space['left']+$scale*strlen($barnumber)+$scale*6;
		@imagettftext($im,$scale*6,0,$x, $height2, $bar_color,$this->_font , $str);
			
		if($this->_encode=="UPC-A")
		$str=substr($barnumber,7,5);
		else
		$str=substr($barnumber,7,6);
		$x=$space['left']+$scale*strlen($bars)/1.65+$scale*6;
		@imagettftext($im,$scale*6,0, $x, $height2, $bar_color,$this->_font ,$str);

		if($this->_encode=="UPC-A")
		{
			$str=substr($barnumber,12,1);
			$x=$total_x-$space['left']-$scale*6;
			@imagettftext($im,$scale*6,0, $x, $height, $bar_color,$this->_font , $str);
		}
			
		if($this->_format=="png")
		{
			if(!empty($file))
			@imagepng($im,$file.".".$this->_format);
			else
			@imagepng($im);
		}

		if($this->_format=="gif")
		{
			if(!empty($file))
			@imagegif($im,$file.".".$this->_format);
			else
			@imagegif($im);
		}

		if($this->_format=="jpg" || $this->_format=="jpeg" )
		{
			if(!empty($file))
			@imagejpeg($im,$file.".".$this->_format);
			else
			@imagejpeg($im);
		}

		@imagedestroy($im);
	}



} ?>
