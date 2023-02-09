<div class="instituicaoensinos form">
<?php echo $this->Form->create('Instituicaoensino');?>
	<fieldset>
 		<legend><?php __('Cadastrar Instituicaoensino'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('nm_instituicao',array('class'=>'formulario'));
		echo $this->Form->input('descricao',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
