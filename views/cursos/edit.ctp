<div class="cursos form">
<?php echo $form->create('Curso');?>
	<fieldset>
 		<legend><?php __('Modificar dados de Curso');?>&nbsp;&nbsp;&nbsp;
 					<?php
		 echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Curso']['codigo']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Curso']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
		?>
	&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
	<?php
		echo $form->input('id');
	?>
	<?php
		echo $form->input('codigo',array('class'=>'formulario'));
		echo $form->input('descricao',array('class'=>'formulario'));
		echo $form->input('pre_requisito',array('class'=>'formulario'));
		echo $form->input('objetivo',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
