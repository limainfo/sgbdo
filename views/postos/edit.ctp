<center>
<div class="postos form">
<?php echo $this->Form->create('Posto');?>
	<fieldset>
 		<legend><?php __('Modificar Posto'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 		
 		<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Posto']['sigla_posto']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Posto']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('id',array('class'=>'formulario'));
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