<div class="uploads form">
<?php echo $this->Form->create('Upload');?>
	<fieldset>
 		<legend><?php __('Modificados dados de  Upload'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 		
 		<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Upload']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Upload']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('id',array('class'=>'formulario'));
		echo $this->Form->input('type',array('class'=>'formulario'));
		echo $this->Form->input('name',array('class'=>'formulario'));
		echo $this->Form->input('size',array('class'=>'formulario'));
		echo $this->Form->input('data',array('class'=>'formulario'));
		echo $this->Form->input('nm_tabela',array('class'=>'formulario'));
		echo $this->Form->input('id_tabela',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
