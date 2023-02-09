<div class="cursosSetors form">
<?php echo $form->create('CursosSetor');?>
	<fieldset>
 		<legend>
 		 		<?php __('Modificar dados de CursosSetor');?>&nbsp;&nbsp;&nbsp;					<?php echo $yahooUi->generateScriptForSimpleDialog('del'.$this->data['CursosSetor']['id'], array('body'=>'Tem certeza que deseja excluir # '.$this->data['CursosSetor']['id'].' ?'));
			  echo $yahooUi->imgForSimpleDialog('del'.$this->data['CursosSetor']['id'],'lixo.gif',array('function'=>'delete','id'=>$this->data['CursosSetor']['id'])); ?>

		 
		 				
 		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</legend>
	<?php
		echo $form->input('id',array('class'=>'formulario'));
		echo $form->input('setor_id',array('class'=>'formulario'));
		echo $form->input('curso_id',array('class'=>'formulario'));
		echo $form->input('previsto',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
