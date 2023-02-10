<div class="uploads form">
	<fieldset>
 		<legend><?php __('Cadastrar Upload'); ?> 		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
<?php
    echo $this->Form->create('Upload', array('action' => 'add', 'type' => 'file'));
    echo $this->Form->file('File');
    echo $this->Form->submit('Upload');
	echo $this->Form->input('nm_tabela',array('class'=>'formulario'));
	echo $this->Form->input('id_tabela',array('class'=>'formulario'));
	?>
	</fieldset>
	
<?php
    echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));
?>
</div>
