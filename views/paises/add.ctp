<center>
<div class="paises form">
<?php echo $this->Form->create('Paise');?>
	<fieldset>
 		<legend><?php __('Cadastrar País'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('sigla',array('class'=>'formulario'));
		echo $this->Form->input('idioma',array('class'=>'formulario'));
		echo $this->Form->input('nome',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
</center>