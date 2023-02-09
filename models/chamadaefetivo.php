<?php
class Chamadaefetivo extends AppModel {
	var $displayField = 'nome_chamada';


	var $name = 'Chamadaefetivo';


	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
								'foreignKey' => 'militar_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Militar.nm_guerra asc'
								)
			
	);

						
}
?>