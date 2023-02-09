<? if ($calendariorotinas): ?>
<? //print_r($calendariorotinas[1]); ?>
<? foreach($calendariorotinas as $calendariorotina): ?>
<? //foreach($calendariorotina['Calendariorotina'] as $calend): ?>

<div  id="details_<?=$calendariorotina['Calendariorotina']['id'];?>"  style="display: none;	border: 1px solid #ccc;	background-color: #eee;	padding: 10px;	margin-bottom: 10px; width:200px;" >
	<h3 style="font-family:"Arial",Arial,sans-serif;font-size: 0.9em;font-weight: bold;text-transform: uppercase;text-align: center;padding-bottom: 5px;border-bottom: 1px solid #ccc;margin-bottom: 5px;"><?=$calendariorotina['Rotina']['referencia'];?></h3>
	<?=($calendariorotina['Calendariorotina']['dt_inicio_previsto'] ? '<h4 style="font-size: 0.8em;line-height: 1.2em;">'.$calendariorotina['Calendariorotina']['dt_inicio_previsto'].'</h4>' : '');?>
	<?=($calendariorotina['Rotina']['responsavel'] ? '<h4 style="font-size: 0.8em;line-height: 1.2em;">'.$calendariorotina['Rotina']['responsavel'].'</h4>' : '');?>
	<?=($calendariorotina['Rotina']['Periodicidade']['desc_periodicidade'] ? '<h4 style="font-size: 0.8em;line-height: 1.2em;">'.$calendariorotina['Rotina']['Periodicidade']['desc_periodicidade'].'</h4>' : '');?>
	<?=($calendariorotina['Rotina']['acao'] ? '<p style="font-size: 0.8em;line-height: 1.1em;	margin: 1.0em;">'.$calendariorotina['Rotina']['acao'].'</p>' : '');?>

	<?php echo $form->create('Calendariorotina',array('action'=>'ldap'));?>
	<?php
		//echo $GLOBALS['QUERY_STRING'];
		//echo '<h4 style="font-size: 0.8em;line-height: 1.2em;">'.$form->hidden('TST.url',array('value'=>$GLOBALS['QUERY_STRING'])).'</h4>';
		echo '<h4 style="font-size: 0.8em;line-height: 1.2em;">'.$form->hidden('Calendariorotina.id',array('value'=>$calendariorotina['Calendariorotina']['id'])).'</h4>';
		echo '<h4 style="font-size: 0.8em;line-height: 1.2em;">'.$form->hidden('Calendariorotina.rotina_id',array('value'=>$calendariorotina['Rotina']['id'])).'</h4>';
		echo '<h4 style="font-size: 0.8em;line-height: 1.2em;">'.$form->input('rubrica').'</h4>';
		echo '<h4 style="font-size: 0.8em;line-height: 1.2em;">'.$form->input('password',array('legend'=>'Senha')).'</h4>';
		echo '<h4 style="font-size: 0.8em;line-height: 1.2em;">'.$form->input('obs',array('cols'=>'15','rows'=>'2')).'</h4>';
	?>
<?php echo $form->end('Assinar');?>
	
	<p><small><br><a  style="font-size: 0.7em;text-align: right;" href="#" onClick="new Effect.SlideUpAndDown('details_<?=$calendariorotina['Calendariorotina']['id'];?>',1);">Fechar</a></small></p>
</div>
<? endforeach; ?>

<? //endforeach; ?>
<? endif; ?>