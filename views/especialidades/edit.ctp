<div class="especialidades form">
<?php echo $this->Form->create('Especialidade');?>
	<fieldset>
 		<legend><?php __('Modificados dados de  Especialidade'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 		
 		<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Especialidade']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Especialidade']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('id',array('class'=>'formulario'));
		echo $this->Form->input('quadro_id',array('class'=>'formulario'));
		echo $this->Form->input('nm_especialidade',array('class'=>'formulario'));
		echo $this->Form->input('desc_especialidade',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
