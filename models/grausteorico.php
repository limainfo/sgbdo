<?php
class Grausteorico extends AppModel {

	var $name = 'Grausteorico';
	var $displayField = 'grau_teorico';
//	var $order = 'Curso.codigo asc';
	var $validate = array(
	);
//		'codigo' => array('alphanumeric')

	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	
}
?>