<div class="cursosRotulos form">
<?php echo $form->create('CursosRotulo');?>
	<fieldset>
 		<legend>
 		 		<?php __('Modificar dados de CursosRotulo');?>&nbsp;&nbsp;&nbsp;					<?php echo $yahooUi->generateScriptForSimpleDialog('del'.$this->data['CursosRotulo']['id'], array('body'=>'Tem certeza que deseja excluir # '.$this->data['CursosRotulo']['id'].' ?'));
			  echo $yahooUi->imgForSimpleDialog('del'.$this->data['CursosRotulo']['id'],'lixo.gif',array('function'=>'delete','id'=>$this->data['CursosRotulo']['id'])); ?>

		 
		 				
 		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</legend>
	<?php
		echo $form->input('id',array('class'=>'formulario'));
		echo $form->input('rotulo_id',array('class'=>'formulario'));
		echo $form->input('curso_id',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
