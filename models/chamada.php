<?php
class Chamada extends AppModel {
	var $displayField = 'nome_guerra';


	var $name = 'Chamada';


	var $belongsTo = array(
			'Chamadaefetivo' => array('className' => 'Chamadaefetivo',
								'foreignKey' => 'chamadaefetivo_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
			
	);

						
}
?>