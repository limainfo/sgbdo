<center>
<div class="postos form">
<?php echo $this->Form->create('Posto');?>
	<fieldset>
 		<legend><?php __('Cadastrar Posto'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('descricao',array('class'=>'formulario'));
		echo $this->Form->input('sigla_posto',array('class'=>'formulario'));
		echo $this->Form->input('sigla_compativel',array('class'=>'formulario'));
		echo $this->Form->input('antiguidade',array('class'=>'formulario'));
		echo $this->Form->input('situacao',array('class'=>'formulario'));
		echo $this->Form->input('situacaocompleta',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
</center>