<div class="rotulos form">
<?php echo $form->create('Rotulo');?>
	<fieldset>
 		<legend><?php __('Modificar Rotulo');?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Rotulo']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Rotulo']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);?>		&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?> 		
 		</legend>
 		
 		
	<?php
		echo $form->input('id',array('class'=>'formulario'));
		echo $form->input('rotulo',array('class'=>'formulario'));
		echo $form->input('Curso',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
