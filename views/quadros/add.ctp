<div class="quadros form">
<?php echo $this->Form->create('Quadro');?>
	<fieldset>
 		<legend><?php __('Cadastrar Quadro'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('nm_quadro',array('class'=>'formulario'));
		echo $this->Form->input('sigla_quadro',array('class'=>'formulario'));
		echo $this->Form->input('semespec',array('class'=>'formulario'));
		echo $this->Form->input('codq',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
