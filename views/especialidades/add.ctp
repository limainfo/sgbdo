<div class="especialidades form">
<?php echo $this->Form->create('Especialidade');?>
	<fieldset>
 		<legend><?php __('Cadastrar Especialidade'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('quadro_id',array('class'=>'formulario'));
		echo $this->Form->input('nm_especialidade',array('class'=>'formulario'));
		echo $this->Form->input('desc_especialidade',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
