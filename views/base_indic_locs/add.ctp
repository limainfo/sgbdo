<div class="baseIndicLocs form">
<?php echo $this->Form->create('BaseIndicLoc');//?>
	<fieldset>
 		<legend><?php __('Cadastrar Base Indic Loc'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $html->link($html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('indicativo',array('class'=>'formulario'));
		echo $this->Form->input('descricao',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
