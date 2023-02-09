<?php
class PamsController extends AppController {

	var $name = 'Pams';
	var $helpers = array('Html', 'Form');


	function externoconsulta($id = null) {
		$this->layout='popup';
			$this->Pam->recursive = 0;
			$order = array('order'=>array('Pam.gestor'=>'asc','Pam.numero'=>'asc'));
			$this->set('pams', $this->Pam->find('all',$order));
		

	}


}
?>