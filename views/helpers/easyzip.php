<?php
App::import('Vendor','EasyZIP', array('file' => 'EasyZIP.class.php'));

class easyzipHelper extends EasyZip {
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
	function easyzipHelper($filename = 'dados.ods') {
		//$this->planilha = new OpenOfficeSpreadsheet($filename);
		//$this->planilha = $this->__construct($filename);
	}

	function gera($dados = null, $cursos = null){
		$planilha = new EasyZIP($dados);
		//$planilha = $this->__construct($dados);
		$folha1 = $planilha->addSheet(iconv('UTF-8','ISO-8859-1','Relação de Militares'));
		//$feuille_2 = $planilha->addSheet('Une deuxième');
		//$cell_3 = $feuille_2->getCell(4, 4);
		//$cell_3->setContent('Sur la feuille 2');

	}
}
?>
