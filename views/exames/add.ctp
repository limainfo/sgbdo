<div class="exames form">
<?php echo $this->Form->create('Exame');?>
	<fieldset>
 		<legend><?php __('Cadastrar Exame'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('militar_id',array('class'=>'formulario'));
		echo $this->Form->input('data_exame',array('class'=>'formulario'));
		echo $this->Form->input('parecer',array('class'=>'formulario'));
		echo $this->Form->input('data_validade',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
