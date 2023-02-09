<?php
class NivelInglesFase02sController extends AppController {

	var $name = 'NivelInglesFase02s';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		
		$opcoes = "LOWER(`NivelInglesFase02`.`ano`) LIKE '%" . $findUrl ."%' OR LOWER(`NivelInglesFase02`.`identidade`) LIKE '%" . $findUrl ."%'  OR LOWER(`NivelInglesFase02`.`regional`) LIKE '%" . $findUrl ."%'  OR LOWER(`NivelInglesFase02`.`local_trabalho`) LIKE '%" . $findUrl ."%'   OR LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' ";
		
		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->NivelInglesFase02->recursive = 2;
			$this->NivelInglesFase02->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('nivelInglesFase02s', $this->paginate('NivelInglesFase02',array($opcoes)));
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->NivelInglesFase02->recursive = 2;
			$this->NivelInglesFase02->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('nivelInglesFase02s', $this->paginate());
		}
	}


}
?>