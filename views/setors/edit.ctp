<center>
<div class="setors form">
<?php echo $this->Form->create('Setor');?>
	<fieldset>
 		<legend><?php __('Modificados dados de  Setor'); ?> 		&nbsp;&nbsp;&nbsp;
 		
 		
 		<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$this->data['Setor']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Setor']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				&nbsp;&nbsp;&nbsp;
 		
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
				
 		
 		</legend>
	<?php
		echo $this->Form->input('id',array('class'=>'formulario'));
		echo $this->Form->input('unidade_id',array('class'=>'formulario'));
		echo $this->Form->input('nm_setor',array('class'=>'formulario','size'=>60));
		echo $this->Form->input('sigla_setor',array('class'=>'formulario'));
		echo $this->Form->input('nm_chefe_setor',array('class'=>'formulario','size'=>60));
		echo $this->Form->input('tel_setor',array('class'=>'formulario'));
		echo $this->Form->input('efetivo_previsto',array('class'=>'formulario'));
		//echo $this->Form->input('setor_valido',array('class'=>'formulario'));
		echo $this->Form->input('tipo',array('class'=>'formulario'));
		echo $this->Form->input('setor_id',array('class'=>'formulario'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
</center>