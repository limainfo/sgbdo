<div class="atividadelicencas form">
<?php echo $this->Form->create('Atividadelicenca');?>
	<fieldset>
 		<legend><?php __('Cadastrar Atividadelicenca'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('atividade',array('class'=>'formulario'));
		echo $this->Form->input('desc_atividade',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
