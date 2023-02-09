<?php
class Usuario extends AppModel {
	
	var $name = 'Usuario';
	

//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Privilegio' => array('className' => 'Privilegio',
								'foreignKey' => 'privilegio_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasAndBelongsToMany = array(

			'Bca' => array('className' => 'Bca',
						'joinTable' => 'bcasassinados',
						'foreignKey' => 'militar_id',
						'associationForeignKey' => 'bca_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			),
			'Setor' => array('className' => 'Setor',
						'joinTable' => 'setors_usuarios',
						'foreignKey' => 'usuario_id',
						'associationForeignKey' => 'setor_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);

}
?>