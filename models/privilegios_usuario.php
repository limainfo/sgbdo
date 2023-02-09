<?php
class PrivilegiosUsuario extends AppModel {

	var $name = 'PrivilegiosUsuario';


	//var $actsAs = array('Logable'); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Usuario' => array('className' => 'Usuario',
								'foreignKey' => 'usuario_id',
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

}
?>