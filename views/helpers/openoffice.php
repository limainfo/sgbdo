<?php
App::import('Vendor','OpenOfficeSpreadsheet', array('file' => 'calc'.DS.'classes'.DS.'OpenOfficeSpreadsheet.class.php'));

class openofficeHelper extends OpenOfficeSpreadsheet {
      var $helpers = array();
	var $documentName;
	var $planilha;
	/**
	 * Creates the necessary objects and a temporary Excel file. Sets the
	 * directory for temporary file creation and sets the version to
	 * Excel 97 (support UTF-8).
	 *
	 * @param string $filename Name of the downloadable file
	 */
	function openofficeHelper($filename = 'dados.ods') {
		//$this->planilha = new OpenOfficeSpreadsheet($filename);
		//$this->planilha = $this->__construct($filename);
	}

	function gera($dados = null, $cursos = null){
		$planilha = new OpenOfficeSpreadsheet();
		//$planilha = $this->__construct($dados);
		$folha1 = $planilha->addSheet(iconv('UTF-8','ISO-8859-1','Relação de Militares'));
		//$feuille_2 = $planilha->addSheet('Une deuxième');
		//$cell_3 = $feuille_2->getCell(4, 4);
		//$cell_3->setContent('Sur la feuille 2');
		$corTitulo = '#cccccc';
		$celula1 = $folha1->getCell(1, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('NM_GUERRA');

		$celula1 = $folha1->getCell(2, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('POSTO');

		$celula1 = $folha1->getCell(3, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('ESPECIALIDADE');

		$celula1 = $folha1->getCell(4, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('NM_COMPLETO');

		$celula1 = $folha1->getCell(5, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('SARAM');

		$celula1 = $folha1->getCell(6, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('IDENTIDADE');

		$celula1 = $folha1->getCell(7, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DATA_FORMACAO');

		$celula1 = $folha1->getCell(8, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DATA_PROMOCAO');

		$celula1 = $folha1->getCell(9, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('UNIDADE');

		$celula1 = $folha1->getCell(10,1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('ORGAO');

		$celula1 = $folha1->getCell(11, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('SETOR');

		$celula1 = $folha1->getCell(12, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('INDOPER');

		$celula1 = $folha1->getCell(13, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('SITUACAO');

		$celula1 = $folha1->getCell(14, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('OBS');

		$celula1 = $folha1->getCell(15, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('ESCALAS');

		$celula1 = $folha1->getCell(16, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DATA_APRESENTACAO');

		$celula1 = $folha1->getCell(17, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DATA_ADMISSAO');

		$celula1 = $folha1->getCell(18, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('TEMPO_SERVICO');

		$coluna=19;

		foreach($cursos as $informacao){
			$celula1 = $folha1->getCell($coluna, 1);
			$celula1->setBackgroundColor($corTitulo);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Curso']['codigo']));
			$coluna++;
		}
			


		$linha=2;
		foreach($dados as $informacao){
			$celula1 = $folha1->getCell(1, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['nm_guerra']));
			$celula1 = $folha1->getCell(2, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Posto']['sigla_posto']));
			$celula1 = $folha1->getCell(3, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Quadro']['sigla_quadro'].'-'.$informacao['Especialidade']['nm_especialidade']));
			$celula1 = $folha1->getCell(4, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['nm_completo']));
			$celula1 = $folha1->getCell(5, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['saram']));
			$celula1 = $folha1->getCell(6, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['identidade']));
			$celula1 = $folha1->getCell(7, $linha);
			$celula1->setContent($informacao['Militar']['dt_formacao']);
			$celula1 = $folha1->getCell(8, $linha);
			$celula1->setContent($informacao['Militar']['dt_ultima_promocao']);
			$celula1 = $folha1->getCell(9, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Unidade']['sigla_unidade']));
			$celula1 = $folha1->getCell(10, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['orgao']));
			$celula1 = $folha1->getCell(11, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Setor']['sigla_setor']));
			$celula1 = $folha1->getCell(12, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['indicativo']));
			$celula1 = $folha1->getCell(13, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['situacao']));
			$celula1 = $folha1->getCell(14, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['obs']));
			$celula1 = $folha1->getCell(15, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['0']['setores']));
			$celula1 = $folha1->getCell(16, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['dt_apresentacao']));
			$celula1 = $folha1->getCell(17, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['dt_admissao']));
			$celula1 = $folha1->getCell(18, $linha);
			
			$diferenca = strtotime(date()) - strtotime($informacao['Militar']['dt_admissao']);
			$dia_atual = date('d');
			$dia_admissao = date('d',strtotime($informacao['Militar']['dt_admissao']));
			$mes_atual = date('m');
			$mes_admissao = date('m',strtotime($informacao['Militar']['dt_admissao']));
			$ano_atual = date('Y');
			$ano_admissao = date('Y',strtotime($informacao['Militar']['dt_admissao']));
			$meses = ($ano_atual - $ano_admissao)*12 + ($mes_atual - $mes_admissao);
			
			$ano = floor($meses/12);
			
			$nmes = ($meses%12)*30 + ($dia_atual - $dia_admissao);
			$mes = floor($nmes/30);
			
			$dia = $nmes%30;
			
			
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$ano.'a '.$mes.'m'.' '.$dia.'d'));
			
			$vetor = explode(',',$informacao['0']['cursos_id']);

			$coluna=19;


			foreach($cursos as $curso){

				for($k=0;$k<count($vetor);$k++){
					if($curso['Curso']['id']==$vetor[$k]){
						$celula1 = $folha1->getCell($coluna, $linha);
						$celula1->setBackgroundColor('#902020');
						$celula1->setContent('X');
					}
				}

				$coluna++;
				//if($coluna==255){break;}
			}


			$linha++;
		}
		$planilha->output();
	}

	function gerapaeat($dados = null){
		$planilha = new OpenOfficeSpreadsheet($dados);
		$folha1 = $planilha->addSheet(iconv('UTF-8','ISO-8859-1','PAEAT - Lista de Indicados'));
		$corTitulo = '#cccccc';

$linha = 0;		
$referencia = $dados[0]['Paeatsindicado']['paeat_id'];
$primeiralinha['flag']=0;
$segundalinha['flag']=0;
foreach($dados as $informacao){
	if($referencia==$informacao['Paeatsindicado']['paeat_id']){
		
		if($primeiralinha['flag']==0){
		$primeiralinha['flag']=1;

		$celula1 = $folha1->getCell(1, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('CURSO');

		$celula1 = $folha1->getCell(2, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DT_INICIO');

		$celula1 = $folha1->getCell(3, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DT_FIM');

		$celula1 = $folha1->getCell(4, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('LOCAL');

		$celula1 = $folha1->getCell(5, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('TURMA');

		$linha++;
		$celula1 = $folha1->getCell(1, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeat']['codcurso']));
		$celula1 = $folha1->getCell(2, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeat']['inicio']));
		$celula1 = $folha1->getCell(3, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeat']['fim']));
		$celula1 = $folha1->getCell(4, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeat']['local']));
		$celula1 = $folha1->getCell(5, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeat']['turma']));
		$linha++;
		
		}
			

		if($segundalinha['flag']==0){
		$segundalinha['flag']=1;
		$celula1 = $folha1->getCell(2, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('PRIORIDADE');

		$celula1 = $folha1->getCell(3, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('ATRIBUTO');

		$celula1 = $folha1->getCell(4, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('INDICADO');

		$celula1 = $folha1->getCell(5, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('NOME DE GUERRA');

		$celula1 = $folha1->getCell(6, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('SARAM');

		$celula1 = $folha1->getCell(7, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('IDENTIDADE');
		
		$celula1 = $folha1->getCell(8, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('CPF');
		
		$celula1 = $folha1->getCell(9, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DEPENDENTES');
		
		$celula1 = $folha1->getCell(10, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('VAGA');
		
		$celula1 = $folha1->getCell(11, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('UNIDADE');
		
		$celula1 = $folha1->getCell(12, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('SETOR');
		
		
		$linha++;
		}
		
		
		$celula1 = $folha1->getCell(2, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeatsindicado']['prioridade']));
		$celula1 = $folha1->getCell(3, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeatsindicado']['atributo']));
		$celula1 = $folha1->getCell(4, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeatsindicado']['nomecompleto']));
		$celula1 = $folha1->getCell(5, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['nm_guerra']));
		$celula1 = $folha1->getCell(6, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['saram']));
		$celula1 = $folha1->getCell(7, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['identidade']));
		$celula1 = $folha1->getCell(8, $linha);
                $informacao['Militar']['cpf'] = str_pad($informacao['Militar']['cpf'], 11, "0", STR_PAD_LEFT);  

		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['cpf']));
		$celula1 = $folha1->getCell(9, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['total_beneficiarios']));
		$celula1 = $folha1->getCell(10, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeatsindicado']['referenciavaga']));
		$celula1 = $folha1->getCell(11, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Unidade']['sigla_unidade']));
		$celula1 = $folha1->getCell(12, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Setor']['sigla_setor']));
		
		$linha++;

		}else{

		$referencia=$informacao['Paeatsindicado']['paeat_id'];
		$primeiralinha['flag']=0;
		$segundalinha['flag']=0;
		
		if($primeiralinha['flag']==0){
		$primeiralinha['flag']=1;
			
		$celula1 = $folha1->getCell(1, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('CURSO');

		$celula1 = $folha1->getCell(2, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DT_INICIO');

		$celula1 = $folha1->getCell(3, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DT_FIM');

		$celula1 = $folha1->getCell(4, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('LOCAL');

		$celula1 = $folha1->getCell(5, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('TURMA');

		$linha++;
		$celula1 = $folha1->getCell(1, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeat']['codcurso']));
		$celula1 = $folha1->getCell(2, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeat']['inicio']));
		$celula1 = $folha1->getCell(3, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeat']['fim']));
		$celula1 = $folha1->getCell(4, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeat']['local']));
		$celula1 = $folha1->getCell(5, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeat']['turma']));
		$linha++;
		
		}
			

		if($segundalinha['flag']==0){
		$segundalinha['flag']=1;			
		$celula1 = $folha1->getCell(2, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('PRIORIDADE');

		$celula1 = $folha1->getCell(3, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('INDICADO');

		$celula1 = $folha1->getCell(4, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('NOME DE GUERRA');

		$celula1 = $folha1->getCell(5, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('SARAM');

		$celula1 = $folha1->getCell(6, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('IDENTIDADE');
		
		$celula1 = $folha1->getCell(7, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('CPF');
		
		$celula1 = $folha1->getCell(8, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DEPENDENTES');
		
		$celula1 = $folha1->getCell(9, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('VAGA');
		
		$celula1 = $folha1->getCell(10, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('UNIDADE');
		
		$celula1 = $folha1->getCell(11, $linha);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('SETOR');
		
		
		$linha++;
		}
		
		
		$celula1 = $folha1->getCell(2, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeatsindicado']['prioridade']));
		$celula1 = $folha1->getCell(3, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeatsindicado']['nomecompleto']));
		$celula1 = $folha1->getCell(4, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['nm_guerra']));
		$celula1 = $folha1->getCell(5, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['saram']));
		$celula1 = $folha1->getCell(6, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['identidade']));
		$celula1 = $folha1->getCell(7, $linha);
                $informacao['Militar']['cpf'] = str_pad($informacao['Militar']['cpf'], 11, "0", STR_PAD_LEFT);  
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['cpf']));
		$celula1 = $folha1->getCell(8, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Militar']['total_beneficiarios']));
		$celula1 = $folha1->getCell(9, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Paeatsindicado']['referenciavaga']));
		$celula1 = $folha1->getCell(10, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Unidade']['sigla_unidade']));
		$celula1 = $folha1->getCell(11, $linha);
		$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Setor']['sigla_setor']));
				
		$linha++;
		}
	}
		$planilha->output();
	}
	
	function cursos($linhas = null, $colunas = null, $celulaP = null, $celulaE = null, $celulaS = null, $somaP = null, $somaE = null, $somaS = null){
		$planilha = new OpenOfficeSpreadsheet($titulo);
		$folha1 = $planilha->addSheet(iconv('UTF-8','ISO-8859-1','PLANEJAMENTO DE CURSOS'));
		$corTitulo = '#cccccc';
		$celula1 = $folha1->getCell(1, 1);
		$celula1->setBackgroundColor($corTitulo);

		$linha = 2;
		$coluna = 4;

		foreach($colunas as $curso){
			$celula1 = $folha1->getCell($coluna, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',strtoupper($curso['Curso']['codigo'])));
			$coluna += 3;
		}
		
		$linha = 3;
		$coluna = 1;

		$celula1 = $folha1->getCell($coluna, $linha);
		$celula1->setContent('UNIDADE');
		$coluna++;
		$celula1 = $folha1->getCell($coluna, $linha);
		$celula1->setContent('SETOR');
		$coluna++;
		$celula1 = $folha1->getCell($coluna, $linha);
		$celula1->setContent('ESPECIALIDADE');
		$coluna++;

		foreach($colunas as $curso){
			$celula1 = $folha1->getCell($coluna, $linha);
			$celula1->setContent('PREVISTO');
			$coluna ++;
			$celula1 = $folha1->getCell($coluna, $linha);
			$celula1->setContent('EXISTENTE');
			$coluna ++;
			$celula1 = $folha1->getCell($coluna, $linha);
			$celula1->setContent('SALDO');
			$coluna ++;
		}
		
		$linha = 4;
		foreach($linhas as $setor){
			$celula1 = $folha1->getCell(1, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',strtoupper($setor['Unidade']['sigla_unidade'])));
			$celula1 = $folha1->getCell(2, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',strtoupper($setor['Setor']['sigla_setor'])));
			$celula1 = $folha1->getCell(3, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',strtoupper($setor['Especialidade']['nm_especialidade'])));
			$linha ++;
		}
		
		$coluna = 4;
		$linha = 4;
		
		foreach($linhas as $setor){
			$coluna = 4;
			foreach($colunas as $curso){
				$celula1 = $folha1->getCell($coluna, $linha);
				$celula1->setContent($celulaP[$curso['Curso']['id']][$setor['Especialidade']['id']][$setor['Setor']['id']]);
				$coluna ++;
				$celula1 = $folha1->getCell($coluna, $linha);
				$celula1->setContent($celulaE[$curso['Curso']['id']][$setor['Especialidade']['id']][$setor['Setor']['id']]);
				$coluna ++;
				$celula1 = $folha1->getCell($coluna, $linha);
				$celula1->setContent($celulaS[$curso['Curso']['id']][$setor['Especialidade']['id']][$setor['Setor']['id']]);
				$coluna ++;
			}
			$linha ++;
		}

			$coluna = 4;
			foreach($colunas as $curso){
				$celula1 = $folha1->getCell($coluna, $linha);
				$celula1->setContent($somaP[$curso['Curso']['id']]);
				$coluna ++;
				$celula1 = $folha1->getCell($coluna, $linha);
				$celula1->setContent($somaE[$curso['Curso']['id']]);
				$coluna ++;
				$celula1 = $folha1->getCell($coluna, $linha);
				$celula1->setContent($somaS[$curso['Curso']['id']]);
				$coluna ++;
			}
		/*
		 $linha = 3;
		 foreach($conteudo as $informacao){
			$coluna = 1;
			foreach($campos as $campo){
			$celula1 = $folha1->getCell($coluna, $linha);
			if(is_string($informacao[$tabela][$campo])){
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao[$tabela][$campo]));
			}else{
			$celula1->setContent($informacao[$tabela][$campo]);
			}
			$coluna++;
			}


			$linha++;
			}
			*/

		$planilha->output();

	}



	function planilha($titulo = null, $conteudo = null, $tabela = null, $campos = null){
		$planilha = new OpenOfficeSpreadsheet($titulo);
		$folha1 = $planilha->addSheet(iconv('UTF-8','ISO-8859-1',$titulo));
		$corTitulo = '#cccccc';
		$celula1 = $folha1->getCell(1, 1);
		$celula1->setBackgroundColor($corTitulo);

		$total = count($conteudo);

		$celula1->setContent('Total de registros:'.$total);
		$linha = 2;
		$coluna = 1;

		foreach($campos as $campo){
			$celula1 = $folha1->getCell($coluna, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',strtoupper($campo)));
			$coluna++;
		}



		$linha = 3;
		foreach($conteudo as $informacao){
			$coluna = 1;
			foreach($campos as $campo){
				$celula1 = $folha1->getCell($coluna, $linha);
				if(is_string($informacao[$tabela][$campo])){
					$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao[$tabela][$campo]));
				}else{
					$celula1->setContent($informacao[$tabela][$campo]);
				}
				$coluna++;
			}


			$linha++;
		}


		$planilha->output();

	}

	function planilhaPersonalizada($titulo = null, $conteudo = null,  $campos = null){
		$planilha = new OpenOfficeSpreadsheet($titulo);
		$folha1 = $planilha->addSheet(iconv('UTF-8','ISO-8859-1',$titulo));
		$corTitulo = '#cccccc';
		$celula1 = $folha1->getCell(1, 1);
		$celula1->setBackgroundColor($corTitulo);

		$total = count($conteudo);

		$celula1->setContent('Total de registros:'.$total);
		$linha = 2;
		$coluna = 1;

		foreach($campos as $campo){
			$celula1 = $folha1->getCell($coluna, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',strtoupper($campo)));
			$coluna++;
		}



		$linha = 3;
		foreach($conteudo as $informacao){
			$coluna = 1;
			foreach($campos as $campo){
				$celula1 = $folha1->getCell($coluna, $linha);
				if(is_int($campo)&&(!empty($informacao[$campo]))){
					$celula1->setBackgroundColor('#d09090');
				}
				$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao[$campo]));
				$coluna++;
			}
			$linha++;
		}


		$planilha->output();

	}

	
	function planilhaMilitarCurso($titulo = null, $conteudo = null, $tabela = null, $campos = null){
				$planilha = new OpenOfficeSpreadsheet($dados);
		//$planilha = $this->__construct($dados);
		$folha1 = $planilha->addSheet(iconv('UTF-8','ISO-8859-1','Relação de Militares'));
		//$feuille_2 = $planilha->addSheet('Une deuxième');
		//$cell_3 = $feuille_2->getCell(4, 4);
		//$cell_3->setContent('Sur la feuille 2');
		$corTitulo = '#cccccc';
		$celula1 = $folha1->getCell(1, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('ID');

		$celula1 = $folha1->getCell(2, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('CODIGO');

		$celula1 = $folha1->getCell(3, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DESCRICAO');

		$celula1 = $folha1->getCell(4, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('REQUISITO');

		$celula1 = $folha1->getCell(5, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('OBJETIVO');

		$celula1 = $folha1->getCell(6, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('MILITAR');

		$celula1 = $folha1->getCell(7, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('IENTIDADE');

		$celula1 = $folha1->getCell(8, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('SETOR');

		$celula1 = $folha1->getCell(9, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('UNIDADE');

		$celula1 = $folha1->getCell(10, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('INICIO');

		$celula1 = $folha1->getCell(11, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('FIM');

		$celula1 = $folha1->getCell(12, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('LOCAL');

		$celula1 = $folha1->getCell(13, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DOCUMENTO');


		$linha=2;
		foreach($conteudo as $informacao){
			$celula1 = $folha1->getCell(1, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Curso']['ID']));
			$celula1 = $folha1->getCell(2, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Curso']['CODIGO']));
			$celula1 = $folha1->getCell(3, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Curso']['DESCRICAO']));
			$celula1 = $folha1->getCell(4, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Curso']['REQUISITO']));
			$celula1 = $folha1->getCell(5, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Curso']['OBJETIVO']));
			$celula1 = $folha1->getCell(6, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao[0]['MILITAR']));
			$celula1 = $folha1->getCell(7, $linha);
			$celula1->setContent($informacao['Militar']['IDENTIDADE']);
			$celula1 = $folha1->getCell(8, $linha);
			$celula1->setContent($informacao['Setor']['SETOR']);
			$celula1 = $folha1->getCell(9, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Unidade']['UNIDADE']));
			$celula1 = $folha1->getCell(10, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['MilitarsCurso']['INICIO']));
			$celula1 = $folha1->getCell(11, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['MilitarsCurso']['FIM']));
			$celula1 = $folha1->getCell(12, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['MilitarsCurso']['LOCAL']));
			$celula1 = $folha1->getCell(13, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['MilitarsCurso']['DOCUMENTO']));

			$vetor = explode(',',$informacao['0']['cursos_id']);

			$coluna=16;

			foreach($cursos as $curso){

				for($k=0;$k<count($vetor);$k++){
					if($curso['Curso']['id']==$vetor[$k]){
						$celula1 = $folha1->getCell($coluna, $linha);
						$celula1->setBackgroundColor('#902020');
						$celula1->setContent('X');
					}
				}

				$coluna++;
				if($coluna==255){break;}
			}


			$linha++;
		}

		$planilha->output();

	}
	
	
	function inspecao($dados = null){
		$planilha = new OpenOfficeSpreadsheet($dados);
		//$planilha = $this->__construct($dados);
		$folha1 = $planilha->addSheet(iconv('UTF-8','ISO-8859-1','Relação de Inspeções'));
		//$feuille_2 = $planilha->addSheet('Une deuxième');
		//$cell_3 = $feuille_2->getCell(4, 4);
		//$cell_3->setContent('Sur la feuille 2');
		$corTitulo = '#cccccc';
		$celula1 = $folha1->getCell(1, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('ORIGEM');

		$celula1 = $folha1->getCell(2, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('TIPO');

		$celula1 = $folha1->getCell(3, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('NUMERO');

		$celula1 = $folha1->getCell(4, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DATA');


		$celula1 = $folha1->getCell(5, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('ORGAO');

		$celula1 = $folha1->getCell(6, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('ITEM');

		$celula1 = $folha1->getCell(7, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('DESCRICAO');

		$celula1 = $folha1->getCell(8, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('CONTROLE OAPLE');

		$celula1 = $folha1->getCell(9, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('GESTOR');

		$celula1 = $folha1->getCell(10, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('ACAO RECOMENDADA');

		$celula1 = $folha1->getCell(11, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('OBSERVACAO CHF DO');

		$celula1 = $folha1->getCell(12, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('PROVIDENCIA GESTOR');

		$celula1 = $folha1->getCell(13, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('EXECUTOR');

		$celula1 = $folha1->getCell(14, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('ACAO EXECUTOR');

		$celula1 = $folha1->getCell(15, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('PRAZO');

		$celula1 = $folha1->getCell(16, 1);
		$celula1->setBackgroundColor($corTitulo);
		$celula1->setContent('STATUS');

			


		$linha=2;
		foreach($dados as $informacao){
			$celula1 = $folha1->getCell(1, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['origem']));
			$celula1 = $folha1->getCell(2, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['tipo']));
			$celula1 = $folha1->getCell(3, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['numero']));
			$celula1 = $folha1->getCell(4, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspescao']['data']));
			$celula1 = $folha1->getCell(5, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['orgao']));
			$celula1 = $folha1->getCell(6, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['item']));
			$celula1 = $folha1->getCell(7, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['descricao']));
			$celula1 = $folha1->getCell(8, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['controle_oaple']));
			$celula1 = $folha1->getCell(9, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['gestor']));
			$celula1 = $folha1->getCell(10, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['acao_recomendada']));
			$celula1 = $folha1->getCell(11, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['obs_do']));
			$celula1 = $folha1->getCell(12, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['providencia_gestor']));
			$celula1 = $folha1->getCell(13, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['executor']));
			$celula1 = $folha1->getCell(14, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['acao_executor']));
			$celula1 = $folha1->getCell(15, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['prazo']));
			$celula1 = $folha1->getCell(16, $linha);
			$celula1->setContent(iconv('UTF-8','ISO-8859-1',$informacao['Inspecao']['status']));



			$linha++;
		}

		$planilha->output();
	}

}
?>
