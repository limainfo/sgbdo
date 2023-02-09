<?php

class Habilitacao extends AppModel {

    var $name = 'Habilitacao';
    var $validate = array(
        'cht_anterior' => array('alphanumeric')
    );
    //var $actsAs = array('Logable'); 
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
        'Militar' => array('className' => 'Militar',
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
        ),
        'Boletiminterno' => array(
            'className' => 'Boletiminterno',
            'foreignKey' => 'boletiminterno_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    var $hasMany = array(
        'Historico' => array('className' => 'Historico',
            'foreignKey' => 'habilitacao_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
            ));

}

?>