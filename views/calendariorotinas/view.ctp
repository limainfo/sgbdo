
<?=$this->renderElement('menu',array('data'=>$data));?>

<div class="_calendar" style='z-index:0;' >
<?=$this->renderElement('calendar',array('calendariorotinas'=>$calendrotina,'data'=>$data));?>
</div>
<div class="_details"><?=$this->renderElement('details',array('calendariorotinas'=>$calendrotina));?>
</div>
<?php // print_r($calendrotina);
 ?>