<?php
class GerentesController extends AppController {

	var $name = 'Gerentes';
	var $helpers = array('Html', 'Form', 'Ajax');


	function index($id = null) {

		$sql = "select * from  cursos limit 0,10 ";

		$antiguidade = $this->Gerente->query($sql);
			

		$this->set(compact( 'antiguidade'));
	}




}
?>