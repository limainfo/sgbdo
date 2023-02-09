
<div class="empresas view">
<h2><?php  __('Empresa');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$empresa['Empresa']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$empresa['Empresa']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empresa['Empresa']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Empresa'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empresa['Empresa']['nm_empresa']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Sigla Empresa'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $empresa['Empresa']['sigla_empresa']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

