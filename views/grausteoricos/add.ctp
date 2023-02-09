<div class="atividades form">
<?php echo $form->create('Grausteorico');?>
	<fieldset>
 		<legend><?php __('Cadastrar Grausteorico');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
<table width="749" border="0" cellpadding="0" cellspacing="0"
	class="content">		
		<tr>
		<td widht="20%">

		<?php echo $form->input('militar_id',array('class'=>'formulario')); ?>
		</td>
		<td widht="80%">
		<?php	echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar novo Militar','style'=>'float:left;text-padding:0px;text-align:left;')), array('controller'=>'militars','action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false);
		?> 
		</td>
		</tr>
</table>		
	<?php
		echo $form->input('ano',array('class'=>'formulario'));
		echo $form->input('avaliacao',array('class'=>'formulario'));
		//echo $form->input('tipo_avaliacao',array('class'=>'formulario'));
		//echo $datePicker->picker('tipo_avaliacao',array('class'=>'formulario'));
		$tipos =  array("PROVA TEÓRICA"=>"PROVA TEÓRICA","PROVA PRÁTICA"=>"PROVA PRÁTICA");
		echo $form->select('tipo_avaliacao', $tipos ,$tipos,array('class'=>'formulario'), false);
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
