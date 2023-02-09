<?php
class Controlehoradado extends AppModel {

	var $name = 'Controlehoradado';
	var $validate = array(
	);

	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => 'Militar.ativa=1',
								'fields' => '',
								'order' => ''
			),
			'Escala' => array('className' => 'Escala',
								'foreignKey' => 'escala_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Setor' => array('className' => 'Setor',
								'foreignKey' => 'setor_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Controlehora' => array('className' => 'Controlehora',
								'foreignKey' => 'controlehora_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>