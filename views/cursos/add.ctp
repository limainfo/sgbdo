<div class="cursos form">
<?php echo $form->create('Curso');?>
	<fieldset>
 		<legend><?php __('Cadastrar Curso');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
	<?php
		echo $form->input('codigo',array('class'=>'formulario'));
		echo $form->input('descricao',array('class'=>'formulario'));
		echo $form->input('pre_requisito',array('class'=>'formulario'));
		echo $form->input('objetivo',array('class'=>'formulario'));
		//echo $form->input('Militar',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
