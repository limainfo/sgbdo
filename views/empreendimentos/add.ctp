<div class="empreendimentos form">
<?php echo $this->Form->create('Empreendimento');?>
	<fieldset>
 		<legend><?php __('Cadastrar Empreendimento'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('controle',array('class'=>'formulario'));
		echo $this->Form->input('localidade',array('class'=>'formulario'));
		echo $this->Form->input('projeto',array('class'=>'formulario'));
		echo $this->Form->input('tarefa',array('class'=>'formulario'));
		echo $this->Form->input('prazo',array('class'=>'formulario'));
		echo $this->Form->input('responsavel',array('class'=>'formulario'));
		echo $this->Form->input('status',array('class'=>'formulario'));
		echo $this->Form->input('observacao',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
