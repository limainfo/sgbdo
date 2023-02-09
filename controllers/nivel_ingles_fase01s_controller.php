<?php
class NivelInglesFase01sController extends AppController {

	var $name = 'NivelInglesFase01s';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		
		$opcoes = "LOWER(`NivelInglesFase01`.`ano`) LIKE '%" . $findUrl ."%' OR LOWER(`NivelInglesFase01`.`identidade`) LIKE '%" . $findUrl ."%'  OR LOWER(`NivelInglesFase01`.`regional`) LIKE '%" . $findUrl ."%'  OR LOWER(`NivelInglesFase01`.`local_trabalho`) LIKE '%" . $findUrl ."%'   OR LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' ";
		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->NivelInglesFase01->recursive = 2;
			$this->NivelInglesFase01->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('nivelInglesFase01s', $this->paginate('NivelInglesFase01',array($opcoes)));
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->NivelInglesFase01->recursive = 2;
			$this->NivelInglesFase01->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('nivelInglesFase01s', $this->paginate());
		}
	}


}
?>