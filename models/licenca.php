<?php
class Licenca extends AppModel {
	var $name = 'Licenca';
	var $displayField = 'numero_licenca';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Unidade' => array(
			'className' => 'Unidade',
			'foreignKey' => 'unidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Carimbo' => array(
			'className' => 'Carimbo',
			'foreignKey' => 'carimbo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Militar' => array(
			'className' => 'Militar',
			'foreignKey' => 'militar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Ata' => array(
			'className' => 'Ata',
			'foreignKey' => 'ata_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/*
	var $hasOne = array(
		'Foto' => array('className' => 'Foto',
			'foreignKey' => false,
			'dependent' => false,
			'conditions' => 'Foto.militar_id=Licenca.militar_id',
			'fields' => '',
			'order' => ''
			)
		);		
	*/
}
?>