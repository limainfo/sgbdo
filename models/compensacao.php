<?php
class Compensacao extends AppModel {


	var $name = 'Compensacao';
	//var $validate = array('posto_id' => array('numeric'),'identidade' => array('alphanumeric'));


	var $belongsTo = array(
			'Militar' => array('className' => 'Militar',
					'foreignKey' => 'militar_id'
					),
	);



	
						
}

?>
