
<div class="setoresassociados view">
<h2><?php  __('Setoresassociado');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$setoresassociado['Setoresassociado']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$setoresassociado['Setoresassociado']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $setoresassociado['Setoresassociado']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Setor'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($setoresassociado['Setor']['sigla_setor'], array('controller' => 'setors', 'action' => 'view', $setoresassociado['Setor']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Setorassociado'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $setoresassociado['Setoresassociado']['setorassociado']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

