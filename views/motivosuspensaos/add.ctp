<div class="motivosuspensaos form">
<?php echo $this->Form->create('Motivosuspensao');?>
	<fieldset>
 		<legend><?php __('Cadastrar Motivosuspensao'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('nm_motivo',array('class'=>'formulario'));
		echo $this->Form->input('descricao',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
